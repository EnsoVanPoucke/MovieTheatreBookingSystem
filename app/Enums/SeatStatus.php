<?php

namespace App\Enums;

/*
	Enum representing the different statuses a seat can have in the booking system.
	Each seat is either a single or a duo seat, and can be in one of the following states:
	- Available: The seat is free to book.
	- Pending: The seat is currently being selected.
	- Booked: The seat has been successfully reserved.
*/

enum SeatStatus: int {
	// AVAILABLE seats
	case AVAILABLE_SINGLE = 1;
	case AVAILABLE_DUO = 1001;

	// PENDING seats (during the booking process)
	case PENDING_SINGLE = 2;
	case PENDING_DUO = 1002;

	// Booked seats
	case BOOKED_SINGLE = 3;
	case BOOKED_DUO = 1003;
}