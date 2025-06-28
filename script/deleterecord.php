<?php
// database connection
$conn = new mysqli("localhost", "root", "", "exptrack");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['record_id'])) {
    $record_id = $_POST['record_id'];
    error_log("Attempting to delete record ID: " . $record_id);
    
    $stmt = $conn->prepare("DELETE FROM expenses WHERE RecordID = ?");
    $stmt->bind_param("i", $record_id);
    
    if ($stmt->execute()) {
        error_log("Delete successful for record ID: " . $record_id);
        header("Location: ../records.php?success=deleted");
    } else {
        error_log("Delete failed for record ID: " . $record_id . ". Error: " . $stmt->error);
        header("Location: ../records.php?error=delete_failed");
    }
    $stmt->close();
} else {
    error_log("Invalid request method or missing record_id. Method: " . $_SERVER["REQUEST_METHOD"] . ", POST data: " . print_r($_POST, true));
    header("Location: ../records.php");
}
$conn->close();
?> 