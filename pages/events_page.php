<?php
include '../includes/config.php';

if (isset($_GET['download_csv'])) {
    downloadCSV();
}

function downloadCSV() {
    global $conn;

    $eventsQuery = "SELECT * FROM events ORDER BY event_date";
    $eventsResult = mysqli_query($conn, $eventsQuery);

    if (mysqli_num_rows($eventsResult) > 0) {
        $filename = "events_report_" . date('Y-m-d') . ".csv";
        
        // Set the headers for the CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');

        // Write the column headers
        $columns = ['Event ID', 'Event Name', 'Event Date', 'Event Description'];
        fputcsv($output, $columns);

        // Write the event data
        while ($event = mysqli_fetch_assoc($eventsResult)) {
            fputcsv($output, [
                $event['event_id'],
                $event['event_name'],
                $event['event_date'],
                $event['event_description']
            ]);
        }

        fclose($output);
        exit;
    } else {
        echo "No events found to export.";
    }
}
?>
