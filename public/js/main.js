"use strict";
// main.js

import {TheatreRoom} from './classes/TheatreRoom.js';

export function createRoomLayout(roomNumber) {
	const date = 20240429;
	const time = {h: 16, m: 30};
	const title = 'Inglourious Basterds';
	const duration = 142;
	const layoutNumber = roomNumber; // Choose roomlayout here
	const movie = new TheatreRoom(date, time, title, duration, layoutNumber);
};