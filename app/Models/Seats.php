<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seats extends Model {
	use HasFactory;

	protected $table = 'seats'; // Define table name if it doesn't follow Laravel's naming convention
}
