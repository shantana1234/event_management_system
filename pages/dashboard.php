<?php
include '../content/templates/authenticated/header.php';
include "../content/templates/authenticated/sidebar.php";
?>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
         <!-- Dashboard Content -->
     <div class="row">
            <!-- Left Column -->
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-header">Tasks List</div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">Task 1 <span class="badge bg-success float-end">Complete</span></li>
                            <li class="list-group-item">Task 2 <span class="badge bg-warning float-end">Pending</span></li>
                            <li class="list-group-item">Task 3 <span class="badge bg-danger float-end">Overdue</span></li>
                        </ul>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">Upcoming Events</div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">Meeting - 10:00 AM</li>
                            <li class="list-group-item">Presentation - 2:00 PM</li>
                            <li class="list-group-item">Deadline - 5:00 PM</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Middle Column -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">Sales Chart</div>
                    <div class="card-body">
                        <canvas id="salesChart" height="200"></canvas>
                    </div>
                </div>
               
            </div>

            <!-- Right Column -->
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-header">User Statistics</div>
                    <div class="card-body">
                        <p>Total Users: <strong>500</strong></p>
                        <p>Active Users: <strong>350</strong></p>
                        <p>Inactive Users: <strong>150</strong></p>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">Recent Activities</div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">User A logged in</li>
                            <li class="list-group-item">New order placed</li>
                            <li class="list-group-item">System updated</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

<div>


<?php
include "../content/templates/authenticated/footer.php";
?>
