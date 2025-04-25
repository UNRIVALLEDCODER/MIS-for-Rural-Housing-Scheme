<?php
// Check if the 'data' parameter is set in the URL
if (isset($_GET['data'])) {
  header('Content-Type: application/json'); // Set the response type to JSON
  $conn = new mysqli("localhost", "root", "", "housing_mis"); // Connect to the database
  $sql = "SELECT name, lat, lng, status FROM beneficiaries"; // Query to fetch beneficiary data
  $result = $conn->query($sql);

  $houses = []; // Array to store the fetched data
  while($row = $result->fetch_assoc()) {
    $houses[] = $row; // Add each row to the array
  }
  echo json_encode($houses); // Return the data as JSON
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>GIS Map - Rural Housing</title> <!-- Title of the GIS map page -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" /> <!-- Leaflet CSS for map styling -->
  <style>
    #map { height: 500px; } /* Set the height of the map container */
  </style>
</head>
<body>
  <h2>Rural Housing Location Map</h2> <!-- Page title -->
  <div id="map"></div> <!-- Map container -->

  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script> <!-- Leaflet JS for map functionality -->
  <script>
    const map = L.map('map').setView([23.5937, 80.9629], 5); // Initialize the map with a center and zoom level
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map); // Add OpenStreetMap tiles

    // Fetch beneficiary data from the server
    fetch('?data=1')
      .then(res => res.json())
      .then(data => {
        data.forEach(house => {
          // Add a marker for each beneficiary
          L.marker([house.lat, house.lng])
            .addTo(map)
            .bindPopup(`<b>${house.name}</b><br>Status: ${house.status}`); // Display beneficiary details in a popup
        });
      });
  </script>
</body>
</html>

