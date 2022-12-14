<?php
include('FleetManager-class.php');

$db_conn = new mysqli("localhost", "user", "password", "database");

//An instance of the FleetManager class
$fleet_manager = new FleetManager($db_conn);

//you can use the addVehicle method to add a new vehicle to the fleet:
$fleet_manager->addVehicle("Honda", "Accord", 2020, "123456789ABCDEFG");

//You can also use the getFleet method to retrieve a list of all vehicles in the fleet:
$fleet = $fleet_manager->getFleet();
foreach ($fleet as $vehicle) {
  echo $vehicle['year'] . " " . $vehicle['make'] . " " . $vehicle['model'] . "\n";
}


?>
