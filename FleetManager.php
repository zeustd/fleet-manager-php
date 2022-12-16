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
  
  function getPaginatedGasPurchases($conn, $page, $perPage) {
  $query = "SELECT * FROM purchases LIMIT ?, ?";
  $stmt = $conn->prepare($query);
  $offset = ($page - 1) * $perPage;
  $stmt->bind_param("ii", $offset, $perPage);
  $stmt->execute();
  $result = $stmt->get_result();
  $purchases = [];
  while ($row = $result->fetch_assoc()) {
    $purchases[] = $row;
  }
  return $purchases;
}
  
  public function recordMaintenance($vehicle_id, $date, $odometer, $description, $cost, $type) {
    $query = "INSERT INTO maintenance (vehicle_id, date, odometer, description, cost, type) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("isisd", $vehicle_id, $date, $odometer, $description, $cost, $type);
    $stmt->execute();
    return $stmt->insert_id;
  }
  
  public function setMaintenanceInterval($vehicle_id, $maintenance_type, $start, $interval) {
    $query = "INSERT INTO maintenance_intervals (vehicle_id, maintenance_type, start, interval) VALUES (?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("isii", $vehicle_id, $maintenance_type, $start, $interval);
    $stmt->execute();
    return $stmt->insert_id;
  }
  
  public function manageDigitalDocuments($vehicle_id, $document_type, $file_name) {
    // insert the document into the database
    $query = "INSERT INTO vehicle_documents (vehicle_id, document_type, file_name) VALUES (?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("iss", $vehicle_id, $document_type, $file_name);
    $stmt->execute();
  }

  public function recordAccident($vehicle_id, $date, $location, $description, $cost) {
    $query = "INSERT INTO accidents (vehicle_id, date, location, description, cost) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("isssd", $vehicle_id, $date, $location, $description, $cost);
    $stmt->execute();
    return $stmt->insert_id;
  }

  
}

?>
