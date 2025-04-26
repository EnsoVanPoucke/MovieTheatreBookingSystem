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
					isPublic: info.event.extendedProps.is_public
				}

				// Populate form with event data (you can map it to your form fields)
				const startInput = document.getElementById('start');
				const screenNumberInput = document.getElementById('screen_number');

				// if (startInput && screenNumberInput) {
				// 	console.log('both inputs are ok.');
				// 	startInput.value = currentEventData.screeningDate;
				// 	screenNumberInput.value = currentEventData.screenNumber;
				// } else {
				// 	console.log('Error: Input fields not found.');
				// }




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

		// UPDATING THE EVENT:
		document.getElementById('updateEventForm').addEventListener('submit', function (e) {
			e.preventDefault(); // Prevent the form from submitting normally

			console.log(e.target);
			const payload = {
				screening_date: currentEventData.screeningDate,
				screening_time: currentEventData.screeningTime,
				screen_number: currentEventData.screenNumber,
				is_public: currentEventData.isPublic
			};

			console.log(payload);


			// // Optional: Populate the is_public field if you have a checkbox or other element for it
			// const isPublicCheckbox = document.getElementById('is_public');
			// if (isPublicCheckbox) {
			// 	isPublicCheckbox.checked = currentEventData.isPublic;  // Set checkbox state based on is_public
			// }




			// fetch('/admin/calendar/update', {
			// 	method: 'POST',  // Use POST to update data
			// 	headers: {
			// 		'Content-Type': 'application/json',
			// 		'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content  // CSRF token for security
			// 	},
			// 	body: JSON.stringify(payload)  // Send the updated data as JSON
			// })
			// 	.then(response => response.json())  // Handle the server response
			// 	.then(data => {
			// 		if (data.success) {
			// 			// If the update is successful, refetch the events to reflect the changes
			// 			calendar.refetchEvents();
			// 			alert('Event updated successfully!');
			// 			document.getElementById('updateEventModal').style.display = 'none'; // Close the modal
			// 		} else {
			// 			alert('Failed to update event: ' + data.message);  // Show error message
			// 		}
			// 	})
			// 	.catch(error => {
			// 		console.error('Error updating event:', error);
			// 		alert('An error occurred while updating the event.');
			// 	});
		});


		// DELETING THE EVENT:
		document.getElementById('deleteEventForm').addEventListener('submit', function (e) {
			e.preventDefault();

			if (!currentEventData.screeningDate || !currentEventData.screeningTime || !currentEventData.screenNumber) {
				alert('No event selected for deletion');
				return;
			}

			const payload = {
				screening_date: currentEventData.screeningDate,
				screening_time: currentEventData.screeningTime,
				screen_number: currentEventData.screenNumber,
			};

			if (confirm('Are you sure you want to delete this event?')) {
				fetch('/admin/calendar/delete', {
					method: 'DELETE',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
					},
					body: JSON.stringify(payload)
				})
					.then(response => response.json())
					.then(data => {
						if (data.success) {
							document.getElementById('updateEventModal').style.display = 'none';
							calendar.refetchEvents();
						} else {
							alert('Failed to delete event: ' + data.message);
						}
					})
					.catch(error => {
						console.error('Delete error:', error);
					});
			}
		});

		// Form submission handler
		document.getElementById('createEventForm').addEventListener('submit', function (e) {
			e.preventDefault();

			const form = e.target;

			const start = new Date(form.start.value);
			const durationInMinutes = 120; // or whatever your movie duration is
			const end = new Date(start.getTime() + durationInMinutes * 60000);

			// Explicitly check the checkbox value and set is_public accordingly
			const isPublic = document.getElementById('is_public').checked ? 1 : 0;

			const payload = {
				start: form.start.value,
				end: end.toISOString(),
				movie_id: form.movie_id.value,
				screen_number: form.screen_number.value,
				is_public: isPublic
			};

			fetch('/admin/calendar/create', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
				},
				body: JSON.stringify(payload)
			})
				.then(response => response.json())
				.then(data => {
					console.log('Saved:', data);
					document.getElementById('createEventModal').style.display = 'none';
					calendar.refetchEvents();
				})
				.catch(error => {
					console.error('Error:', error);
				});
		});

		// Close createEventModal logic
		document.getElementById('closeCreateModalBtn').addEventListener('click', function () {
			document.getElementById('createEventModal').style.display = 'none';
		});

		// Close updateEventModal logic
		document.getElementById('closeUpdateModalBtn').addEventListener('click', function () {
			document.getElementById('updateEventModal').style.display = 'none';
		});
	}
});































// eventDidMount: function (info) {
// 	const screen = info.event.extendedProps.screen_number;

// 	// Set tooltip
// 	info.el.setAttribute('title', `Screen ${screen} - ${info.event.title}`);

// 	// Optional: Custom display inside the event box
// 	const titleEl = info.el.querySelector('.fc-event-title') || info.el;

// 	if (titleEl) {
// 		const screenLabel = document.createElement('div');
// 		screenLabel.textContent = `Screen ${screen}`;
// 		screenLabel.style.fontSize = '0.75rem';
// 		screenLabel.style.fontWeight = 'bold';
// 		screenLabel.style.backgroundColor = '#eee';
// 		screenLabel.style.borderRadius = '4px';
// 		screenLabel.style.padding = '2px 4px';
// 		screenLabel.style.marginBottom = '2px';
// 		screenLabel.style.display = 'inline-block';

// 		titleEl.prepend(screenLabel);
// 	}
// },