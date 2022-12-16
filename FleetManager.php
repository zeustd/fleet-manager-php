<?php

class FleetManager {
  private $conn; // database connection object

  // constructor
  public function __construct($db_conn) {
    $this->conn = $db_conn;
  }

  // method to add a new vehicle to the fleet
  public function addVehicle($make, $model, $year, $vin, $gps_tracking_id, $uniqueId) {
    $query = "INSERT INTO fleet (make, model, year, vin, gps_tracking_id, uniqueId) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ssisi", $make, $model, $year, $vin, $gps_tracking_id, $uniqueId);
    $stmt->execute();
    return $stmt->insert_id;
  }

  // method to get a list of all vehicles in the fleet
  public function getFleet($page, $perPage) {
    $query = "SELECT * FROM fleet LIMIT ?, ?";
    $stmt = $this->conn->prepare($query);
    $offset = ($page - 1) * $perPage;
    $stmt->bind_param("ii", $offset, $perPage);
    $stmt->execute();
    $result = $stmt->get_result();
    $fleet = array();
    while ($row = $result->fetch_assoc()) {
      $fleet[] = $row;
    }
    return $fleet;
  }
  
  // method to get vehicle id based on uniqueId
  public function getVehicleIdByUniqueId($uniqueId) {
    $query = "SELECT id FROM fleet WHERE uniqueId = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $uniqueId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['id'];
  }

  // method to update gps_tracking_id for a specific vehicle
  public function updateGpsTrackingId($vehicle_id, $gps_tracking_id) {
    $query = "UPDATE fleet SET gps_tracking_id = ? WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ii", $gps_tracking_id, $vehicle_id);
    $stmt->execute();
  }
  
    // method to record GPS tracking data for a vehicle
  public function recordGpsTrackingData($uniqueId, $fix_time, $latitude, $longitude, $speed, $heading, $attributes) {
    // get the vehicle id based on uniqueId
    $vehicle_id = $this->getVehicleIdByUniqueId($uniqueId);

    $query = "INSERT INTO gps_tracking (vehicle_id, fix_time, latitude, longitude, speed, heading, attributes) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("isddds", $vehicle_id, $fix_time, $latitude, $longitude, $speed, $heading, $attributes);
    $stmt->execute();
    $insert_id = $stmt->insert_id;

    // update the gps_tracking_id of the vehicle using the insert id
    $this->updateGpsTrackingId($vehicle_id, $insert_id);
  }
  
  public function recordGasPurchase($vehicle_id, $date, $odometer, $cost, $attributes, $product) {
    $query = "INSERT INTO purchases (vehicle_id, date, odometer, cost, attributes, product) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("isids", $vehicle_id, $date, $odometer, $cost, $attributes, $product);
    $stmt->execute();
    return $stmt->insert_id;
  }
  
  function getPaginatedGasPurchases($page, $perPage) {
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
