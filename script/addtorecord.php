<?php

$conn = new mysqli("localhost", "root", "", "exptrack");
if ($conn->connect_error) {
    die("Di nagconnect par" . $conn->connect_error);
}

$conn->begin_transaction();

$amount = $_POST['amount'];
$type = $_POST['type'];
$desc = $_POST['description'];
$datetime = $_POST['datetime'];

$stmt = $conn->prepare("INSERT INTO expenses (Type, Description, Date, Amount) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssd", $type, $desc, $datetime, $amount);

$stmt->execute();
$conn->commit();

header("Location: ../records.php");
exit();

$stmt->close();
$conn->close();
?>
