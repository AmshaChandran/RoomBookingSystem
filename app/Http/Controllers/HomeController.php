<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the homepage with a list of rooms.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all rooms
        $rooms = Room::get();

        // Return the 'home' view and pass the rooms data to it
        return view('home', compact('rooms'));
    }

    /**
     * Authenticate the user and redirect them based on role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request)
    {
        // Check if the user is an admin
        if ($request->user()->isAdmin()) {
            // Redirect to the admin dashboard if the user is an admin
            return redirect()->route('manage.rooms');
        } else {
            // For customers, fetch rooms and show the customer dashboard
            $rooms = Room::get();
            return view('customer.dashboard', compact('rooms'));
        }
    }
}
