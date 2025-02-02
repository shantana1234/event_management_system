<?php
// Include configuration and templates
include '../includes/config.php';
include "../content/templates/authenticated/header.php";
include "../content/templates/authenticated/sidebar.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../content/login.php");
    exit();
}


?>

<div class="main-content p-4">
    <div class="header-with-button mb-4">
        <h1 class="header-text h5">Dashboard > Events > Edit Event</h1>
        <a href="view_event.php?event_id=<?= $event_id ?>" class="btn btn-dark btn-sm">
            <i class="fa fa-arrow-left me-2"></i> Back to Event Details
        </a>
    </div>

    <div class="card shadow-lg border-0">
    <div class="p-3 text-warning-emphasis bg-warning-subtle border border-warning-subtle">
            <i class="fa fa-edit me-2"></i> Edit Event
        </div>
        <div class="card-body">
            <form id="eventFormUp">
                <!-- Event Name -->
                <div class="mb-4">
                    <label for="event_name" class="form-label fw-bold text-dark">
                        <i class="fa fa-font me-2 text-success"></i> Event Name
                    </label>
                    <input type="text" id="event_name" name="event_name" class="form-control border border-success" value="<?= htmlspecialchars($event['event_name']) ?>" required>
                </div>

                <!-- Event Description -->
                <div class="mb-4">
                    <label for="event_description" class="form-label fw-bold text-dark">
                        <i class="fa fa-file-alt me-2 text-info"></i> Event Description
                    </label>
                    <textarea id="event_description" name="event_description" class="form-control border border-info" rows="5" required><?= htmlspecialchars($event['event_description']) ?></textarea>
                </div>

                <!-- Event Date -->
                <div class="mb-4">
                    <label for="event_date" class="form-label fw-bold text-dark">
                        <i class="fa fa-calendar-check me-2 text-warning"></i> Event Date
                    </label>
                    <input type="date" id="event_date" name="event_date" class="form-control border border-warning" value="<?= htmlspecialchars($event['event_date']) ?>" >
                </div>

                <!-- Maximum Attendee -->
                <div class="mb-4">
                    <label for="max_attendee" class="form-label fw-bold text-dark">
                        <i class="fa fa-users me-2 text-danger"></i> Maximum Attendee
                    </label>
                    <input type="number" id="max_attendee" name="max_attendee" class="form-control border border-danger" value="<?= htmlspecialchars($event['max_attendee']) ?>" >
                </div>

                <!-- Event Status -->
                <div class="mb-4">
                    <label for="event_status" class="form-label fw-bold text-dark">
                        <i class="fa fa-flag me-2 text-secondary"></i> Event Status
                    </label>
                    <select id="event_status" name="event_status" class="form-select border border-secondary" required>
                        <option value="publish" <?= ($event['event_status'] ?? '') == 'publish' ? 'selected' : '' ?>>Publish</option>
                        <option value="draft" <?= ($event['event_status'] ?? '') == 'draft' ? 'selected' : '' ?>>Draft</option>
                    </select>

                </div>

                <!-- Submit Button -->
                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save me-2"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include "../content/templates/authenticated/footer.php";
?>
