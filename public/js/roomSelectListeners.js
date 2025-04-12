"use strict";

const roomWrapper = document.getElementById("room-wrapper");

let hasReachedMaxQuantityForSingleSeats = false; // default
let hasReachedMaxQuantityForDuoSeats = false; // default
const maxQuantitiesSingleSeats = Number(document.getElementById('maxQuantitiesSingleSeats').value); // get PHP value from hidden input
const maxQuantitiesDuoSeats = Number(document.getElementById('maxQuantitiesDuoSeats').value); // get PHP value from hidden input
const unselectedSingleSeats = document.querySelectorAll(".singleSeat:not(:checked)");
const unselectedDuoSeats = document.querySelectorAll(".duoSeat:not(:checked)");

// disable checkboxes of all single seats when no tickets selected for type
if (maxQuantitiesSingleSeats === 0) {
	hasReachedMaxQuantityForSingleSeats = true;
	unselectedSingleSeats.forEach(singleSeat => singleSeat.disabled = true);
}
// disable checkboxes of all duo seats when no tickets selected for type
if (maxQuantitiesDuoSeats === 0) {
	hasReachedMaxQuantityForDuoSeats = true;
	unselectedDuoSeats.forEach(duoSeat => duoSeat.disabled = true);
}

const getCheckboxAndSvg = (target) => {
	const chkParent = target.closest('.chk_parent');
	if (!chkParent) return;

	const checkbox = chkParent.querySelector("input[type='checkbox']");
	if (!checkbox) return;

	const svgElement = checkbox.nextElementSibling;
	return {
		checkbox,
		svgElement
	};
};

function updateSeatSelections() {
	const maxQuantities = document.getElementById('maxQuantities').value;
	const textQuantity = document.getElementById('text-seats-quantity');
	if (!textQuantity || !maxQuantities) return;

	const totalSelectedSeats = document.querySelectorAll(".seat:checked").length;
	textQuantity.textContent = `${totalSelectedSeats}/${maxQuantities} geselecteerde plaatsen`;
}
updateSeatSelections(); // initiate function on load

roomWrapper.addEventListener('mouseover', (event) => {
	if (event.target.type === 'checkbox') {
		const {
			checkbox,
			svgElement
		} = getCheckboxAndSvg(event.target);
		if (!checkbox) return;

		if (!checkbox.checked) {
			svgElement.setAttribute('fill', '#0070B5');
		}
	}
});

roomWrapper.addEventListener('mouseout', (event) => {
	if (event.target.type === 'checkbox') {
		const {
			checkbox,
			svgElement
		} = getCheckboxAndSvg(event.target);
		if (!checkbox) return;

		if (!checkbox.checked) {
			svgElement.setAttribute('fill', '#bfcbcc');
		}
	}
});

roomWrapper.addEventListener('click', (event) => {

	// validate target
	if (event.target.type === 'checkbox') {
		const {
			checkbox,
			svgElement
		} = getCheckboxAndSvg(event.target);
		if (!checkbox) return;

		const clickedCheckbox = event.target;
		const seatType = clickedCheckbox.dataset.seatType; // singleSeat or duoSeat
		const selectedSingleSeats = document.querySelectorAll(".singleSeat:checked");
		const unselectedSingleSeats = document.querySelectorAll(".singleSeat:not(:checked)");
		const selectedDuoSeats = document.querySelectorAll(".duoSeat:checked");
		const unselectedDuoSeats = document.querySelectorAll(".duoSeat:not(:checked)");
		const selectedSingleSeatQuantity = selectedSingleSeats.length;
		const selectedDuoSeatQuantity = selectedDuoSeats.length;

		/* * * * * * * * * * * * * * * * * * * * * * * * * * * * */
		// checking a checkbox...
		if (clickedCheckbox.checked) {
			if (seatType === 'singleSeat') {
				console.log('a single seat has been selected');
				/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
				// when hasReachedMaxQuantityForSingleSeats === false
				if (!hasReachedMaxQuantityForSingleSeats) {
					console.log('state 1');
					svgElement.setAttribute('fill', '#00B683');
					// when maxQuantitiesSingleSeats has been reached
					if (selectedSingleSeatQuantity >= maxQuantitiesSingleSeats) {
						hasReachedMaxQuantityForSingleSeats = true;
						unselectedSingleSeats.forEach(seat => seat.disabled = true); // disable all seats
					}
				}
				/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
			} else if (seatType === 'duoSeat') {
				console.log('a duo seat has been selected');
				/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
				// when hasReachedMaxQuantity === false
				if (!hasReachedMaxQuantityForDuoSeats) {
					console.log('state 2');
					svgElement.setAttribute('fill', '#00B683');
					// when maxQuantitiesDuoSeats has been reached
					if (selectedDuoSeatQuantity >= maxQuantitiesDuoSeats) {
						hasReachedMaxQuantityForDuoSeats = true;
						unselectedDuoSeats.forEach(seat => seat.disabled = true); // disable all seats
					}
				}
				/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
			} else {
				console.error('Unknown seat type!');
			}
			/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
		}
		// unchecking a checkbox...
		else {
			svgElement.setAttribute('fill', '#bfcbcc');
			if (seatType === 'singleSeat') {
				hasReachedMaxQuantityForSingleSeats = false;
				unselectedSingleSeats.forEach(seat => seat.disabled = false); // disable all seats
			} else if (seatType === 'duoSeat') {
				hasReachedMaxQuantityForDuoSeats = false;
				unselectedDuoSeats.forEach(seat => seat.disabled = false); // disable all seats
			} else {
				console.error('Unknown seat type!');
			}
		}
	}
	updateSeatSelections();
});