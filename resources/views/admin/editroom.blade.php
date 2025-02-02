@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-semibold mb-6">Edit Room</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('rooms.update', $room->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Room Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Room Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $room->name) }}" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Room Type -->
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Room Type</label>
                <select name="type" id="type" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('type') border-red-500 @enderror">
                    <option value="Single" {{ old('type', $room->type) == 'Single' ? 'selected' : '' }}>Single</option>
                    <option value="Double" {{ old('type', $room->type) == 'Double' ? 'selected' : '' }}>Double</option>
                    <option value="Suite" {{ old('type', $room->type) == 'Suite' ? 'selected' : '' }}>Suite</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price" id="price" step="0.01" value="{{ old('price', $room->price) }}" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('price') border-red-500 @enderror">
                @error('price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Availability Status -->
            <div class="mb-4">
                <label for="is_available" class="block text-sm font-medium text-gray-700">Availability</label>
                <div class="flex items-center">
                    <input type="hidden" name="is_available" value="0">
                    <input type="checkbox" name="is_available" id="is_available" value="1" {{ old('is_available', $room->is_available) == 1 ? 'checked' : '' }} class="mr-2 leading-tight">
                    <span class="text-sm text-gray-600">Available</span>
                </div>
                @error('is_available')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
