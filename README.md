# TheatreBookingSystem
A theatre ticket booking system created with Laravel.

> Note: This project was created during an academic challenge where I explored and applied the Laravel framework by building a practical, hands-on application.  
> This project is still under development and may receive further improvements and features in the future.  

## Motivation
I chose to create a ticket booking system similar to the one used by cinemas like Kinepolis. I found the seat selection page particularly fascinating, as it required a combination of dynamic UI and backend logic to handle seat availability and reservations.  
Through this project, I’ve gained valuable insight into how such systems work, and I’m excited to continue refining this application with more features.

## Features
The application currently accommodates four distinct screening rooms, each with its own layout and seating configuration.  
The seating logic is dynamic, enabling the system to handle reservations and availability per room layout.

Thank you for taking an interest!

### Screenshot
<a href="https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_room.jpg?raw=true">
  <img src="https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/public/images/screenshots/screenshot_room.jpg?raw=true" width="300"/>
</a>

The layout logic is driven by predefined blueprints located in [`config/gridblueprints.php`](https://github.com/EnsoVanPoucke/TheatreBookingSystem/blob/main/config/gridblueprints.php), allowing for flexible room configuration and easy future expansion.
