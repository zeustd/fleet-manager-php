<?php
include('FleetManager-class.php');

$db_conn = new mysqli("localhost", "user", "password", "database");

//An instance of the FleetManager class
$fleet_manager = new FleetManager($db_conn);

//you can use the addVehicle method to add a new vehicle to the fleet:
$vehicle_id = $fleet_manager->addVehicle("Honda", "Accord", 2020, "123456789ABCDEFG");

//You can also use the getFleet method to retrieve a list of all vehicles in the fleet:
$fleet = $fleet_manager->getFleet();
foreach ($fleet as $vehicle) {
  echo $vehicle['year'] . " " . $vehicle['make'] . " " . $vehicle['model'] . "\n";
}

// record a gas purchase for the vehicle
$purchase_id = $fleetManager->recordGasPurchase($vehicle_id, "2022-12-15", 1234, 50.75, '{"gallons": 10}', "gas");

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

?>
