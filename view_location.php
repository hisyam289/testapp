<?php include('db.php'); ?>
<?php include('header.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Schedules</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Ensure the table is scrollable on smaller screens */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px; /* Default padding */
            text-align: left;
        }

        /* Responsive styles for mobile */
        @media (max-width: 768px) {
            th, td {
                padding: 4px; /* Reduce padding for smaller screens */
                font-size: 14px; /* Adjust font size */
            }

            th:last-child, td:last-child {
                padding-right: 8px; /* Slight padding adjustment for last column */
            }
        }

        @media (max-width: 480px) {
            th, td {
                padding: 2px; /* Further reduce padding for very small screens */
                font-size: 12px; /* Smaller font size */
            }
        }
    </style>
</head>
<body>
    <main class="p-4">
        <h2 class="text-2xl text-[#FFFFFF] font-bold md:mt-[60px] md:mb-[50px] mt-[50px]">Available Schedules</h2>
        <div class="table-container">
            <table class="min-w-full border-collapse border border-gray-200">
                <thead>
                    <tr>
                        <th class="border border-gray-300 p-2 text-left text-xs md:text-[20px]">Start at</th>
                        <th class="border border-gray-300 p-2 text-left text-xs md:text-[20px]">Starting Point</th>
                        <th class="border border-gray-300 p-2 text-left text-xs md:text-[20px]">Destination Point</th>
                        <th class="border border-gray-300 p-2 text-left text-xs md:text-[20px]">Driver</th>
                        <th class="border border-gray-300 p-2 text-left text-xs md:text-[20px]">License Plate</th>
                        <th class="border border-gray-300 p-2 text-left text-xs md:text-[20px]">Unit Number</th>
                        <th class="border border-gray-300 p-2 text-left text-xs md:text-[20px]">Act</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM schedules";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                            <td class='border border-gray-300 p-2 text-xs text-black md:text-[20px]'>" . $row["start_at"] . "</td>
                            <td class='border border-gray-300 p-2 text-xs text-black md:text-[20px]'>" . $row["starting_point"] . "</td>
                            <td class='border border-gray-300 p-2 text-xs text-black md:text-[20px]'>" . $row["destination_point"] . "</td>
                            <td class='border border-gray-300 p-2 text-xs text-black md:text-[20px]'>" . $row["driver_name"] . "</td>
                            <td class='border border-gray-300 p-2 text-xs text-black md:text-[20px]'>" . $row["license_plate"] . "</td>
                            <td class='border border-gray-300 p-2 text-xs text-black md:text-[20px]'>" . $row["unit_number"] . "</td>
                            <td class='border border-gray-300 p-2 text-xs text-black md:text-[20px]'>
                                <a href='view_driver_location.php?id=" . $row["schedule_id"] . "' class='bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-700'>
                                    <i class='fas fa-eye'></i>
                                </a>
                            </td>
                          </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='border border-gray-300 p-2 text-xs md:text-[20px]'>No schedules available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include('footer.php'); ?>
</body>
</html>
