<?php
$conn = new mysqli("localhost", "root", "", "student_db");

$id = $_POST['id'];

$result = $conn->query("SELECT status FROM students WHERE id = $id");
$row = $result->fetch_assoc();
$currentStatus = $row['status'];

$newStatus = $currentStatus == 0 ? 1 : 0;

$conn->query("UPDATE students SET status = $newStatus WHERE id = $id");

echo $newStatus;

$conn->close();
?>
