"use strict";

import {Calendar} from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import listPlugin from '@fullcalendar/list';

document.addEventListener('DOMContentLoaded', function () {
	const calendarElement = document.getElementById('calendar');
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

			eventDidMount: function (info) {
				info.el.setAttribute('title', info.event.title);
			},
			select: function (info) {
				const modal = document.getElementById('createEventModal');
				const form = document.getElementById('createEventForm');

				// Set the start time in the form
				form.start.value = info.startStr;

				// Show modal
				modal.style.display = 'block';
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
				if (confirm('Are you sure you want to delete this event?')) {
					const start = info.event.start;
					const screeningDate = start.toISOString().split('T')[0];
					const screeningTime = start.toTimeString().split(' ')[0]; // ← this is the key!
					const screenNumber = info.event.extendedProps.screen_number;

					// fetch(`/admin/calendar/delete/${screeningDate}/${screeningTime}/${screenNumber}`, {
					fetch('/admin/calendar/delete', {
						method: 'DELETE',
						headers: {
							'Content-Type': 'application/json',
							'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
						},
						body: JSON.stringify({
							screening_date: info.event.start.toISOString().split('T')[0],
							screening_time: info.event.start.toTimeString().split(' ')[0],
							screen_number: info.event.extendedProps.screen_number
						})
					})
						.then(response => response.json())
						.then(data => {
							if (data.success) {
								calendar.refetchEvents();
							} else {
								alert('Failed to delete event: ' + data.message);
							}
						})
						.catch(error => {
							console.error('Delete error:', error);
						});
				}
			},
			headerToolbar: {
				left: 'prev,next today',
				center: 'title',
				right: 'timeGridWeek,timeGridDay,listWeek'
			}
		});
		calendar.render();

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

		// Close modal logic
		document.getElementById('closeModalBtn').addEventListener('click', function () {
			document.getElementById('createEventModal').style.display = 'none';
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