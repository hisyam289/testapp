<?php include('db.php'); ?>
<?php include('header.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Driver Location</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <style>
        #map {
            height: 490px;
            width: 100%;
            margin-top: 20px;
        }
        .container {
            display: grid;
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
            height: 550px;
            background-color: #96D701;
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            font-size: 24px;
            overflow-y: auto;
            margin-right: -10px;
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
        <h2 class="text-2xl text-[#FFFFFF] font-bold md:mt-[60px] md:mb-[50px] mt-[50px] text-center">Driver Location</h2>
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
                
                // Handle status updates if a phase is completed
                if (isset($_POST['action'])) {
                    $action = $_POST['action'];
                    $valid_actions = ['start', 'arrived', 'unload', 'complete'];
                    
                    if (in_array($action, $valid_actions)) {
                        $status = ucfirst($action); // Capitalize first letter

                        if ($action === 'complete') {
                            // Fetch schedule details
                            $sql_schedule = "SELECT * FROM schedules WHERE schedule_id = '$schedule_id'";
                            $result_schedule = $conn->query($sql_schedule);
                        
                            if ($result_schedule->num_rows > 0) {
                                $schedule = $result_schedule->fetch_assoc();
                                
                                // Insert data into history_delivery with schedule_id
                                $completed_at = (new DateTime('now', new DateTimeZone('Asia/Kuala_Lumpur')))->format('Y-m-d H:i:s');
                                $sql_history = "INSERT INTO history_delivery 
                                    (start_at, starting_point, destination_point, driver_name, license_plate, unit_number, status, completed_at, schedule_id)
                                    VALUES 
                                    ('" . $schedule['start_at'] . "', '" . $schedule['starting_point'] . "', '" . $schedule['destination_point'] . "', '" . $schedule['driver_name'] . "', '" . $schedule['license_plate'] . "', '" . $schedule['unit_number'] . "', 'Completed', '$completed_at', '$schedule_id')";
                                if ($conn->query($sql_history) === TRUE) {
                                    // Delete from schedules
                                    $sql_delete = "DELETE FROM schedules WHERE schedule_id = '$schedule_id'";
                                    if ($conn->query($sql_delete) === TRUE) {
                                        // Prepare for JavaScript alert and redirection
                                        echo "<script>
                                                alert('Good work completing the task given.');
                                                window.location.href = 'view_location.php';
                                              </script>";
                                    } else {
                                        echo "<p>Error deleting record from schedules: " . $conn->error . "</p>";
                                    }
                                } else {
                                    echo "<p>Error inserting record into history_delivery: " . $conn->error . "</p>";
                                }
                            } else {
                                echo "<p>Error fetching schedule details: " . $conn->error . "</p>";
                            }
                        
                        } else {
                            // Update status to the new phase
                            $sql = "UPDATE schedules SET status = '$status' WHERE schedule_id = '$schedule_id'";
                            if ($conn->query($sql) === TRUE) {
                                // No JavaScript reload needed, update status directly
                                echo "<script>document.getElementById('status').innerText = '" . $status . "';</script>";
                            } else {
                                echo "<p>Error updating status: " . $conn->error . "</p>";
                            }
                        }
                    }
                }
                
                // Fetch schedule and driver information for the given schedule_id
                $sql = "SELECT s.*, d.driver_name, d.profile_picture 
                        FROM schedules s 
                        JOIN drivers d ON s.driver_name = d.driver_name 
                        WHERE s.schedule_id = '$schedule_id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    
                    $driver_name = htmlspecialchars($row['driver_name']);
                    $driver_image = htmlspecialchars($row['profile_picture']);
                    $status = htmlspecialchars($row['status']);

                    echo "<div class='profile'>";
                    echo "<img src='$driver_image' alt='Profile Picture'>";
                    echo "<div>";
                    echo "<div class='name'>$driver_name</div>";
                    echo "<div class='subtext'>Bateriku Logistic Driver</div>";
                    echo "</div>";
                    echo "</div>";
                    
                    echo "<h3 class='text-xl font-semibold mb-4'>Driver Information</h3>";
                    echo "<p><strong>Start at:</strong> " . htmlspecialchars($row['start_at']) . "</p>";
                    echo "<p><strong>Starting Point:</strong> " . htmlspecialchars($row['starting_point']) . "</p>";
                    echo "<p><strong>Destination Point:</strong> " . htmlspecialchars($row['destination_point']) . "</p>";
                    echo "<p><strong>Driver:</strong> $driver_name</p>";
                    echo "<p><strong>License Plate:</strong> " . htmlspecialchars($row['license_plate']) . "</p>";
                    echo "<p><strong>Unit Number:</strong> " . htmlspecialchars($row['unit_number']) . "</p>";
                    
                    // Fetch location data for the destination point
                    $destination_point = $row['destination_point'];
                    $sql = "SELECT latitude, longitude FROM location WHERE destination_point = '$destination_point'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $location = $result->fetch_assoc();
                        $latitude = $location['latitude'];
                        $longitude = $location['longitude'];

                        // Output fetched latitude and longitude for verification
                        echo "<p><strong>Latitude:</strong> $latitude</p>";
                        echo "<p><strong>Longitude:</strong> $longitude</p>";

                        // Ensure the variables are available for JS
                        echo "<script>document.getElementById('lat').value = " . json_encode($latitude) . ";</script>";
                        echo "<script>document.getElementById('lng').value = " . json_encode($longitude) . ";</script>";
                    } else {
                        $latitude = '0';
                        $longitude = '0';
                        echo "<p class='text-red-500'>Destination not found in the location database.</p>";
                    }

                    // Display buttons for tracking delivery phases
                    echo "<form id='phaseForm' method='post' action='' class='flex flex-col space-y-2 mt-6'>";
                    echo "<input type='hidden' name='schedule_id' value='$schedule_id'>";

                
                    if ($status === 'Unload') {
                        echo "<button type='submit' name='action' value='complete' class='w-full h-[64px] gradient-bg text-[20px] text-[#FFFFFF] px-4 py-2 shadow-2xl border border-black transform hover:bg-[#629201] hover:shadow-3xl hover:translate-y-[-2px]' onclick='return confirmCompletion()'>Delivery Succesfull</button>";
                    }
                    echo "</form>";
                } else {
                    echo "<p class='text-red-500'>No driver information available for this schedule.</p>";
                }
            } else {
                echo "<p class='text-red-500'>Invalid schedule ID.</p>";
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

        function confirmCompletion() {
            if (confirm("Click OK to complete the delivery and to the view schedule page.")) {
                // Prevent default form submission and redirect after confirmation
                return true;
            }
            return false; // Prevent form submission if canceled
        }
    </script>

    <?php include('footer.php'); ?>
</body>
</html>

<?php
// End output buffering and flush output
ob_end_flush();
?>
