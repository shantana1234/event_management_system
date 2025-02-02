<?php
// Include database connection
include '../../includes/config.php';

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input
    $attendeeName = mysqli_real_escape_string($conn, $_POST['attendee_name']);
    $attendeeEmail = mysqli_real_escape_string($conn, $_POST['attendee_email']);
    $attendeePhone = mysqli_real_escape_string($conn, $_POST['attendee_phone']);
    $eventId = (int) $_POST['event_id'];

    // Check for duplicate email or phone number
    $duplicateCheckQuery = "SELECT * FROM event_attendees WHERE attendee_email = '$attendeeEmail' OR attendee_phone = '$attendeePhone'";
    $duplicateCheckResult = mysqli_query($conn, $duplicateCheckQuery);

    if (mysqli_num_rows($duplicateCheckResult) > 0) {
        // If a duplicate is found, return error response
        $response = [
            'success' => false,
            'message' => 'Duplicate email or phone number. You are already registered.'
        ];
    } else {
        // Insert the attendee into the database
        $sql = "INSERT INTO event_attendees (event_id, attendee_name, attendee_email, attendee_phone) 
                VALUES ('$eventId', '$attendeeName', '$attendeeEmail', '$attendeePhone')";

        if (mysqli_query($conn, $sql)) {
            $response = [
                'success' => true,
                'message' => 'Successfully registered for the event!'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to register. Please try again.'
            ];
        }
    }
}

// Send the response as JSON
echo json_encode($response);
?>
