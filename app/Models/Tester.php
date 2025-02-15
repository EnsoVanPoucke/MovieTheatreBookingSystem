<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tester extends Model {
	use HasFactory;

	protected $table = 'tester';
	protected $fillable = ['voornaam'];

	// public $timestamps = false; // Disable timestamps
}
