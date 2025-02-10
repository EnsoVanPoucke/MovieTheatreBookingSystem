"use strict";
// main.js

import {TheatreRoom} from './classes/TheatreRoom.js';

function createRoomLayout() {
	const date = 20240429;
	const time = {h: 16, m: 30};
	const title = 'Inglourious Basterds';
	const duration = 142;
	const layoutNumber = 3; // Choose roomlayout here
	const movie = new TheatreRoom(date, time, title, duration, layoutNumber);
};

document.addEventListener('DOMContentLoaded', () => {
	createRoomLayout();
});