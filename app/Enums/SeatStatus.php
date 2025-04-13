<?php

namespace App\Enums;

enum SeatStatus: int {
	case AVAILABLE_SINGLE = 1;
	case AVAILABLE_DUO = 1001;
	case PENDING_SINGLE = 2;
	case PENDING_DUO = 1002;
	case BOOKED_SINGLE = 3;
	case BOOKED_DUO = 1003;
}