<?php

class FleetManager {
  private $conn; // database connection object

  // constructor
  public function __construct($db_conn) {
    $this->conn = $db_conn;
  }

  // method to add a new vehicle to the fleet
  public function addVehicle($make, $model, $year, $vin) {
    $query = "INSERT INTO fleet (make, model, year, vin) VALUES (?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ssis", $make, $model, $year, $vin);
    $stmt->execute();
    return $stmt->insert_id;
  }

  // method to get a list of all vehicles in the fleet
  public function getFleet() {
    $query = "SELECT * FROM fleet";
    $result = $this->conn->query($query);
    $fleet = array();
    while ($row = $result->fetch_assoc()) {
      $fleet[] = $row;
    }
    return $fleet;
  }
  
  public function recordGasPurchase($vehicle_id, $date, $odometer, $cost, $attributes, $product) {
    $query = "INSERT INTO purchases (vehicle_id, date, odometer, cost, attributes, product) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("isids", $vehicle_id, $date, $odometer, $cost, $attributes, $product);
    $stmt->execute();
    return $stmt->insert_id;
  }
  
  
}

?>
