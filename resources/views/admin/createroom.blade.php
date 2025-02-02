@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-semibold mb-6">Add New Room</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('rooms.store') }}" method="POST">
            @csrf

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Room Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Room Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full px-4 py-2  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror" value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Room Type -->
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Room Type</label>
                <select name="type" id="type" class="mt-1 block w-full px-4 py-2 border  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('type') border-red-500 @enderror" required>
                    <option value="Single" {{ old('type') == 'Single' ? 'selected' : '' }}>Single</option>
                    <option value="Double" {{ old('type') == 'Double' ? 'selected' : '' }}>Double</option>
                    <option value="Suite" {{ old('type') == 'Suite' ? 'selected' : '' }}>Suite</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price" id="price" step="0.01" class="mt-1 block w-full px-4 py-2   rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('price') border-red-500 @enderror" value="{{ old('price') }}" required>
                @error('price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Availability Status -->
            <div class="mb-4">
                <label for="availability" class="block text-sm font-medium text-gray-700">Availability</label>
                <div class="flex items-center">
                    <!-- Hidden input for when checkbox is unchecked -->
                    <input type="hidden" name="availability" value="0">
                    <input type="checkbox" name="availability" id="availability" class="mr-2 leading-tight" value="1" {{ old('availability') ? 'checked' : '' }}>
                    <span class="text-sm text-gray-600">Available</span>
                </div>
                @error('availability')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                    Save Room
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
