<?php
include('db.php');

if (isset($_GET['id'])) {
    $schedule_id = $_GET['id'];

    // Delete the schedule
    $sql = "DELETE FROM schedules WHERE schedule_id = $schedule_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Schedule deleted successfully'); window.location.href='manage_schedule.php';</script>";
    } else {
        echo "<script>alert('Error deleting schedule: " . $conn->error . "'); window.location.href='manage_schedule.php';</script>";
    }
} else {
    echo "<script>alert('No schedule ID provided'); window.location.href='manage_schedule.php';</script>";
}
?>
