<?php
include('FleetManager.php');

$db_conn = new mysqli("localhost", "user", "password", "database");

$json = file_get_contents('php://input');
$data = json_decode($json);


$position = $data->position;
$device = $data->device;
$positionId = $data->position->id;
$fixTime = $data->position->fixTime;
$battery = $data->position->attributes->battery;
$ignition = $data->position->attributes->ignition;
$motion = $data->position->attributes->motion;
$latitude = $data->position->latitude;
$longitude = $data->position->longitude;
$course = $data->positon->course;
$deviceId = $data->device->id;
$uniqueId = $data->device->uniqueId;

$attributes = (object) [
  'ignition' => $ignition,
  'battery' => $battery,
  'motion' => $motion
];

$fleetManager->recordGpsTrackingData($uniqueId, $fixTime, $latitude, $longitude, $speed, #course, $attributes);
?>
