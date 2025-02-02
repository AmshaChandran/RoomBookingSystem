<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Check if a room is available based on the provided room ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkAvailability(Request $request)
    {
        // Retrieve the room by the provided ID
        $room = Room::find($request->input('room_id'));

        // If the room is not found, redirect to home with an error message
        if (!$room) {
            return redirect()->route('home')->with('error', 'Room not found.');
        }

        // Retrieve the availability status of the room
        $availability = $room->availability;

        // Redirect back to the home route with the room's availability and ID
        return redirect()->route('home')->with([
            'availability' => $availability,
            'room_id' => $room->id
        ]);
    }

    /**
     * Show the booking form for a specific room.
     *
     * @param  int  $roomId
     * @return \Illuminate\View\View
     */
    public function book($roomId)
    {
        // Get the room details using the room ID
        $room = Room::find($roomId);

        // Return the booking view and pass the room details
        return view('rooms.book', compact('room'));
    }

    /**
     * Confirm the booking for a room based on the check-in and check-out dates.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirmBooking(Request $request)
    {
        // Retrieve the room ID and room details from the request
        $roomId = $request->input('room_id');
        $room = Room::find($roomId);

        // Get the check-in and check-out dates from the request
        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');

        // Check if the room is available for the selected dates
        $available = $this->checkRoomAvailability($roomId);

        // If the room is available
        if ($available) {
            // Create a new booking entry
            $booking = new Booking();
            $booking->room_id = $roomId;
            $booking->name = $request->input('name');
            $booking->email = $request->input('email');
            $booking->check_in = $checkIn;
            $booking->check_out = $checkOut;
            $booking->save(); // Save the booking to the database

            // Redirect to home page with a success message
            return redirect()->route('home')->with('success', 'Room booked successfully!');
        } else {
            // If the room is not available, redirect back with an error message
            return back()->with('error', 'Room is not available for the selected dates.');
        }
    }

    /**
     * Check if a specific room is available based on the availability status.
     *
     * @param  int  $roomId
     * @return bool
     */
    private function checkRoomAvailability($roomId)
    {
        // Find the room by its ID
        $room = Room::find($roomId);

        // Return false if the room is not found
        if (!$room) {
            return false; // Room not found
        }

        // If the room is not available (is_available == 0), return false
        if ($room->is_available == 0) {
            return false; // Room is not available
        }

        // If the room is available, return true
        return true;
    }

    /**
     * Display the list of bookings for the logged-in user.
     *
     * @return \Illuminate\View\View
     */
    public function MyBooking()
    {
        // Get the currently authenticated user
        $user = Auth::user();
        $username = $user->name;

        // Retrieve all bookings made by the user along with the associated room details
        $bookings = Booking::where('name', $username)->with('room')->get();

        // Return the view displaying the user's bookings
        return view('customer.mybookings', compact('bookings'));
    }
}
