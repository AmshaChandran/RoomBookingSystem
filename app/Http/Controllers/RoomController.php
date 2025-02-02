<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class RoomController extends Controller
{
    /**
     * Display all rooms with an optional filter by type.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        Log::info('Request Type: ' . $request->type);
        // Start the query to fetch rooms from the database
        $query = Room::query();

        // Check if the 'type' filter is provided in the request
        if ($request->has('type') && $request->type !== 'All') {
            // Filter the rooms by the provided 'type' (Single, Double, Suite)
            $query->where('type', $request->type);
        }

        // Get all rooms based on the query
        $rooms = $query->get();

        // Return the 'rooms.index' view and pass the rooms data to it
        return view('rooms.index', compact('rooms'));
    }

    /**
     * Display a specific room for booking.
     *
     * @param  int  $roomId
     * @return \Illuminate\View\View
     */
    public function book($roomId)
    {
        // Find the room by ID or fail
        $room = Room::findOrFail($roomId);

        // Return the 'rooms.book' view and pass the room data to it
        return view('rooms.book', compact('room'));
    }

    /**
     * Toggle the availability status of a room.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleAvailability(Request $request, Room $room)
    {
        // Update the availability status of the room based on the request input
        $room->is_available = $request->is_available;

        // Save the updated room data
        $room->save();

        // Flash a success message to the session (can be displayed on the next request)
        session()->flash('success', 'Room availability updated successfully.');

        // Return a JSON response with a success message
        return response()->json(['success' => 'Room availability updated successfully']);
    }
}
