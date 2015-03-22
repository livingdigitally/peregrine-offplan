<?php
include_once 'googlePlaces.php';

$apiKey       = 'AIzaSyDQ98MyajG58-7ufYr_GNkHGWQ40p6a_k4';
$googlePlaces = new googlePlaces($apiKey);

// Set the longitude and the latitude of the location you want to search near for places
$latitude   = '53.3147150';
$longitude = '-2.2444210';
$googlePlaces->setLocation($latitude . ',' . $longitude);

$googlePlaces->setRadius(5000);
$searchResults = $googlePlaces->Search();

$results = $searchResults['result'];

foreach ($results as $each_result) {
  $name = $each_result['name'];
  echo "<br>Ammenity: $name";
  echo ", Type = ";
  $types = $each_result['types'];
  foreach ($types as $type) {
    echo "$type ";
  }
}

?>
