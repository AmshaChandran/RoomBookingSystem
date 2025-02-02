@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <h2 class="text-3xl font-semibold text-gray-800 text-center mb-6">My Bookings</h2>

        @if(session('success'))
            <div id="success-message" class="bg-green-500 text-white p-4 rounded-md mb-6">
                <p>{{ session('success') }}</p>
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('success-message').style.display = 'none';
                }, 5000); // 5 seconds
            </script>
        @endif

        @if($bookings->isEmpty())
            <div class="text-center">
                <p class="text-lg text-gray-600">No bookings found. Browse rooms and make a booking!</p>
                <a href="{{ route('home') }}" class="mt-4 inline-block bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-300">Browse Rooms</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($bookings as $booking)
                    <div class="bg-white shadow-lg rounded-lg p-6 group">
                        <!-- Total Amount Calculation -->
                        @php
                            // Calculate the number of days for the stay
                            $checkIn = \Carbon\Carbon::parse($booking->check_in);
                            $checkOut = \Carbon\Carbon::parse($booking->check_out);
                            $days = $checkIn->diffInDays($checkOut);
                            
                            // Calculate total amount
                            $totalAmount = $booking->room->price * $days;
                        @endphp
                        <img src="{{ asset('storage/rooms/' . 
                        ($booking->room->type == 'Single' ? 'single_room.jpg' :
                        ($booking->room->type == 'Double' ? 'double-rooms.jpg' :
                        ($booking->room->type == 'Suite' ? 'suite-room.jpg' : 'default.jpg')))) }}" 
                        alt="{{ $booking->room->type }}"
                             class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-105 rounded-lg">

                        <div class="mt-4">
                            <h3 class="text-xl font-semibold text-gray-800">Room: {{ $booking->room->name }}</h3>
                            <p class="text-gray-600">Type: {{ $booking->room->type }}</p>
                            <p class="text-gray-600">Check-in: {{ $checkIn->format('d M Y') }}</p>
                            <p class="text-gray-600">Check-out: {{ $checkOut->format('d M Y') }}</p>
                            
                            <!-- Display Price Per Day and Total Amount -->
                            <p class="text-lg font-semibold text-blue-600">
                                Price per day: $ {{ number_format($booking->room->price, 2) }}
                            </p>
                            <p class="text-lg font-semibold text-blue-600">
                                Total Amount: $ {{ number_format($totalAmount, 2) }}
                            </p>
                        </div>

                        <div class="mt-4">
                            @if ($booking->payment_status === 'Pending')
                                <a href="{{ route('paypal.pay', ['bookingId' => $booking->id, 'totalAmount' => $totalAmount]) }}"  
                                   class="inline-block bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-700 transition duration-300">
                                   Pay Now
                                </a>
                            @elseif ($booking->payment_status === 'Failed' || $booking->payment_status === 'Cancelled')
                                <a href="{{ route('paypal.pay', ['bookingId' => $booking->id, 'totalAmount' => $totalAmount]) }}"  
                                   class="inline-block bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-700 transition duration-300">
                                   Retry Payment
                                </a>
                                <span class="text-red-600 font-semibold">({{ ucfirst($booking->payment_status) }})</span>
                            @elseif ($booking->payment_status === 'Paid')
                                <span class="text-green-600 font-semibold">Paid</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
