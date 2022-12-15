<?php

// include the FleetManager class
include "FleetManager.php";

// create a new FleetManager instance and pass in a database connection
$fleetManager = new FleetManager($db_conn);

// get the HTTP method, path, and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

// retrieve the resource and id (if any) from the request
$resource = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
$id = array_shift($request);

// set the default HTTP response code to 404 (not found)
$code = 404;

// handle the different HTTP methods
switch ($method) {
  case 'GET':
    if ($resource == "vehicles") {
      // get a list of all vehicles in the fleet
      $code = 200;
      $response = $fleetManager->getFleet();
    } else {
      // return an error if the endpoint is not found
      $code = 404;
      $response = array("error" => "Endpoint not found");
    }
    break;
  default:
    // return an error if the HTTP method is not supported
    $code = 405;
    $response = array("error" => "Method not allowed");
    break;
}

?>
