<?php
// Include necessary files
include '../includes/config.php';
include "../content/templates/authenticated/header.php";
include "../content/templates/authenticated/sidebar.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../content/login.php");
    exit();
}

// Get Event ID from URL
if (!isset($_GET['event_id']) || empty($_GET['event_id'])) {
    echo "<div class='alert alert-danger text-center'>Invalid Event ID!</div>";
    include "../content/templates/authenticated/footer.php";
    exit();
}

$event_id = (int) $_GET['event_id']; // Ensuring integer for security

// Fetch event details
$query = "SELECT * FROM events WHERE event_id = '$event_id'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<div class='alert alert-danger text-center'>Event not found!</div>";
    include "../content/templates/authenticated/footer.php";
    exit();
}

$event = mysqli_fetch_assoc($result);

// Pagination Variables
$limit = 5; // Number of attendees per page
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1; // Current page
$offset = ($page - 1) * $limit;

// Count total attendees for pagination
$count_query = "SELECT COUNT(*) AS total FROM event_attendees WHERE event_id = $event_id";
$count_result = mysqli_query($conn, $count_query);
$total_attendees = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_attendees / $limit); // Calculate total pages

// Fetch attendees for the current page
$query = "SELECT attendee_name, attendee_email, attendee_phone 
          FROM event_attendees 
          WHERE event_id = $event_id 
          LIMIT $limit OFFSET $offset";

$result = mysqli_query($conn, $query);
?>

<div class="main-content p-4 mb-5">
    <!-- Header with Back Button -->
    <div class="header-with-button d-flex justify-content-between align-items-center mb-4">
        <h1 class="header-text h5">Dashboard > Events > View event</h1>
        <button type="button" class="btn btn-primary btn-sm" onclick="window.history.back()">
            <i class="fa fa-arrow-left me-2"></i> Go Back
        </button>
    </div>

    <!-- Event Details Card -->
    <div class="card shadow-sm">
        <div class="card-body" style="background-color:rgb(230, 230, 230);">
            <div class="row row-cols-1 row-cols-md-2 g-3">
                <!-- Event Name -->
                <div class="col">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-fonts fs-3 text-success me-3"></i>
                        <div>
                            <h6 class="text-primary fw-bold">Event Name</h6>
                            <p class="small"><?= htmlspecialchars($event['event_name']) ?></p>
                        </div>
                    </div>
                </div>

                <!-- Event Description -->
                <div class="col">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-card-text fs-3 text-info me-3"></i>
                        <div>
                            <h6 class="text-primary fw-bold">Description</h6>
                            <p class="small"><?= nl2br(htmlspecialchars($event['event_description'])) ?></p>
                        </div>
                    </div>
                </div>

                <!-- Event Date -->
                <div class="col">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-calendar-check-fill fs-3 text-warning me-3"></i>
                        <div>
                            <h6 class="text-primary fw-bold">Date</h6>
                            <p class="small"><?= date("F j, Y", strtotime($event['event_date'])) ?></p>
                        </div>
                    </div>
                </div>

                <!-- Event Capacity -->
                <div class="col">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-people-fill fs-3 text-danger me-3"></i>
                        <div>
                            <h6 class="text-primary fw-bold">Maximum Capacity</h6>
                            <p class="small"><?= htmlspecialchars($event['max_attendee']) ?> people</p>
                        </div>
                    </div>
                </div>

                <!-- Event Status -->
                <div class="col">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-flag-fill fs-3 text-secondary me-3"></i>
                        <div>
                            <h6 class="text-primary fw-bold">Status</h6>
                            <span class="badge <?= $event['event_status'] == 'publish' ? 'bg-success' : 'bg-secondary' ?>">
                                <?= ucfirst(htmlspecialchars($event['event_status'])) ?>
                            </span>
                        </div>
                    </div>
                </div>
                 <!-- Registration Link -->
                <div class="col">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-external-link-alt fs-3 text-dark me-3"></i>
                        <div>
                            <h6 class="text-primary fw-bold">Registration Link</h6>
                            <a href="<?= BASE_URL; ?>pages/event/registration.php?event_id=<?= $event_id; ?>" 
                            target="_blank" class="btn btn-success btn-sm">
                                <i class="fa fa-external-link-alt me-2"></i> Register for Event
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendee List -->
    <div class="card shadow-sm mt-4">
        <div class="card-body">
        <h4 class=" text-dark  m-2 p-2 fw-semibold">
    <i class="bi bi-people-fill me-2"></i> Attendee List
</h4>

            <div class="container py-4">
                <!-- Download CSV Button -->
           
                    <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="text-end mb-3">
                        <a href="attendee_report.php?event_id=<?= $event_id; ?>&download_csv=true" class="btn btn-success">
                            📥 Download Attendee List (CSV)
                        </a>
                    </div>

                    <button class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#fetcheventdataadmin"><i class="fa fa-bolt" style="font-size:13px;color:white; margin-right:5px;"></i>
                Fetch Event Details API
            </button>
                </div>


                <!-- modal -->
                <div class="modal fade" id="fetcheventdataadmin" tabindex="-1" aria-labelledby="fetcheventdataadmin" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="fetchalldata"> API Endpoint</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="container">
                
                    <div class="copy-container">
                        <span id="api-endpoint"><?php echo BASE_URL;?>API/get_event_details.php?event_id=<?php echo $event_id; ?></span>
                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard()" title="Copy to clipboard"></i>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Done</button>
                </div>
                </div>
            </div>
            </div>
        </div>
                <!-- modal -->
                <!-- Attendee Table -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover border">
                        <thead class="table-dark">
                            <tr>
                                <th>Attendee Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($attendee = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($attendee['attendee_name']); ?></td>
                                    <td><?= htmlspecialchars($attendee['attendee_email']); ?></td>
                                    <td><?= htmlspecialchars($attendee['attendee_phone']); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?event_id=<?= $event_id; ?>&page=<?= max(1, $page - 1); ?>" aria-label="Previous">
                                    <span aria-hidden="true">« Previous</span>
                                </a>
                            </li>
                            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?event_id=<?= $event_id; ?>&page=<?= min($total_pages, $page + 1); ?>" aria-label="Next">
                                    <span aria-hidden="true">Next »</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../content/templates/authenticated/footer.php"; ?>
