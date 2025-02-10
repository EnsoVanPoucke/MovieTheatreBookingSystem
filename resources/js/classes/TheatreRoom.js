"use strict";

import {gridBlueprints, gridDimensions} from "../utils/gridBlueprints.js";

export class TheatreRoom {

	static gridBlueprints = gridBlueprints;
	static gridDimensions = gridDimensions;
	static seatImgPath = "images/icons";
	// static posterImgPath = "images/posters";

	// class constructor. Initiates room properties...
	constructor(date, time, title, duration, layoutNumber) {
		this.date = date;
		this.time = time;
		this.duration = duration;
		this.title = title;
		this.layoutNumber = layoutNumber;
		this.screenLayout = TheatreRoom.gridBlueprints[layoutNumber - 1];
		this.gridDimensions = TheatreRoom.gridDimensions[layoutNumber - 1];

		this.renderRoomLayout(layoutNumber);

	}





	renderRoomLayout(layoutNumber) {
		const roomWrapper = document.getElementById("room-wrapper");
		const screen = document.getElementById("screen");

		if (!roomWrapper) {
			console.log("no div with an id of room-wrapper");
			return;
		}

		roomWrapper.innerHTML = ""; // clear layout


		// keep track of the right numbers when looping through the layout...
		let rowNumber = 0;
		let seatNumber = 0; // seat numbers per row...
		let globalSeatNumber = 0; // global seat numbers in the room...


		// Loop through rows in the layout
		this.screenLayout.forEach((rowArray, arrayIndex) => {
			rowArray.forEach((rowArrayContent) => {

				// keep track of the current row number...
				if (rowArrayContent > 9000 && rowArrayContent <= 9200) {
					rowNumber = rowArrayContent - 9000;
				}

				if (rowArrayContent === 0 || rowArrayContent >= 9000) {

					this.createEmptyGridBlock(rowArrayContent);

				} else if (rowArrayContent === 1 || rowArrayContent === 1001) {
					seatNumber++;
					globalSeatNumber++;

					this.createSeatGridBlock(rowArrayContent, rowNumber, seatNumber);

				} else {
					console.log("Error: Some unidentified room object here!");
				}

			});
			seatNumber = 0;// reset the seatNumber, to be able to count up seat numbers for the next row.
		});

		const blueprintIndex = layoutNumber - 1;
		// roomWrapper.style.height = TheatreRoom.gridDimensions[blueprintIndex].height + 'px';
		// roomWrapper.style.width = TheatreRoom.gridDimensions[blueprintIndex].width + 'px';
		roomWrapper.style.width = TheatreRoom.gridDimensions[blueprintIndex] + 'px';
		screen.style.width = TheatreRoom.gridDimensions[blueprintIndex] + 'px';

		this.addEventListenerToRoomWrapper();

	}





	createEmptyGridBlock(rowArrayContent) {

		const roomWrapper = document.getElementById("room-wrapper");

		const empty = rowArrayContent === 0 || rowArrayContent === 9000;
		const isRowNumberBlock = rowArrayContent > 9000 && rowArrayContent < 9200;

		if (empty || isRowNumberBlock) {
			const gridDiv = document.createElement('div');
			gridDiv.classList.add('gridBlocks');

			if (isRowNumberBlock) {
				const rowNumber = rowArrayContent - 9000;
				gridDiv.innerHTML = rowNumber;
				gridDiv.classList.add('rowNumberBlocks');
			}
			roomWrapper.append(gridDiv);
		}
	}





