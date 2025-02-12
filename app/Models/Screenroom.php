<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screenroom extends Model {
	use HasFactory;

	protected $table = 'screenrooms'; // Ensure it matches your database table name

	protected $primaryKey = 'screenroom_id'; // Define the primary key

	public $timestamps = false; // If you don't have created_at and updated_at columns

	protected $fillable = ['name']; // Add other fillable fields if needed

	public function showtimes() {
		return $this->hasMany(Showtime::class, 'screenroom_id');
	}
}
