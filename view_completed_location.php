<?php
include('db.php');
include('header.php');

ob_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Completed Location</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <style>
        #map {
            height: 700px;
            width: 100%;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 20px;
        }
        .map-wrapper {
            flex: 1;
            max-width: 800px;
        }
        .driver-info {
            flex: 1;
            max-width: 425px;
            height: 700px;
            background-color: #96D701;
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            font-size: 24px;
            overflow-y: auto;
            margin-right: -200px;
        }
        .driver-info .profile {
            display: flex;
            align-items: center;
            margin-bottom: 16px;
        }
        .driver-info .profile img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-right: 16px;
        }
        .driver-info .profile .name {
            font-size: 20px;
            font-weight: bold;
            color: #151515;
        }
        .driver-info .profile .subtext {
            font-size: 16px;
            color: #333;
            font-style: italic;
        }
    </style>
</head>
<body>
    <main class="p-4">
        <h2 class="text-2xl text-[#FFFFFF] font-bold md:mt-[60px] md:mb-[50px] mt-[50px] text-center">Completed Location</h2>
        <input type="hidden" id="lat" value="<?php echo htmlspecialchars($latitude ?? '0'); ?>">
        <input type="hidden" id="lng" value="<?php echo htmlspecialchars($longitude ?? '0'); ?>">

        <div class="container">
            <div class="map-wrapper">
                <div id="map"></div>
            </div>
            <div class="driver-info">
            <?php
            if (isset($_GET['id'])) {
                $schedule_id = $conn->real_escape_string($_GET['id']);
                
                // Fetch completed schedule and driver information
                $sql = "SELECT s.*, d.driver_name, d.profile_picture 
                        FROM history_delivery s 
                        JOIN drivers d ON s.driver_name = d.driver_name 
                        WHERE s.schedule_id = '$schedule_id'";

                $result = $conn->query($sql);

                if ($result) {
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        
                        // Output schedule details
                        $driver_name = htmlspecialchars($row['driver_name']);
                        $driver_image = htmlspecialchars($row['profile_picture']);
                        $status = htmlspecialchars($row['status']);
                        $completed_at = htmlspecialchars($row['completed_at']); // Fetch completed_at field

                        echo "<div class='profile'>";
                        echo "<img src='$driver_image' alt='Profile Picture'>";
                        echo "<div>";
                        echo "<div class='name'>$driver_name</div>";
                        echo "<div class='subtext'>Bateriku Logistic Driver</div>";
                        echo "</div>";
                        echo "</div>";
                        
                        echo "<h3 class='text-xl font-semibold mb-4'>Driver Information</h3>";
                        echo "<p><strong>Start at:</strong> " . htmlspecialchars($row['start_at']) . "</p>";
                        echo "<p><strong>Completed At:</strong> " . htmlspecialchars($completed_at) . "</p>"; // Display completed_at
                        echo "<p><strong>Starting Point:</strong> " . htmlspecialchars($row['starting_point']) . "</p>";
                        echo "<p><strong>Destination Point:</strong> " . htmlspecialchars($row['destination_point']) . "</p>";
                        echo "<p><strong>Driver:</strong> $driver_name</p>";
                        echo "<p><strong>License Plate:</strong> " . htmlspecialchars($row['license_plate']) . "</p>";
                        echo "<p><strong>Unit Number:</strong> " . htmlspecialchars($row['unit_number']) . "</p>";

                        // Fetch location data for the destination point
                        $destination_point = $row['destination_point'];
                        $sql_location = "SELECT latitude, longitude FROM location WHERE destination_point = '$destination_point'";

                        $result_location = $conn->query($sql_location);

                        if ($result_location && $result_location->num_rows > 0) {
                            $location = $result_location->fetch_assoc();
                            $latitude = $location['latitude'];
                            $longitude = $location['longitude'];

                            // Ensure the variables are available for JS
                            echo "<script>document.getElementById('lat').value = " . json_encode($latitude) . ";</script>";
                            echo "<script>document.getElementById('lng').value = " . json_encode($longitude) . ";</script>";
                        } else {
                            $latitude = '0';
                            $longitude = '0';
                            echo "<p class='text-red-500'>Destination not found in the location database.</p>";
                        }

                        // Display the status of the delivery
                        echo "<p><strong>Status:</strong> $status</p>";
                    } else {
                        echo "<p class='text-red-500'>No data found for the selected schedule.</p>";
                    }
                } else {
                    echo "<p class='text-red-500'>Error executing query: " . $conn->error . "</p>";
                }
            } else {
                echo "<p class='text-red-500'>No schedule ID provided.</p>";
            }
            ?>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var warehouseLat = 3.1094127039678168;
            var warehouseLng = 101.5584039718389;
            var destinationLat = parseFloat(document.getElementById('lat').value);
            var destinationLng = parseFloat(document.getElementById('lng').value);

            if (!isNaN(destinationLat) && !isNaN(destinationLng) && destinationLat !== 0 && destinationLng !== 0) {
                var map = L.map('map').setView([warehouseLat, warehouseLng], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                L.marker([warehouseLat, warehouseLng]).addTo(map)
                    .bindPopup('Warehouse')
                    .openPopup();

                L.marker([destinationLat, destinationLng]).addTo(map)
                    .bindPopup('Destination')
                    .openPopup();

                var route = L.polyline([[warehouseLat, warehouseLng], [destinationLat, destinationLng]], {
                    color: 'blue',
                    weight: 3,
                    opacity: 0.7,
                    smoothFactor: 1
                }).addTo(map);

                map.fitBounds(route.getBounds());
            } else {
                document.getElementById('map').innerHTML = '<p class="text-red-500">Unable to display map. Coordinates not found.</p>';
            }
        });
    </script>

    <?php include('footer.php'); ?>
</body>
</html>

<?php
// End output buffering and flush output
ob_end_flush();
?>
