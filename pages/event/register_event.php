<?php
include '../../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = $_POST['event_id'] ?? null;
    $name = trim($_POST['attendee_name'] ?? '');
    $email = trim($_POST['attendee_email'] ?? '');
    $phone = trim($_POST['attendee_phone'] ?? '');
    var_dump($event_id,$name);

    if (!$event_id || empty($name) || empty($email) || empty($phone)) {
        echo json_encode(["success" => false, "message" => "All fields are required."]);
        exit;
    }

    // Check if email already registered for the event
    $checkQuery = "SELECT * FROM event_attendees WHERE event_id = ? AND attendee_email = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("is", $event_id, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "You are already registered for this event."]);
        exit;
    }

    // Insert into database
    $query = "INSERT INTO event_attendees (event_id, attendee_name, attendee_email, attendee_phone) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isss", $event_id, $name, $email, $phone);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Registration successful!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Registration failed. Try again."]);
    }
    
    $stmt->close();
    $conn->close();
}
?>
