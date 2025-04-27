# MovieTheatreBookingSystem
Created with Laravel.

> Note: This project was created during an academic challenge where I explored and applied the Laravel framework by building a practical, hands-on application.  
> This project is still under development and may receive further improvements and features in the future.  

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
<br/>

### 2. Screening Scheduler (in progress)
- Visual calendar interface for administrators to create and manage screenings.<br/>

<p align="left">
  <a href="https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_calendar_1.jpg?raw=true">
    <img src="https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_calendar_1.jpg?raw=true" width="150" style="margin-right: 20px;" />
  </a>
  <a href="https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_calendar_2.jpg?raw=true">
    <img src="https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_calendar_2.jpg?raw=true" width="150" style="margin-right: 20px;" />
  </a>
  <a href="https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_calendar_3.jpg?raw=true">
    <img src="https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_calendar_3.jpg?raw=true" width="150" />
  </a>
</p>
<br/>
Thank you for taking an interest!
