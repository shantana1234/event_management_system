<?php
include 'includes/config.php';
include 'content\templates\guest\header.php';

// Your existing queries for upcoming, finished, and top events
$upcomingEvents = mysqli_query($conn, "SELECT * FROM events WHERE event_date > CURDATE() ORDER BY event_date LIMIT 6");
$finishedEvents = mysqli_query($conn, "SELECT * FROM events WHERE event_date <= CURDATE() ORDER BY event_date DESC LIMIT 6");
$topEvents = mysqli_query($conn, "SELECT e.*, COUNT(a.event_id) AS total_attendees FROM events e LEFT JOIN event_attendees a ON e.event_id = a.event_id GROUP BY e.event_id ORDER BY total_attendees DESC LIMIT 5");
?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div>
            <h1 class="display-3 fw-bold">Manage Your Event</h1>
            <p class="lead mb-4">Create, track, and manage all your events in one place.</p>
            <a href="#" class="btn btn-primary btn-lg">Get Started</a>
        </div>
    </section>

    <!-- Features Section -->
    <div class="container py-5">
        <h2 class="text-center mb-4">Our Features</h2>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <i class="fas fa-calendar-alt fa-3x mb-3"></i>
                    <h3>Create Events</h3>
                    <p>Create and manage events with ease.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <h3>Track Attendees</h3>
                    <p>Track your event's attendees and their statuses.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <i class="fas fa-cogs fa-3x mb-3"></i>
                    <h3>Manage Event Details</h3>
                    <p>Edit dates, times, and locations with ease.</p>
                </div>
            </div>
        </div>
    </div>

 <!-- Your existing content goes here -->
<section class="container pb-5">
    <div class="row">
        <div class="col-md-8">
            <div class="mb-4 bg-light p-4 rounded shadow">
                <h4 class="bg-primary text-white p-2 rounded mb-4">
                    <i class="fas fa-calendar-alt mr-2"></i> Upcoming Events
                </h4>
                <div class="row">
                    <?php while ($event = mysqli_fetch_assoc($upcomingEvents)) { ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKF_YlFFlKS6AQ8no0Qs_xM6AkjvwFwP61og&s" class="card-img-top" alt="<?= $event['event_name']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($event['event_name']); ?></h5>
                                    <p class="card-text"><?= nl2br(htmlspecialchars($event['event_description'])); ?></p>
                                    <p class="text-muted"><?= date('F j, Y', strtotime($event['event_date'])); ?></p>
                                    <a href="<?php echo BASE_URL; ?>pages/event/registration.php?event_id=<?php echo $event['event_id']; ?>" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="bg-light p-4 rounded shadow">
                <h4 class="bg-success text-white p-2 rounded mb-4">
                    <i class="fas fa-calendar-check mr-2"></i> Finished Events
                </h4>
                <div class="row">
                    <?php while ($event = mysqli_fetch_assoc($finishedEvents)) { ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKF_YlFFlKS6AQ8no0Qs_xM6AkjvwFwP61og&s" class="card-img-top" alt="<?= $event['event_name']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($event['event_name']); ?></h5>
                                    <p class="card-text"><?= nl2br(htmlspecialchars($event['event_description'])); ?></p>
                                    <p class="text-muted"><?= date('F j, Y', strtotime($event['event_date'])); ?></p>
                                    <a href="<?php echo BASE_URL; ?>pages/event/registration.php?event_id=<?php echo $event['event_id']; ?>" class="btn btn-success">View Details</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">
                    <i class="fas fa-cogs mr-2"></i> Top Events
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php while ($event = mysqli_fetch_assoc($topEvents)) { ?>
                            <li class="list-group-item">
                                <?= htmlspecialchars($event['event_name']); ?>
                                <span class="badge badge-primary float-right"><?= $event['total_attendees']; ?> Attendees</span>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
</div>


<?php
include 'content\templates\guest\footer.php';
?>
