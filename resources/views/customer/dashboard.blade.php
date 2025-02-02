@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <!-- Personalized Greeting for Authenticated User -->
        <h2 class="text-3xl font-semibold text-gray-800 text-center mb-6">
            Welcome, {{ auth()->user()->name }}! 🎉
        </h2>

        <!-- Display Success Message -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-6" id="successMessage">
                <p>{{ session('success') }}</p>
            </div>
            <script>
                // Hide the success message after 3 seconds
                setTimeout(function() {
                    document.getElementById('successMessage').style.display = 'none';
                }, 3000);
            </script>
        @endif

        <!-- Rooms Listing -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($rooms as $room)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden group">
                    <!-- Room Image -->
                    <img src="{{ asset('storage/rooms/' . 
                        ($room->type == 'Single' ? 'single_room.jpg' :
                        ($room->type == 'Double' ? 'double-rooms.jpg' :
                        ($room->type == 'Suite' ? 'suite-room.jpg' : 'default.jpg')))) }}" 
                        alt="{{ $room->type }}" class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-105">

                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $room->name }}</h3>
                        <p class="text-gray-600">{{ $room->type }}</p>
                        <p class="text-lg font-semibold text-green-600">Price: ${{ $room->price }}</p>

                        <!-- Booking Button -->
                        <a href="{{ route('rooms.book', ['room_id' => $room->id]) }}" class="mt-4 inline-block bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-700 transition duration-300">Book Your Room Now</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

