<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = ['name', 'type', 'price', 'is_available'];

}
