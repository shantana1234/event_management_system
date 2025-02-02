<?php

include '../../includes/config.php';
session_start(); 

if (!isset($_SESSION['user_id'])) {
    header("Location: ../content/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$event_name = isset($_POST['event_name']) ? trim($_POST['event_name']) : '';
$event_description = isset($_POST['event_description']) ? trim($_POST['event_description']) : '';
$event_date = isset($_POST['event_date']) ? trim($_POST['event_date']) : '';
$event_capacity = isset($_POST['event_capacity']) ? (int) $_POST['event_capacity'] : 0;
$event_status = isset($_POST['event_status']) ? trim($_POST['event_status']) : '';

// Validation
if (empty($event_name) || empty($event_description) || empty($event_date) || $event_capacity <= 0 || !in_array($event_status, ['draft', 'publish'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid input data.']);
    exit;
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Insert data into the database
// $sql = "INSERT INTO events (event_name, event_description, event_date, user_id, `max_attendee`, event_status) 
// VALUES ('Sample Event 2', 'Sample Description', '2025-01-30', 1, 50, 'draft');
// ";
$sql = "INSERT INTO events (event_name, event_description, event_date, user_id, max_attendee, event_status) VALUES (?, ?, ?, ?,?, ?)";
$stmt = $conn->prepare($sql);
// $stmt->execute();
if ($stmt) {
    $stmt->bind_param('sssiis', $event_name, $event_description, $event_date, $user_id, $event_capacity, $event_status);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Event created successfully!']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to save event.']);
    }

    $stmt->close();
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to prepare statement.']);
}

?>
