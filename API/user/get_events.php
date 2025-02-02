<?php
header("Content-Type: application/json");
include '../../includes/config.php';

$user_id = $_GET['user_id'] ?? null; // Get user_id from request

if (!$user_id) {
    echo json_encode(["success" => false, "message" => "User ID is required."]);
    exit;
}

// Prepare the query to filter events by user_id
$query = "SELECT event_id, event_name, event_date, event_description, max_attendee, event_status 
          FROM events 
          WHERE user_id = ? 
          ORDER BY event_date ASC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$events = [];

while ($row = $result->fetch_assoc()) {
    $today = date('Y-m-d');
    $days_to_go = (strtotime($row['event_date']) - strtotime($today)) / (60 * 60 * 24);

    // Fetch the total attendees for each event
    $attendee_stmt = $conn->prepare("SELECT COUNT(*) AS total_attendees FROM event_attendees WHERE event_id = ?");
    $attendee_stmt->bind_param("i", $row['event_id']);
    $attendee_stmt->execute();
    $attendee_result = $attendee_stmt->get_result();
    $attendee = $attendee_result->fetch_assoc();
    $total_attendees = $attendee['total_attendees'] ?? 0;

    $events[] = [
        "event_id" => $row["event_id"],
        "event_name" => $row["event_name"],
        "event_date" => $row["event_date"],
        "event_description" => $row["event_description"],
        "total_attendees" => $total_attendees,
        "days_to_go" => $days_to_go
    ];
}

echo json_encode(["success" => true, "events" => $events]);
?>
