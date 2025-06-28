<?php
// database connection
$conn = new mysqli("localhost", "root", "", "exptrack");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$record_id = $_POST['record_id'];
$type = $_POST['type'];
$amount = $_POST['amount'];
$description = $_POST['description'];
$datetime = $_POST['datetime'];


$stmt = $conn->prepare("UPDATE expenses SET Type = ?, Amount = ?, Description = ?, Date = ? WHERE RecordID = ?");
$stmt->bind_param("sdssi", $type, $amount, $description, $datetime, $record_id);

if ($stmt->execute()) {
    
    header("Location: ../records.php?success=updated");
} else {
    
    header("Location: ../records.php?error=update_failed");
}

$stmt->close();


$conn->close();
?> 