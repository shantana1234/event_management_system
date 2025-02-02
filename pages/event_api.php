<?php
include '../includes/config.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

// Get event ID (from GET, POST, or DELETE request)
$event_id = $_GET['event_id'] ?? $_POST['event_id'] ?? null;

// Fetch Event Data (GET Request)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $event_id) {

    $query = "SELECT * FROM events WHERE event_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Event not found']);
    }
    exit();
}

// Update Event Data (POST Request)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_name'], $_POST['event_id'])) {
    $event_id = (int) $_POST['event_id']; // Ensure event_id is properly defined
    $event_name = $_POST['event_name'];
    $event_description = $_POST['event_description'];
    $event_date = $_POST['event_date'];
    $max_attendee = (int) $_POST['max_attendee'];
    $event_status = $_POST['event_status'];

    $update_query = "UPDATE events SET 
        event_name = ?, 
        event_description = ?, 
        event_date = ?, 
        max_attendee = ?, 
        event_status = ?
        WHERE event_id = ?"; // ✅ Fixed the comma issue

    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("sssisi", $event_name, $event_description, $event_date, $max_attendee, $event_status, $event_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Event updated successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating event: ' . $stmt->error]);
    }

    $stmt->close(); // ✅ Close the statement to free up resources
    exit();
}


// Delete Event (DELETE Request)
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $input_data = json_decode(file_get_contents("php://input"), true);
    $event_id = $input_data['event_id'] ?? null;

    if ($event_id) {
        // Start transaction
        $conn->begin_transaction();

        try {
            // Delete attendees associated with the event
            $delete_attendees_query = "DELETE FROM event_attendees WHERE event_id = ?";
            $stmt1 = $conn->prepare($delete_attendees_query);
            $stmt1->bind_param("i", $event_id);
            $stmt1->execute();

            // Delete the event
            $delete_event_query = "DELETE FROM events WHERE event_id = ?";
            $stmt2 = $conn->prepare($delete_event_query);
            $stmt2->bind_param("i", $event_id);
            $stmt2->execute();

            // Commit transaction
            $conn->commit();

            echo json_encode(["status" => "success", "message" => "Event and associated attendees deleted successfully!"]);
        } catch (Exception $e) {
            // Rollback transaction on error
            $conn->rollback();
            echo json_encode(["status" => "error", "message" => "Failed to delete event and attendees."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid event ID."]);
    }
    exit();
}

// Invalid Request
echo json_encode(["status" => "error", "message" => "Invalid request."]);
?>
