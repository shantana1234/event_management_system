<?php
include '../../includes/config.php';

$event_id = $_GET['event_id'] ?? null;
if (!$event_id) {
    die("Invalid event ID.");
}

$query = "SELECT event_name, event_date, event_description FROM events WHERE event_id = '$event_id'";
$result = mysqli_query($conn, $query);
$event = mysqli_fetch_assoc($result);

// Correct SQL query to count attendees
$sql = "SELECT COUNT(*) AS total_attendees FROM event_attendees WHERE event_id = '$event_id'";
$resultt = mysqli_query($conn, $sql);

// Fetch the result
$event_attendee = mysqli_fetch_assoc($resultt);

// Get the count
$total_attendees = $event_attendee['total_attendees'];

$today = date('Y-m-d');
$days_to_go = (strtotime($event['event_date']) - strtotime($today)) / (60 * 60 * 24);

// echo "Total Attendees: " . $total_attendees;

if (!$event) {
    die("Event not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Event Section</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-gray-100 p-4 mt-9">

    <div class="flex flex-col lg:flex-row gap-4 max-w-7xl mx-auto ">
        <!-- Left Section (70%) -->
        <div class="lg:w-7/10 w-full bg-white p-6 text-black rounded-lg">
        <div class="event-details text-center lg:text-left">
                <!-- Event Name with Underline -->
                <h3 class="text-lg font-bold text-center mb-5 relative border-b-2 pb-2">
                    <?= htmlspecialchars($event['event_name']); ?>
                </h3>

                <!-- Event Date & Max Attendees -->
                <div class="flex flex-col gap-3">
                    <!-- Event Date -->
                    <div class="bg-yellow-100 text-gray-700 p-3 rounded flex items-center">
                        <i class="bi bi-calendar-event text-lg mr-2"></i>
                        <span class="text-sm"><strong>Event Date:</strong> <?= $event['event_date']; ?></span>
                    </div>

                    <!-- Max Attendees -->
                    <div class="bg-blue-100 text-gray-700 p-3 rounded flex items-center">
                        <i class="bi bi-people-fill text-lg mr-2"></i>
                        <span class="text-sm"><strong>Max Attendees:</strong> <span class="text-red-500 font-bold">100</span></span>
                    </div>
                </div>

                <!-- Event Description -->
                <div class="event-description mt-4">
                    <p class="text-gray-600 text-sm">
                        <?= isset($event['event_description']) ? nl2br(htmlspecialchars($event['event_description'])) : "No description available."; ?>
                    </p>
                </div>

                <!-- Announcement -->
                <p class="font-bold text-red-500 text-center text-sm mt-4">
                    <i class="fa fa-bullhorn"></i> Don't miss out! Secure your spot now!
                </p>
            </div>
        </div>

<!-- Right Section (30%) - Fixed -->
<div class="lg:w-3/10 w-full lg:sticky top-0 bg-white shadow-md p-6 rounded-lg">
  <!-- Registration Form -->
  <div class="register-form ">
        <h3 class="font-bold text-center mb-3 text-xl text-purple-700 border-b-2 pb-2 mb-5">📢 Register Now</h3>

        <!-- Attendee Count & Countdown -->
        <div class="flex justify-between mb-3">
            <span class="bg-green-200 text-green-700 px-3 py-1 rounded text-sm">
                <i class="bi bi-people-fill text-purple-500"></i> <?= $total_attendees; ?> Attended
            </span>
            <span class="bg-yellow-200 text-yellow-700 px-3 py-1 rounded text-sm">
                <i class="bi bi-calendar-event text-purple-500"></i> <?= $days_to_go; ?> Days to Go
            </span>
        </div>

        <div id="alertBox"></div>

        <form id="registerForm">
            <input type="hidden" name="event_id" value="<?= $event_id; ?>">

            <div class="mb-3">
                <label for="attendee_name" class="block font-semibold"><i class="bi bi-person-fill text-purple-500"></i> Full Name</label>
                <div class="flex items-center border rounded p-2">
                    <!-- Icon with background fill -->
                    <div class="bg-purple-200 p-2 rounded-l flex items-center justify-center">
                        <i class="bi bi-person text-purple-600"></i>
                    </div>
                    <input type="text" class="w-full outline-none pl-3" id="attendee_name" name="attendee_name" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="attendee_email" class="block font-semibold"><i class="bi bi-envelope-fill text-purple-500"></i> Email</label>
                <div class="flex items-center border rounded p-2">
                    <!-- Icon with background fill -->
                    <div class="bg-purple-200 p-2 rounded-l flex items-center justify-center">
                        <i class="bi bi-envelope text-purple-600"></i>
                    </div>
                    <input type="email" class="w-full outline-none pl-3" id="attendee_email" name="attendee_email" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="attendee_phone" class="block font-semibold"><i class="bi bi-telephone-fill text-purple-500"></i> Phone Number</label>
                <div class="flex items-center border rounded p-2">
                    <!-- Icon with background fill -->
                    <div class="bg-purple-200 p-2 rounded-l flex items-center justify-center">
                        <i class="bi bi-telephone text-purple-600"></i>
                    </div>
                    <input type="tel" class="w-full outline-none pl-3" id="attendee_phone" name="attendee_phone" required>
                </div>
            </div>

            <button type="submit" class="w-full bg-purple-600 text-white font-semibold py-2 rounded hover:bg-purple-700 transition">
                <i class="bi bi-send"></i> Register
            </button>
        </form>
    </div>
</div>


    </div>
        </div>
    

</body>
</html>
