@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        
        <h2 class="text-3xl font-semibold text-gray-800 text-center mb-6">Book Room: {{ $room->name }}</h2>

        <!-- Display Error Message -->
        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded-md mb-6">
                <p>{{ session('error') }}</p>
                <a href="{{ route('home') }}" class="text-blue-300 hover:text-blue-500 mt-2 inline-block">Browse Other Rooms</a>
            </div>
        @endif

        <form action="{{ route('rooms.confirmBooking') }}" method="POST">
            @csrf
            <input type="hidden" name="room_id" value="{{ $room->id }}">

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Your Name:</label>
                <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded-md" value="{{ Auth::user()->name }}" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Your Email:</label>
                <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded-md" value="{{ Auth::user()->email }}" required>
            </div>

            <div class="mb-4 flex space-x-4">
                <div class="w-1/2">
                    <label for="check_in" class="block text-gray-700">Start Date (Check-in):</label>
                    <input type="date" name="check_in" id="check_in" class="w-full p-2 border border-gray-300 rounded-md" min="{{ \Carbon\Carbon::today()->toDateString() }}" required>
                </div>

                <div class="w-1/2">
                    <label for="check_out" class="block text-gray-700">End Date (Check-out):</label>
                    <input type="date" name="check_out" id="check_out" class="w-full p-2 border border-gray-300 rounded-md" min="{{ \Carbon\Carbon::today()->toDateString() }}" required>
                </div>
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-300">Book Now</button>
        </form>
    </div>
@endsection
