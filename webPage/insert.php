<?php
$conn = new mysqli("localhost", "root", "", "student_db");

$name = $_POST['name'];
$age = $_POST['age'];

$sql = "INSERT INTO students (name, age) VALUES ('$name', $age)";
$conn->query($sql);

$conn->close();

header("Location: index.php");
exit();
?>
