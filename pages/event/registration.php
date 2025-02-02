<?php
include '../../includes/config.php';

$event_id = $_GET['event_id'] ?? null;
if (!$event_id) {
    die("Invalid event ID.");
}

$query = "SELECT event_name, event_date,max_attendee, event_description FROM events WHERE event_id = '$event_id'";
$result = mysqli_query($conn, $query);
$event = mysqli_fetch_assoc($result);

$sql = "SELECT COUNT(*) AS total_attendees FROM event_attendees WHERE event_id = '$event_id'";
$resultt = mysqli_query($conn, $sql);
$event_attendee = mysqli_fetch_assoc($resultt);
$total_attendees = $event_attendee['total_attendees'];

$today = date('Y-m-d');
$days_to_go = (strtotime($event['event_date']) - strtotime($today)) / (60 * 60 * 24);

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
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
</head>
<style>

    .swal-small-popup {
        width: 500px !important; 
        padding: 20px !important; 
    }
    .disabled-btn {
        background-color:rgb(247, 193, 244) !important; /* Light gray color */
        cursor: not-allowed !important;
    }
</style>
<body class="bg-gray-100 p-4 mt-9">

    <div class="flex flex-col lg:flex-row gap-4 max-w-7xl mx-auto ">
        <div class="lg:w-7/10 w-full bg-white p-6 text-black rounded-lg">
        <div class="event-details text-center lg:text-left">
                <h3 class="text-lg font-bold text-center mb-5 relative border-b-2 pb-2">
                    <?= htmlspecialchars($event['event_name']); ?>
                </h3>

                <div class="flex flex-col gap-3">
                    <div class="bg-yellow-100 text-gray-700 p-3 rounded flex items-center">
                        <i class="bi bi-calendar-event text-lg mr-2"></i>
                        <span class="text-sm"><strong>Event Date:</strong> <?= $event['event_date']; ?></span>
                    </div>

                    <div class="bg-blue-100 text-gray-700 p-3 rounded flex items-center">
                        <i class="bi bi-people-fill text-lg mr-2"></i>
                        <span class="text-sm"><strong>Max Attendees:</strong> <span class="text-red-500 font-bold"><?= $event['max_attendee']; ?></span></span>
                    </div>
                </div>

                <div class="event-description mt-4">
                    <p class="text-gray-600 text-sm">
                        <?= isset($event['event_description']) ? nl2br(htmlspecialchars($event['event_description'])) : "No description available."; ?>
                    </p>
                </div>

                <p class="font-bold text-red-500 text-center text-sm mt-4">
                    <i class="fa fa-bullhorn"></i> Don't miss out! Secure your spot now!
                </p>
            </div>
        </div>

<div class="lg:w-3/10 w-full lg:sticky top-0 bg-white shadow-md p-6 rounded-lg">
  <div class="register-form ">
        <h3 class="font-bold text-center mb-3 text-xl border-b-2 pb-2 mb-5">📢 Register Now</h3>

        <div class="flex justify-between mb-3">
            <span class="bg-green-200 text-green-700 px-3 py-1 rounded text-sm">
                <i class="bi bi-people-fill text-green-500"></i> <?= $total_attendees; ?> Attended
            </span>
            <span class="bg-red-200 text-red-700 px-3 py-1 rounded text-sm">
                <i class="bi bi-calendar-event text-red-500"></i> <?= $days_to_go; ?> Days to Go
            </span>
        </div>

        <div class="bg-red-500 text-white p-2 mt-5 mb-5 rounded text-sm text-center" id="bookedBadge" style="display: none;">
            <i class="bi bi-exclamation-circle-fill"></i> We are fully booked! Try next time.
        </div>

        <form id="registerForm">
            <input type="hidden" name="event_id" value="<?= $event_id; ?>">
            <input type="hidden" id="max_attendee" value="<?= $event['max_attendee']; ?>"> <!-- Add max_attendee -->
    
            <div class="mb-3">
                <label for="attendee_name" class="block font-semibold"><i class="bi bi-person-fill text-purple-500"></i> Full Name</label>
                <div class="flex items-center border rounded p-2">
                    <div class="bg-purple-200 p-2 rounded-l flex items-center justify-center">
                        <i class="bi bi-person text-purple-600"></i>
                    </div>
                    <input type="text" class="w-full outline-none pl-3" id="attendee_name" name="attendee_name" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="attendee_email" class="block font-semibold"><i class="bi bi-envelope-fill text-purple-500"></i> Email</label>
                <div class="flex items-center border rounded p-2">
                    <div class="bg-purple-200 p-2 rounded-l flex items-center justify-center">
                        <i class="bi bi-envelope text-purple-600"></i>
                    </div>
                    <input type="email" class="w-full outline-none pl-3" id="attendee_email" name="attendee_email" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="attendee_phone" class="block font-semibold"><i class="bi bi-telephone-fill text-purple-500"></i> Phone Number</label>
                <div class="flex items-center border rounded p-2">
                    <div class="bg-purple-200 p-2 rounded-l flex items-center justify-center">
                        <i class="bi bi-telephone text-purple-600"></i>
                    </div>
                    <input type="tel" class="w-full outline-none pl-3" id="attendee_phone" name="attendee_phone" required>
                </div>
            </div>

            <button type="submit" class="w-full bg-purple-600 text-white font-semibold py-2 rounded hover:bg-purple-700 transition" id="registerBtn">
                <i class="bi bi-send"></i> Register
            </button>
        </form>
    </div>
</div>
    </div>
</div>
</body>
</html>
<script>

document.addEventListener('DOMContentLoaded', function () {
    const maxAttendees = parseInt(document.getElementById("max_attendee").value); 
    const totalAttendees = <?= $total_attendees; ?>; 
    const registerBtn = document.getElementById("registerBtn");
    const bookedBadge = document.getElementById("bookedBadge");

    // console.log("Max Attendees: ", maxAttendees);  
    // console.log("Total Attendees: ", totalAttendees); 

    if (totalAttendees >= maxAttendees) {
        registerBtn.disabled = true;  // Disable the register button
        registerBtn.classList.add("disabled-btn");  // Add disabled button style
        bookedBadge.style.display = "block";  
    }
});


    document.getElementById("registerForm").addEventListener("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        fetch("register_event_attendee.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
               Swal.fire({
                    icon: 'success',
                    title: 'Registration Successful!',
                    // text: data.message,
                    confirmButtonText: 'Got it!',
                    confirmButtonColor: '#4CAF50', // Green button color
                    // background: '#f0fff4', // Light green background
                    showCancelButton: false,
                    customClass: {
                        popup: 'swal-small-popup' // Apply a custom class for the popup
                    }
                });
                document.getElementById("registerForm").reset();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Registration Failed',
                    text: data.message,
                    confirmButtonText: 'Try Again',
                    confirmButtonColor: '#e74c3c', // Red button color
                    background: '#ffe6e6', // Light red background
                    showCancelButton: false,
                    customClass: {
                        popup: 'swal-small-popup' // Apply a custom class for the popup
                    }
                });
            }
        })
        .catch(error => {
            console.error("Error:", error);
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'An error occurred. Please try again later.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#e74c3c',
                background: '#ffe6e6',
                showCancelButton: false,
                customClass: {
                        popup: 'swal-small-popup' // Apply a custom class for the popup
                    }
            });
        });
    });
</script>

