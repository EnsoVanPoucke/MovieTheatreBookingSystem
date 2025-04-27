# MovieTheatreBookingSystem
Created with Laravel.  

> Note: This project was created during an academic challenge where I explored and applied the Laravel framework by building a practical, hands-on application.  
> This project is still under development and may receive further improvements and features in the future.<br/>

<a href="https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_app_1.jpg?raw=true">
  <img src="https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_app_1.jpg?raw=true" width="400"/>
</a><br/>

[screenshot app 2](https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_app_2.jpg?raw=true)<br/>
[screenshot app 3](https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_app_3.jpg?raw=true)

## Motivation
I decided to create a booking system similar to those used by cinemas like Kinepolis. The seat selection page was especially intriguing, as it combined dynamic UI elements with backend logic to manage seat availability and reservations.  
Through this project, I’ve gained valuable insights into how Laravel works and am excited to continue refining the application with more features in the future.

## Features

### 1. Seat selection
The application currently accommodates four distinct screening rooms, each with its own layout and seating configuration.
The seating logic is dynamic, allowing the system to manage reservations and seat availability based on each room's layout.  

Room layouts are defined using predefined blueprints, which can be found in [`app/Enums/GridBlueprint.php`](https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/app/Enums/GridBlueprint.php), allowing for flexible room configuration and easy future expansion.

<p align="left">(GridBlueprints in view)<br>
<a href="https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_seats_1.jpg?raw=true">
  <img src="https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_seats_1.jpg?raw=true" width="400"/>
</a>
</p>

### 2. Screening calendar (in progress)
The Screening Calendar functions as a visual Database Management System (DBMS) interface for movie screenings, allowing administrators to manage showtimes directly through an intuitive calendar.<br/>
It is tightly integrated with the system’s backend, automatically calculating the movie’s duration and required breaks (such as cleaning or intermissions) to schedule screenings efficiently.<br/>
Every change made through the calendar is synchronized with the backend database in real-time, ensuring conflict-free scheduling and accurate management of all showtimes across different screens.

<a href="https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_calendar_1.jpg?raw=true">
  <img src="https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_calendar_1.jpg?raw=true" width="400"/>
</a><br/>

[screenshot calendar 2](https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_calendar_2.jpg?raw=true)<br/>
[screenshot calendar 3](https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_calendar_3.jpg?raw=true)
<br/>
<br/>
Thank you for taking an interest!
