@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">All Rooms</h1>

        <!-- Add button for new room -->
        <div class="mb-6">
            <a href="{{ route('rooms.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition duration-300">
                Add New Room
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div id="successMessage" class="bg-green-500 text-white p-3 rounded-md shadow-lg mb-4 max-w-lg mx-auto flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span class="flex-1">{{ session('success') }}</span>
                <button onclick="document.getElementById('successMessage').style.display='none'" class="text-white ml-4">
                    &times;
                </button>
            </div>
            <script>
                setTimeout(() => document.getElementById('successMessage').style.display = 'none', 5000);
            </script>
        @endif

        <!-- Rooms Table -->
        @if($rooms->isEmpty())
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded-md shadow-md text-center">
                <p>No rooms found. <a href="{{ route('rooms.create') }}" class="text-blue-600 hover:text-blue-800">Create one now</a>.</p>
            </div>
        @else
            <div class="overflow-x-auto bg-white rounded-lg shadow-lg mt-6">
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium">Room Name</th>
                            <th class="px-6 py-3 text-left font-medium">Room Type</th>
                            <th class="px-6 py-3 text-left font-medium">Price</th>
                            <th class="px-6 py-3 text-left font-medium">Availability</th>
                            <th class="px-6 py-3 text-left font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600">
                        @foreach ($rooms as $room)
                            <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                <td class="border-b px-6 py-4">{{ $room->name }}</td>
                                <td class="border-b px-6 py-4">{{ $room->type }}</td>
                                <td class="border-b px-6 py-4">{{ $room->price }}</td>
                                <td class="border-b px-6 py-4">
                                    <!-- Availability Status -->
                                    <span class="{{ $room->is_available ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $room->is_available ? 'Available' : 'Not Available' }}
                                    </span>
                                </td>
                                <td class="border-b px-6 py-4">
                                    <a href="{{ route('rooms.edit', $room->id) }}" class="text-blue-600 hover:text-blue-800 transition duration-200">Edit</a> | 
                                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition duration-200">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
