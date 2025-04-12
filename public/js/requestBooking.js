"use strict";

const btnVerder = document.getElementById("btnVerder");
btnVerder.addEventListener("click", async function () {
	const selectedSingleSeats = document.querySelectorAll(".singleSeat:checked");
	const selectedDuoSeats = document.querySelectorAll(".duoSeat:checked");

	// Get array of objects with id and dataset for single seats
	const selectedSingleSeatDetails = Array.from(selectedSingleSeats).map(seat => ({
		seatType: "singleSeat",
		global_seat_number: seat.id,
		row_number: seat.dataset.rowNumber,
		seat_number: seat.dataset.seatNumber
	}));

	// Get array of objects with id and dataset for duo seats
	const selectedDuoSeatDetails = Array.from(selectedDuoSeats).map(seat => ({
		seatType: "duoSeat",
		global_seat_number: seat.id,
		row_number: seat.dataset.rowNumber,
		seat_number: seat.dataset.seatNumber
	}));

	const maxQuantitiesSingleSeats = document.getElementById('maxQuantitiesSingleSeats').value; // get PHP value from hidden input
	const maxQuantitiesDuoSeats = document.getElementById('maxQuantitiesDuoSeats').value; // get PHP value from hidden input

	// do not continue when not all tickets are selected seats!!!
	if (selectedSingleSeatDetails.length < maxQuantitiesSingleSeats || selectedDuoSeatDetails.length < maxQuantitiesDuoSeats) {
		alert("Gelieve correct aantal zitplaatsen te selecteren!");
		return;
	}

	// Get booking details from the page
	const title = document.querySelector("[data-booking-title]").dataset.bookingTitle;
	const date = document.querySelector("[data-booking-date]").dataset.bookingDate;
	const time = document.querySelector("[data-booking-time]").dataset.bookingTime;
	const screenroom = document.querySelector("[data-booking-screenroom]").dataset.bookingScreenroom;

	// Do not continue if all required booking data is not available.
	if (!date || !time || !screenroom) return;

	// Prepare data for the request
	const requestData = {
		date: date,
		time: time,
		screenroom: screenroom,
		title: title,
		selectedSingleSeatDetails,
		selectedDuoSeatDetails
	};

	try {
		const response = await fetch("/book-seats", {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
				"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
			},
			body: JSON.stringify(requestData)
		});

		const responseData = await response.json();

		if (responseData.success) {
			window.location.href = `/booking/confirmation?data=${encodeURIComponent(JSON.stringify(responseData))}`;
		} else {
			console.error("Booking failed:", responseData.error);
		}
	} catch (error) {
		console.error("Error fetching seat data:", error);
	}
});