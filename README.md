# MovieTheatreBookingSystem
Created with Laravel.  

> Note: This project was created during an academic challenge where I explored and applied the Laravel framework by building a practical, hands-on application.  
> This project is still under development and may receive further improvements and features in the future.<br/>

<a href="https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_app_1.jpg?raw=true">
  <img src="https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_app_1.jpg?raw=true" width="400"/>
</a><br/>
![Screenshot app 2](https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_app_2.jpg?raw=true)<br/>
![Screenshot app 3](https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_app_3.jpg?raw=true)

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
The Screening Calendar is an intuitive, visual interface designed for administrators to easily create, manage, and schedule movie screenings across different screens and times. The calendar is tightly integrated with the system’s backend, automatically adjusting to the length of the movie and required breaks.

[Screenshot calendar 1](https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_calendar_1.jpg?raw=true)<br/>
[Screenshot calendar 2](https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_calendar_2.jpg?raw=true)<br/>
[Screenshot calendar 3](https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_calendar_3.jpg?raw=true)
<br/>
<br/>
Thank you for taking an interest!
