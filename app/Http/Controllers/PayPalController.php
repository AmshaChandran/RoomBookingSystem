<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Log;
class PayPalController extends Controller
{

    // Function to create an order for PayPal payment
    public function createOrder($bookingId, $totalAmount)
    {
        // Retrieve the booking record using the booking ID
        $booking = Booking::findOrFail($bookingId);

        // Initialize PayPal client and set API credentials from the config file
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        Log::info(config('paypal'));

        // Get an access token to authenticate with PayPal
        $paypalToken = $provider->getAccessToken();

        // Create a PayPal order with the necessary details
        $order = $provider->createOrder([
            "intent" => "CAPTURE", // Capture payment on approval
            "purchase_units" => [
                [
                    "reference_id" => "BOOKING_" . $booking->id, // Unique booking reference ID
                    "amount" => [
                        "currency_code"=> "USD",
                        "value" => $totalAmount
                    ]
                ]
            ],
            "application_context" => [
                 // URLs for successful and cancelled payments
                "return_url" => route('paypal.capture', ['bookingId' => $booking->id]),
                "cancel_url" => route('paypal.cancel', ['bookingId' => $booking->id])
            ]
        ]);

        if (isset($order['id']) && $order['status'] == 'CREATED') {
            $booking->paypal_order_id = $order['id'];
            $booking->save();
            // Find the approval link and redirect the user to PayPal for payment approval
            foreach ($order['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    Log::info('Redirecting to PayPal approval URL: ' . $link['href']);
                    $url =  $link['href'];
                    return redirect()->away($url); // Redirect to PayPal approval page
                }
            }
        }

        return redirect()->route('rooms.mybooking')->with('error', 'Something went wrong.');
    }

    // Function to capture the payment after the user approves the order on PayPal
    public function captureOrder(Request $request, $bookingId)
    {
        $token = $request->query('token');
        if (is_null($token)) {
            return redirect()->route('rooms.mybooking')->with('error', 'Invalid PayPal token.');
        }
        Log::info('Booking ID: ' . $bookingId);

        // Initialize PayPal client and set API credentials
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        // Get the token from the request and capture the payment order
        $response = $provider->capturePaymentOrder($token);
        // Check if the payment was successful
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $booking = Booking::findOrFail($bookingId);
            $booking->payment_status = 'Paid';
            $booking->save();

            return redirect()->route('rooms.mybooking')->with('success', 'Payment successful.');
        } else {
            // If payment failed, update the booking payment status to "Failed"
            $booking = Booking::findOrFail($bookingId);
            $booking->payment_status = 'Failed';
            $booking->save();
        
            return redirect()->route('rooms.mybooking')->with('error', 'Payment failed.');
        }
    }

    // Function to handle the cancellation of a payment
    public function cancelOrder($bookingId)
    {
        // Find the booking and update its payment status to "Cancelled"
        $booking = Booking::findOrFail($bookingId);
        $booking->payment_status = 'Cancelled';
        $booking->save();

        // Redirect back with a cancellation message
        return redirect()->route('rooms.mybooking')->with('error', 'Payment was cancelled.');
    }

}
