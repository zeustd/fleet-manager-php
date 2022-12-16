# fleet-manager-php
A minimalistic fleet manager class in PHP

Once you have an instance of the FleetManager class, you can use its methods to manage the fleet of vehicles.
For example, you can use the addVehicle method to add a new vehicle to the fleet:

You can also use the getFleet method to retrieve a list of all vehicles in the fleet:
This would print a list of all vehicles in the fleet, with each vehicle on a new line in the format "YEAR MAKE MODEL".


### Supported Features:
- Add Vehicle
- Get Fleet (Vehicles)
- Record Gas/Fuel Purchase
- - Get Gas/Fuel Purchase Records (Paginated)
- Record Maintenance
- Set Maintenance Reminders/Schedule
- Record Digital Documents
- Record Accidents
- GPS Tracking
- - Supports GPS Listener to recieve data from Traccar and record it against the vehicle
- - Add the trackers uniqueId against the vehicle in fleet record, and configure to forward location data to the gps.php script 

### Upcoming Features:
- - Get Maintenace Records (Paginated)
- - Get Maintenance Records (Paginated)
- - Get Maintenance Reminders (Paginated)
- - Get Digital Documents Records (Paginated)
- - Get Accident Records (Paginated)




## Notes
* The database schema is not optimized for large volume of data or production usage.
* This is only a sample concept project


