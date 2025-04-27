# MovieTheatreBookingSystem
Created with Laravel.  

> Note: This project was created during an academic challenge where I explored and applied the Laravel framework by building a practical, hands-on application.  

*App preview 1*  
<a href="https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_app_1.jpg?raw=true">
  <img src="https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_app_1.jpg?raw=true" width="400"/>
</a>  

[App preview 2](https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_app_2.jpg?raw=true)  
[App preview 3](https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_app_3.jpg?raw=true)

## Motivation
I decided to create a booking system similar to those used by cinemas like Kinepolis. The seat selection page was especially intriguing, as it combined dynamic UI elements with backend logic to manage seat availability and reservations.  
Through this project, I’ve gained valuable insights into how Laravel works and am excited to continue refining the application with more features in the future.

## Features

### 1. Seat selection
The application currently supports four distinct screening rooms, each featuring a unique seating configuration.  
Dynamic seating logic ensures that each room's availability is accurately managed, with seamless reservation handling based on layout.  

Room layouts are configured using predefined blueprints, which can be found in [`app/Enums/GridBlueprint.php`](https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/app/Enums/GridBlueprint.php), allowing for flexible room configuration and easy future expansion.

*App preview 4*  
<a href="https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_seats_1.jpg?raw=true">
  <img src="https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_seats_1.jpg?raw=true" width="400"/>
</a>

### 2. Screening calendar
The Screening Calendar acts as a visual **Database Management System (DBMS)** interface, allowing administrators to intuitively schedule and manage movie screenings across different rooms and times.  
It automatically calculates each movie’s duration and required breaks, while preventing scheduling conflicts by ensuring no overlapping screenings occur.  
All changes made through the calendar are synchronized with the backend database in real time for accurate and up-to-date management.

*Calendar preview 1*  
<a href="https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_calendar_1.jpg?raw=true">
  <img src="https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_calendar_1.jpg?raw=true" width="400"/>
</a>  

[Calendar preview 2](https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_calendar_2.jpg?raw=true)  
[Calendar preview 3](https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_calendar_3.jpg?raw=true)  
  
Thank you for taking an interest!
