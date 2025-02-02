<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;

class AdminController extends Controller
{
    /**
     * Display all rooms in the admin panel.
     *
     * @return \Illuminate\View\View
     */
    public function AllRooms()
    {
        // Retrieve all rooms from the database
        $rooms = Room::all();

        // Return the 'admin.rooms' view and pass the rooms data
        return view('admin.rooms', compact('rooms'));
    }

    /**
     * View all bookings in the admin panel.
     *
     * @return \Illuminate\View\View
     */
    public function viewBookings()
    {
        // Retrieve all bookings from the database
        $bookings = Booking::all();

        // Return the 'admin.bookings' view and pass the bookings data
        return view('admin.bookings', compact('bookings'));
    }

    /**
     * Show the form for creating a new room.
     *
     * @return \Illuminate\View\View
     */
    public function CreateRoom()
    {
        // Return the 'admin.createroom' view
        return view('admin.createroom');
    }

    /**
     * Store a newly created room in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function StoreRoom(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'price' => 'required|numeric',
            'availability' => 'nullable|boolean',
        ]);

        // Create a new room using the validated data
        Room::create([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'is_available' => $request->input('availability', 0), 
        ]);

        // Redirect back to the rooms management page with a success message
        return redirect()->route('manage.rooms')->with('success', 'Room created successfully!');
    }

    /**
     * Show the form to edit an existing room.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function EditRoom($id)
    {
        // Find the room by ID or fail
        $room = Room::findOrFail($id);

        // Return the 'admin.editroom' view with the room data
        return view('admin.editroom', compact('room'));
    }

    /**
     * Update an existing room in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdateRoom(Request $request, $id)
    {

        //return $request;
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'price' => 'required|numeric',
            'is_available' => 'nullable|boolean',
        ]);

        // Find the room by ID or fail
        $room = Room::findOrFail($id);

        // Update the room's data
        $room->update([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'is_available' => $request->input('is_available', 0), 
        ]);

        // Redirect back to the rooms management page with a success message
        return redirect()->route('manage.rooms')->with('success', 'Room Updated successfully!');
    }

    /**
     * Delete a room from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function DestroyRoom($id)
    {
        // Find the room by ID or fail
        $room = Room::findOrFail($id);

        // Delete the room
        $room->delete();

        // Redirect back to the rooms management page with a success message
        return redirect()->route('manage.rooms')->with('success', 'Room Deleted successfully!');
    }

    /**
     * Toggle the availability of a room.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateRoomAvailability($id)
    {
        // Find the room by ID or fail
        $room = Room::findOrFail($id);

        // Toggle the availability status
        $room->is_available = !$room->is_available;
        $room->save();

        // Redirect back to the previous page
        return back();
    }
}
