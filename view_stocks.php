<?php include('db.php'); ?>
<?php include('header.php'); ?>

<body class="bg-gray-100 text-gray-900">
<main class="max-w-4xl mx-auto p-6">
    <h2 class="text-2xl text-[#FFFFFF] font-bold md:mt-[60px] md:mb-[50px] mt-[60px]">Stocks at <?php echo htmlspecialchars($_GET['location']); ?></h2>
    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow overflow-hidden mb-[-300px]">
        <thead>
            <tr class="bg-gray-200 text-gray-700">
                <th class="border border-gray-300 p-2 text-left text-xs md:text-[20px]">ID</th>
                <th class="border border-gray-300 p-2 text-left text-xs md:text-[20px]">Name</th>
                <th class="border border-gray-300 p-2 text-left text-xs md:text-[20px]">Size</th>
                <th class="border border-gray-300 p-2 text-left text-xs md:text-[20px]">Unit Number</th>
                <th class="border border-gray-300 p-2 text-left text-xs md:text-[20px]">Brand</th>
                <th class="border border-gray-300 p-2 text-left text-xs md:text-[20px]">Location</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $location = htmlspecialchars($_GET['location']);
            $sql = "SELECT * FROM stocks WHERE location='$location'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr class='border-b'>
                            <td class='py-2 px-4'>" . htmlspecialchars($row["id"]). "</td>
                            <td class='py-2 px-4'>" . htmlspecialchars($row["name"]). "</td>
                            <td class='py-2 px-4'>" . htmlspecialchars($row["size"]). "</td>
                            <td class='py-2 px-4'>" . htmlspecialchars($row["unit_number"]). "</td>
                            <td class='py-2 px-4'>" . htmlspecialchars($row["brand"]). "</td>
                            <td class='py-2 px-4'>" . htmlspecialchars($row["location"]). "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td class='py-2 px-4 text-center' colspan='6'>No stocks available at this location</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</main>
</body>
</html>

<?php include('footer.php'); ?>