	createSeatGridBlock(rowArrayContent, rowNumber, seatNumber) {
		const roomWrapper = document.getElementById("room-wrapper");
		roomWrapper.classList.add('wrapperFlex');

		const singleSeatSVG = `${TheatreRoom.seatImgPath}/singleSeat.svg`;
		const duoSeatSVG = `${TheatreRoom.seatImgPath}/duoSeat.svg`;

		const buttonElement = document.createElement('button');
		// buttonElement.classList.add('seats');

		// create an img element for a seat image
		const imgElement = document.createElement('img');
		imgElement.classList.add('seatImg');

		if (rowArrayContent === 1) {// set image for single seats
			imgElement.src = singleSeatSVG;
			buttonElement.classList.add('singleSeat', 'seat');
			buttonElement.dataset.seattype = 'singleSeat', 'seat';
		}
		else if (rowArrayContent === 1001) {// set image for duo seats
			imgElement.src = duoSeatSVG;
			buttonElement.classList.add('duoSeat', 'seat');
			buttonElement.dataset.seattype = 'duoSeat';
		}

		// create dataset seatNumber/rowNumber format
		buttonElement.dataset.seatRow = `${seatNumber}/${rowNumber}`;

		// append the img element to the button element
		buttonElement.append(imgElement);

		// append the entire button element with image element to the grid
		roomWrapper.append(buttonElement);
	}





	addEventListenerToRoomWrapper() {

		const roomWrapper = document.getElementById("room-wrapper");

		roomWrapper.addEventListener('mouseover', (event) => {
			const targetSeat = event.target.closest('.seat');
			if (!targetSeat) return;
			this.handleMouseEvents('mouseover', targetSeat);
		});

		roomWrapper.addEventListener('mouseout', (event) => {
			const targetSeat = event.target.closest('.seat');
			if (!targetSeat) return;
			this.handleMouseEvents('mouseout', targetSeat);
		});

		roomWrapper.addEventListener('click', (event) => {
			const targetSeat = event.target.closest('.seat');
			if (!targetSeat) return;
			this.handleMouseEvents('click', targetSeat);
		});
	}





	handleMouseEvents(eventType, button) {
		const seatIMG = button.children[0];// seat img
		const seatType = button.dataset.seattype;
		const seatrowDATA = button.dataset.seatRow;
		const [seatNR, seatROW] = seatrowDATA.split('/');
		const seatNumber = parseInt(seatNR);
		const seatRow = parseInt(seatROW);

		if (eventType === 'mouseover') {

			seatIMG.classList.add('seat-status-hover');

			// TOOLTIP
			// document.addEventListener('mousemove', (e) => this.updateTooltipPosition(e));
			// this.displayTooltip('block', seatNumber, seatRow, seatType);

		}

		else if (eventType === 'mouseout') {

			seatIMG.classList.remove('seat-status-hover');

			// TOOLTIP
			// this.displayTooltip('none', '', '', '');
			// document.removeEventListener('mousemove', (e) => this.updateTooltipPosition(e));

		}

		else if (eventType === 'click') {
			seatIMG.classList.toggle('seat-status-selected');
		}

	}





	// renderMovieHeader() {
		// const movieHeader = document.getElementById('movie-header');
		// const headerImageElement = document.createElement('img');
		// headerImageElement.classList.add('movie-poster');

		// const headerImage = `${TheatreRoom.posterImgPath}/Interstellar.jpg`;
		// headerImageElement.src = headerImage;

		// movieHeader.style.background = "linear-gradient(to bottom, transparent, blue), url('path/to/your/image.jpg')";
		// movieHeader.style.backgroundSize = "cover";
		// movieHeader.style.backgroundPosition = "center";

		// movieHeader.append(headerImageElement);
	// }





	updateTooltipPosition(e) {
		var offsetX = 20;
		var offsetY = -80;
		const tooltip = document.getElementById('tooltip');
		tooltip.style.left = (e.pageX + offsetX) + 'px';
		tooltip.style.top = (e.pageY + offsetY) + 'px';
	}





	displayTooltip(displayState, seatValue, rowValue, seatType) {
		const tooltip = document.getElementById('tooltip');
		tooltip.style.display = displayState;
		tooltip.innerHTML = `Seat: ${seatValue}<br>Row: ${rowValue}<br>Type: ${seatType}`;
	}

}