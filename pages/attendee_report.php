<?php
include '../includes/config.php';

// Check if event_id and download_csv parameters are passed in the URL
if (isset($_GET['download_csv']) && isset($_GET['event_id'])) {
    $eventId = $_GET['event_id'];  // Event ID passed from the URL
    downloadCSV($eventId);
} else {
    echo "Event ID is missing.";
}

function downloadCSV($eventId) {
    global $conn;

    // Ensure the event_id is valid
    if (empty($eventId)) {
        echo "Invalid event ID.";
        exit;
    }

    // Fetch event details
    $eventQuery = "SELECT event_name, event_date, event_description, max_attendee, event_status 
                   FROM events 
                   WHERE event_id = ?";
    $stmt = $conn->prepare($eventQuery);
    $stmt->bind_param("i", $eventId);
    $stmt->execute();
    $eventResult = $stmt->get_result();
    $event = $eventResult->fetch_assoc();

    if (!$event) {
        echo "Event not found.";
        exit;
    }

    // Fetch attendees for the specific event
    $attendeeQuery = "SELECT attendee_name, attendee_email, attendee_phone 
                      FROM event_attendees 
                      WHERE event_id = ?";
    $stmt = $conn->prepare($attendeeQuery);
    $stmt->bind_param("i", $eventId);
    $stmt->execute();
    $attendeeResult = $stmt->get_result();

    // Set the filename for CSV export
    $filename = "attendees_report_event_" . $eventId . "_" . date('Y-m-d') . ".csv";
    
    // Set headers for CSV download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Pragma: no-cache');
    header('Expires: 0');

    // Open output stream for writing CSV
    $output = fopen('php://output', 'w');

    // Write event details first
    fputcsv($output, ['Event Details']);
    fputcsv($output, ['Event Name', $event['event_name']]);
    fputcsv($output, ['Event Date', date('F j, Y', strtotime($event['event_date']))]);
    fputcsv($output, ['Description', $event['event_description']]);
    fputcsv($output, ['Max Attendees', $event['max_attendee']]);
    fputcsv($output, ['Event Status', $event['event_status']]);
    fputcsv($output, []); // Empty row for spacing

    // Column headers for the attendee list
    fputcsv($output, ['Attendee Name', 'Email', 'Phone']);

    // Write attendee data into CSV
    while ($attendee = $attendeeResult->fetch_assoc()) {
        fputcsv($output, [
            $attendee['attendee_name'],
            $attendee['attendee_email'],
            $attendee['attendee_phone']
        ]);
    }

    // Close output stream
    fclose($output);
    exit;
}
?>
