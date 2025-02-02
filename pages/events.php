<?php

$pageTitle = "Events";

include '../content/templates/authenticated/header.php';
include "../content/templates/authenticated/sidebar.php";

// Pagination Variables
$limit = 5; // Number of events per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page
$start = ($page - 1) * $limit; // Calculate the starting point for SQL LIMIT

// Handle search query
$search = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query = "SELECT event_id, event_name, event_date, event_description, created_at 
              FROM events 
              WHERE user_id = $user_id 
              AND (event_name LIKE '%$search%' OR event_description LIKE '%$search%') 
              ORDER BY created_at DESC LIMIT $start, $limit";
} else {
    $query = "SELECT event_id, event_name, event_date, event_description, created_at 
              FROM events 
              WHERE user_id = $user_id 
              ORDER BY created_at DESC LIMIT $start, $limit";
}

$result = mysqli_query($conn, $query);

// Get total number of events for pagination
$totalQuery = isset($_GET['search']) ?
    "SELECT COUNT(*) as total FROM events WHERE user_id = $user_id AND (event_name LIKE '%$search%' OR event_description LIKE '%$search%')" :
    "SELECT COUNT(*) as total FROM events WHERE user_id = $user_id";


$totalResult = mysqli_query($conn, $totalQuery);
$totalData = mysqli_fetch_assoc($totalResult);
$totalEvents = $totalData['total'];
$totalPages = ceil($totalEvents / $limit); // Calculate total number of pages
?>
<div class="main-content" id="main-content" >
    <div class="header-with-button">
        <h1 class="header-text">Dashboard > Events </h1>
    
        <button type="button" class="action-button" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus" style="font-size:13px;color:white; margin-right:5px;"></i>
        Add Event
        </button>
    
    </div>

    <div class="max-w-6xl mx-auto bg-white p-6 shadow-md rounded-lg">
        <div class="d-flex justify-content-between align-items-center mb-4">
    
            <form method="GET" action="" class="d-flex">
                <div class="input-group">
                    <input type="text" name="search" placeholder="Search events..." 
                        value="<?= htmlspecialchars($search ?? '') ?>" 
                        class="form-control" aria-label="Search Events">
                    <button type="submit" class="btn btn-info">
                        🔍 Search
                    </button>
                </div>
            </form>
            <?php if($user_role=="admin") { ?>
            <button class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#fetchalldataadmin"><i class="fa fa-bolt" style="font-size:13px;color:white; margin-right:5px;"></i>
                Fetch all data API
            </button>
           <?php }  ?>
            <?php if($user_role=="user") { ?>
            <button class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#fetchalldatauser"><i class="fa fa-bolt" style="font-size:13px;color:white; margin-right:5px;"></i>
                Fetch all data API
            </button>
           <?php }  ?>
        </div>

<!-- Vertically centered modal -->

<!-- Modal -->
<div class="modal fade" id="fetchalldatauser" tabindex="-1" aria-labelledby="fetchalldatauser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title fs-5" id="fetchalldata"> API Endpoint</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="container">
        
            <div class="copy-container">
                <span id="api-endpoint"><?php echo BASE_URL;?>API/user/get_events.php?user_id=<?php echo $user_id; ?></span>
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
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="fetchalldataadmin" tabindex="-1" aria-labelledby="fetchalldataadmin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="fetchalldata"> API Endpoint</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                
                    <div class="copy-container">
                        <span id="api-endpoint"><?php echo BASE_URL;?>API/get_events.php</span>
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

<!-- Modal -->

        <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
            <tr>
                    <th data-column="0">Event ID</th>
                    <th data-column="1">Event Name</th>
                    <th data-column="2">Event Date</th>
                    <th data-column="3">Description</th>
                    <th>Registration Form</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $index = ($page - 1) * $limit; ?>
                <?php while ($row = $result->fetch_assoc()): 
                    $index++;?>
                    <tr>
                        <td><?php echo htmlspecialchars($index); ?></td>
                        <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['event_date']); ?></td>
                        <td class="truncate" title="<?php echo htmlspecialchars($row['event_description']); ?>">
                                <?php echo htmlspecialchars(substr($row['event_description'], 0, 100)) . (strlen($row['event_description']) > 100 ? '...' : ''); ?>
                            </td>

                        <td class="view-form">
                            <a href="<?php echo BASE_URL; ?>pages/event/registration.php?event_id=<?php echo $row['event_id']; ?>" target="_blank">
                            <i class="fa fa-external-link" style="font-size:13px;color:green; margin-right:5px;"></i>
                            </a>
                        </td>
                        <td class="action-links">
                            <a href="<?php echo BASE_URL; ?>pages/event.php?event_id=<?php echo $row['event_id']; ?>" class="view"><i class="fa fa-eye" style="font-size:13px;color:green; margin-right:5px;"></i>View</a>

                            <a href="edit_event.php?event_id=<?php echo $row['event_id']; ?>" class="edit"><i class="fa fa-edit" style="font-size:13px;color:blue; margin-right:5px;"></i> Edit</a>
                            

                            <a class="delete-event delete" data-id="<?= $row['event_id'] ?>">
                            <i class="fa fa-trash" style="font-size:13px;color:red; margin-right:5px;"></i> Delete
                            </a>

                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p style="color: #e74c3c; text-align: center; font-size: 18px;">No events found.</p>
        <?php endif; ?>

        <div class="mt-4 d-flex justify-content-center">
            <nav>
                <ul class="pagination">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a href="?page=1<?= $search ? '&search=' . urlencode($search) : '' ?>" 
                            class="page-link bg-dark text-white py-1 px-2 m-1 rounded border-0">First</a>
                        </li>
                        <li class="page-item">
                            <a href="?page=<?= $page - 1 ?><?= $search ? '&search=' . urlencode($search) : '' ?>" 
                            class="page-link bg-dark text-white py-1 px-2 m-1 rounded border-0">Prev</a>
                        </li>
                    <?php endif; ?>

                    <!-- Page Number Links -->
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a href="?page=<?= $i ?><?= $search ? '&search=' . urlencode($search) : '' ?>" 
                            class="page-link bg-dark text-white py-1 px-2 m-1 rounded border-0 <?= ($i == $page) ? 'fw-bold' : '' ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                        <li class="page-item">
                            <a href="?page=<?= $page + 1 ?><?= $search ? '&search=' . urlencode($search) : '' ?>" 
                            class="page-link bg-dark text-white py-1 px-2 m-1 rounded border-0">Next</a>
                        </li>
                        <li class="page-item">
                            <a href="?page=<?= $totalPages ?><?= $search ? '&search=' . urlencode($search) : '' ?>" 
                            class="page-link bg-dark text-white py-1 px-2 m-1 rounded border-0">Last</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>


    </div>
</div>


<?php
include "../content/templates/data/modal.php";
include "../content/templates/authenticated/footer.php";
?>

