"use strict";

import {Calendar} from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import listPlugin from '@fullcalendar/list';

document.addEventListener('DOMContentLoaded', function () {
	const calendarElement = document.getElementById('calendar');
	let currentEventData = {};
	if (calendarElement) {
		const calendar = new Calendar(calendarElement, {
			plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
			initialView: 'timeGridDay',
			slotLabelFormat: {
				hour: '2-digit',
				minute: '2-digit',
				hour12: false
			},
			slotMinTime: "08:00:00",
			slotMaxTime: "24:00:00",
			nextDayThreshold: '08:00:00',//When an event’s end time spans into another day, the minimum time it must be in order for it to render as if it were on that day.
			selectable: true,
			editable: true,
			firstDay: 1,
			eventTimeFormat: { // like '14:30:00'
				hour: '2-digit',
				minute: '2-digit',
				hour12: false,
				meridiem: false
			},
			displayEventTime: true,
			displayEventEnd: true,
			events: '/admin/calendar/events',
			eventOrderStrict: true,
			eventOrder: 'screen_number',
			eventDidMount: function (info) {
				info.el.setAttribute('title', info.event.title);
				info.el.setAttribute('data-is_public', info.event.extendedProps.is_public);

				// Get the 'is_public' value from extendedProps
				const isPublic = info.event.extendedProps.is_public;

				// If 'is_public' is false, set the opacity to 50% (0.5)
				if (!isPublic) {
					// Adjust the color opacity
					info.event.setProp('textColor', '#000000');
					info.el.style.opacity = '0.7';
					info.el.style.backgroundColor = '#cccccc';
					info.el.style.borderColor = '#aaaaaa';
				} else {
					// Make sure the opacity is 100% (if 'is_public' is true)
					info.el.style.opacity = '1';
				}

				info.el.style.width = `250px`; // set the width of each event

				// show screen_room
				const screenNumberElement = info.el.querySelector('.fc-event-title') || info.el;
				if (screenNumberElement) {
					const screenLabel = document.createElement('div');
					screenLabel.textContent = `${info.event.extendedProps.screen_number}`;
					screenLabel.style.fontSize = '1.4rem';
					screenLabel.style.fontWeight = 'bold';
					screenLabel.style.backgroundColor = '#33333390';
					screenLabel.style.borderRadius = '4px';
					screenLabel.style.padding = '4px 6px';
					screenLabel.style.marginRight = '6px';
					screenLabel.style.display = 'inline-block';
					screenNumberElement.prepend(screenLabel);
				}
			},
			select: function (info) {
				const createEventModal = document.getElementById('createEventModal');
				const form = document.getElementById('createEventForm');

				// Set the start time in the form
				form.start.value = info.startStr;

				// Show createEventModal
				createEventModal.style.display = 'block';
			},
			eventDrop: function (info) {
				console.log('Event moved:', info.event.title);
				// Update your event in the database here
			},
			eventResize: function (info) {
				console.log('Event resized:', info.event.title);
				// Update your event in the database here
			},
			eventClick: function (info) {
				const start = info.event.start;

				currentEventData = {
					screeningDate: start.toISOString().split('T')[0],
					screeningTime: start.toTimeString().split(' ')[0],
					screenNumber: info.event.extendedProps.screen_number,
					breakDuration: info.event.extendedProps.break_duration,
					isPublic: info.event.extendedProps.is_public
				}

				// Populate form with event data (you can map it to your form fields)
				const startInput = document.getElementById('start');
				const screenNumberInput = document.getElementById('screen_number');

				// Set the checkbox state directly using JavaScript
				const isPublicCheckbox = document.getElementById('is_public_forupdate');
				if (isPublicCheckbox) {
					isPublicCheckbox.checked = currentEventData.isPublic; // Set checkbox checked state
				}

				// const updateEventForm = document.getElementById('updateEventForm');
				const updateEventModal = document.getElementById('updateEventModal');
				updateEventModal.style.display = 'block';
			},
			headerToolbar: {
				left: 'prev,next today',
				center: 'title',
				right: 'timeGridWeek,timeGridDay,listWeek'
			}
		});
		calendar.render();

		// CREATE CALENDAR EVENT
		document.getElementById('createEventForm').addEventListener('submit', async function (e) {
			e.preventDefault();

			const form = e.target;
			const start = new Date(form.start.value);
			const durationInMinutes = 120; // temp duration
			const end = new Date(start.getTime() + durationInMinutes * 60000);

			const payload = {
				start: form.start.value,
				end: end.toISOString(),
				movie_id: form.movie_id.value,
				screen_number: form.screen_number.value,
				break_duration: form.break_duration.value,
				is_public: document.getElementById('is_public').checked ? 1 : 0 // checkbox
			};

			try {
				const data = await callScreeningController('/admin/calendar/create', 'POST', payload);
				console.log('Saved:', data);
				document.getElementById('createEventModal').style.display = 'none';
				calendar.refetchEvents();
			} catch (error) {
				alert('Failed to save event!');
			}
		});

		// UPDATE CALENDAR EVENT
		document.getElementById('updateEventForm').addEventListener('submit', async function (e) {
			e.preventDefault();
			
			if (!currentEventData?.screeningDate || !currentEventData?.screeningTime || !currentEventData?.screenNumber) {
				alert('Invalid event data');
				return;
			}

			const updatePayload = {
				screening_date: currentEventData.screeningDate,
				screening_time: currentEventData.screeningTime,
				screen_number: currentEventData.screenNumber,
				is_public: document.getElementById('is_public_forupdate').checked ? 1 : 0 // checkbox
			};
			console.log(updatePayload);

			try {
				const data = await callScreeningController('/admin/calendar/update', 'PUT', updatePayload);
				console.log('Updated:', data);
				document.getElementById('updateEventModal').style.display = 'none';
				calendar.refetchEvents();
			} catch (error) {
				console.error('Update failed:', error);
				alert('Failed to update event!');
			}
		});

		// DELETING CALENDAR EVENT
		let deletePayload = {};
		document.getElementById('deleteEventForm').addEventListener('submit', async function (e) {
			e.preventDefault();

			if (!currentEventData.screeningDate || !currentEventData.screeningTime || !currentEventData.screenNumber) {
				alert('No event selected for deletion');
				return;
			}

			deletePayload = {
				screening_date: currentEventData.screeningDate,
				screening_time: currentEventData.screeningTime,
				screen_number: currentEventData.screenNumber,
			};

			document.getElementById('deleteConfirmModal').classList.remove('hidden');

		});

		// Confirm button handler
		document.getElementById('confirmDeleteBtn').addEventListener('click', async function () {
			if (!deletePayload) return;

			try {
				const data = await callScreeningController('/admin/calendar/delete', 'DELETE', deletePayload);
				if (data.success) {
					document.getElementById('updateEventModal').style.display = 'none';
					calendar.refetchEvents();
				} else {
					alert('Failed to delete event: ' + data.message);
				}
			} catch (error) {
				alert('Failed to delete event');
			} finally {
				deletePayload = null;
				document.getElementById('deleteConfirmModal').classList.add('hidden');
			}
		});

		// helper function
		async function callScreeningController(url, method, payload) {
			const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

			try {
				const response = await fetch(url, {
					method: method,
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': csrfToken
					},
					body: JSON.stringify(payload)
				});

				if (!response.ok) {
					// Ensure response.ok is checked before using response.json()
					const errorData = await response.json(); // This will contain the error message
					throw new Error(errorData.message || 'Request failed');
				}

				const data = await response.json();

				return data;
			} catch (error) {
				console.error(`${method} ${url} error:`, error);
				throw error;
			}
		}

		// Close createEventModal logic
		document.getElementById('closeCreateModalBtn').addEventListener('click', function () {
			document.getElementById('createEventModal').style.display = 'none';
		});

		// Close updateEventModal logic
		document.getElementById('closeUpdateModalBtn').addEventListener('click', function () {
			document.getElementById('updateEventModal').style.display = 'none';
		});

		// Cancel button handler
		document.getElementById('cancelDeleteBtn').addEventListener('click', function () {
			deletePayload = null;
			document.getElementById('deleteConfirmModal').classList.add('hidden');
		});
	}
});