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
$batteryLevel = $data->position->attributes->batteryLevel;
$motion = $data->position->attributes->motion;
$type = $data->position->attributes->type;
$event = $data->position->attributes->event;
$raw = $data->position->attributes->raw;
$latitude = $data->position->latitude;
$longitude = $data->position->longitude;
$course = $data->positon->course;
$deviceId = $data->device->id;
$deviceName = $data->device->name;
$uniqueId = $data->device->uniqueId;
$deviceStatus = $data->device->status;
$protocol = $data->position->protocol;

$attributes = (object) [
  'ignition' => $ignition,
  'battery' => $battery
];

$fleetManager->recordGpsTrackingData($uniqueId, $fixTime, $latitude, $longitude, $speed, #course, $attributes);
?>
