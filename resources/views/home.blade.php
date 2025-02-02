<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Room Now!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .room-card {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .room-card:hover {
            transform: scale(1.05);
        }
        .room-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        /* Right Sidebar Styling */
        .login-register-sidebar {
            position: fixed;
            top: 20%;
            right: 0;
            background-color: #f8f9fa;
            box-shadow: -2px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            width: 250px;
        }
        .login-register-sidebar h4 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2 class="text-center mb-4">Book Your Room Now!</h2>

    <!-- Filter Dropdown -->
    <div class="row mb-4">
        <div class="col-md-4">
            <form method="GET" action="{{ route('rooms.index') }}">
                <label for="type" class="form-label"><strong>Filter by Room Type:</strong></label>
                <select name="type" id="type" class="form-control" onchange="this.form.submit()">
                    <option value="All" {{ request('type') == 'All' ? 'selected' : '' }}>All Types</option>
                    <option value="Single" {{ request('type') == 'Single' ? 'selected' : '' }}>Single</option>
                    <option value="Double" {{ request('type') == 'Double' ? 'selected' : '' }}>Double</option>
                    <option value="Suite" {{ request('type') == 'Suite' ? 'selected' : '' }}>Suite</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Room Listings -->
    <div class="row">
        @foreach ($rooms as $room)
            <div class="col-md-4 mb-4">
                <div class="card room-card">
                <img src="{{ asset('storage/rooms/' . 
                        ($room->type == 'Single' ? 'single_room.jpg' :
                        ($room->type == 'Double' ? 'double-rooms.jpg' :
                        ($room->type == 'Suite' ? 'suite-room.jpg' : 'default.jpg')))) }}" 
                        alt="{{ $room->type }}" class="card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $room->name }}</h5>
                        <p class="card-text"><strong>Type:</strong> {{ $room->type }}</p>
                        <p class="card-text"><strong>Price:</strong> {{ number_format($room->price, 0) }} $</p>
                        
                        @auth
                            <a href="{{ route('rooms.book', $room->id) }}" class="btn btn-primary mt-3">Book Now</a>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Right Sidebar with Login/Register Section -->
<div class="login-register-sidebar">
    <h4>Login or Register</h4>
    <p>To book a room, please login or register:</p>
    <a href="{{ route('login') }}" class="btn btn-warning w-100 mb-2">Login</a>
    <a href="{{ route('register') }}" class="btn btn-info w-100">Register</a>
</div>

</body>
</html>
