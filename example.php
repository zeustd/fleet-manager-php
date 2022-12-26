<?php
include('FleetManager.php');

$db_conn = new mysqli("localhost", "user", "password", "database");

//An instance of the FleetManager class
$fleet_manager = new FleetManager($db_conn);

//you can use the addVehicle method to add a new vehicle to the fleet:
$vehicle_id = $fleet_manager->addVehicle("Honda", "Accord", 2020, "123456789ABCDEFG");

//you can use the editVehicle method to edit a vehicle in the fleet.
$fleet_manager->editVehicle(1, make='Ford', year=2022);

//You can also use the getFleet method to retrieve a list of all vehicles in the fleet:
$fleet = $fleet_manager->getFleet();
foreach ($fleet as $vehicle) {
  echo $vehicle['year'] . " " . $vehicle['make'] . " " . $vehicle['model'] . "\n";
}

// record a gas purchase for the vehicle
$purchase_id = $fleetManager->recordGasPurchase($vehicle_id, "2022-12-15", 1234, 50.75, '{"gallons": 10}', "gas");

//get paginated gas purchase for the vehicle
$page = 1;
$perPage = 10;
$purchases = getPaginatedGasPurchases($conn, $page, $perPage);

// record a registration or renewal entry for the vehicle
$fleetManager->recordRegistrationData(123, 'ABC123', '2022-01-01', '2023-01-01');

// record a maintenance event for vehicle with id 1
$vehicle_id = 1;
$date = "2022-12-15";
$odometer = 123450;
$description = "Oil change";
$cost = 45.99;
$type = "regular";
$maintenance_id = $fleetManager->recordMaintenance($vehicle_id, $date, $odometer, $description, $cost, $type);

// set a maintenance interval for the vehicle
$fleetManager->setMaintenanceInterval($vehicle_id, "Oil Change", 5000, 3000);

// add some digital documents to the vehicle
$fleetManager->manageDigitalDocuments($vehicle_id, "Insurance Certificate", "insurance_certificate.pdf");
$fleetManager->manageDigitalDocuments($vehicle_id, "Registration Form", "registration_form.pdf");
$fleetManager->manageDigitalDocuments($vehicle_id, "Owner's Manual", "owners_manual.pdf");

// record an accident for the vehicle
$fleetManager->recordAccident($vehicle_id, "2022-12-15", "Highway 101", "Rear-ended by another vehicle", 500);


// record GPS tracking data for a vehicle
$uniqueId = '12345';
$fix_time = '2022-12-16 14:30:00';
$latitude = 37.12345;
$longitude = -122.54321;
$speed = 65.4;
$heading = 180;
$ignition = true;
$attributes = (object) [
  'ignition' => $ignition
];

$fleetManager->recordGpsTrackingData($uniqueId, $fix_time, $latitude, $longitude, $speed, $heading, $attributes);

?>
