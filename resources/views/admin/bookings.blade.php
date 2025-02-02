@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-semibold mb-4">All Bookings</h1>
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

        <!-- Check if there are any bookings -->
        @if($bookings->isEmpty())
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg shadow-md mb-4 max-w-lg mx-auto">
                <p>No bookings found. Come back later.</p>
            </div>
        @else
            <!-- Bookings Table -->
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left border-b">Customer Name</th>
                            <th class="px-6 py-3 text-left border-b">Room</th>
                            <th class="px-6 py-3 text-left border-b">Email</th>
                            <th class="px-6 py-3 text-left border-b">Check In</th>
                            <th class="px-6 py-3 text-left border-b">Check Out</th>
                            <th class="px-6 py-3 text-left border-b">Duration</th>
                            <th class="px-6 py-3 text-left border-b">Payment Status</th>
                            <th class="px-6 py-3 text-left border-b">Availability</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($bookings as $booking)
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="px-6 py-4 border-b">{{ $booking->name }}</td>
                                <td class="px-6 py-4 border-b">{{ $booking->room->name }}</td>
                                <td class="px-6 py-4 border-b">{{ $booking->email }}</td>
                                <td class="px-6 py-4 border-b">{{ $booking->check_in }}</td>
                                <td class="px-6 py-4 border-b">{{ $booking->check_out }}</td>
                                <td class="px-6 py-4 border-b">
                                    {{ \Carbon\Carbon::parse($booking->check_in)->diffInDays(\Carbon\Carbon::parse($booking->check_out)) }} days
                                </td>
                                <td class="px-6 py-4 border-b">
                                    <!-- Payment Status with background colors -->
                                    @switch($booking->payment_status)
                                        @case('Pending')
                                            <span class="bg-yellow-500 text-white px-3 py-1 rounded-full">Pending</span>
                                            @break
                                        @case('Paid')
                                            <span class="bg-green-500 text-white px-3 py-1 rounded-full">Paid</span>
                                            @break
                                        @case('Cancelled')
                                            <span class="bg-red-500 text-white px-3 py-1 rounded-full">Cancelled</span>
                                            @break
                                        @case('Failed')
                                            <span class="bg-gray-500 text-white px-3 py-1 rounded-full">Failed</span>
                                            @break
                                        @default
                                            <span class="bg-gray-500 text-white px-3 py-1 rounded-full">Unknown</span>
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 border-b">
                                    <!-- Availability Toggle (same as previous) -->
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer availability-toggle" data-id="{{ $booking->room->id }}" 
                                            {{ $booking->room->is_available ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-300 peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 
                                            peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] 
                                            after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 
                                            after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                                    </label>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- AJAX Script -->
    <script>
        document.querySelectorAll('.availability-toggle').forEach(toggle => {
            toggle.addEventListener('change', function () {
                let roomId = this.getAttribute('data-id');
                let status = this.checked ? 1 : 0;

                fetch(`/rooms/${roomId}/update-avail`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ is_available: status })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>

@endsection
