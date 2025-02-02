<?php
header("Content-Type: application/json");
include '../includes/config.php';

$event_id = $_GET['event_id'] ?? null;

if (!$event_id) {
    echo json_encode(["success" => false, "message" => "Invalid event ID."]);
    exit;
}

// Fetch event details
$query = "SELECT event_id, event_name, event_date, event_description, max_attendee, event_status 
          FROM events 
          WHERE event_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();

if (!$event) {
    echo json_encode(["success" => false, "message" => "Event not found."]);
    exit;
}

// Fetch total number of attendees
$sql = "SELECT COUNT(*) AS total_attendees FROM event_attendees WHERE event_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();
$event_attendee = $result->fetch_assoc();
$total_attendees = $event_attendee['total_attendees'] ?? 0;

// Fetch attendee details
$attendee_query = "SELECT a.attendee_id, a.attendee_name, a.attendee_email, a.registration_date 
                   FROM event_attendees a 
                   WHERE a.event_id = ?";
$stmt = $conn->prepare($attendee_query);
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();

$attendees = [];
while ($row = $result->fetch_assoc()) {
    $attendees[] = $row;
}

// Calculate days remaining
$today = date('Y-m-d');
$days_to_go = (strtotime($event['event_date']) - strtotime($today)) / (60 * 60 * 24);

// Return JSON response
echo json_encode([
    "success" => true,
    "event" => $event,
    "total_attendees" => $total_attendees,
    "days_to_go" => $days_to_go,
    "attendees" => $attendees
]);
?>
