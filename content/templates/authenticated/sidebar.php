<div class="sidebar" id="sidebar">
    <div class="toggle-btn float-right" onclick="toggleSidebar()">
        ☰
    </div>
    <a href="<?php echo BASE_URL; ?>pages/dashboard.php" 
        class="<?php echo (BASE_URL . 'pages/dashboard.php' === 'http://localhost' . $_SERVER['REQUEST_URI']) ? 'active' : ''; ?>">
        <i class="fas fa-home icon"></i><span>Dashboard</span>
    </a>
  

    <?php if($user_role=="user") { ?> 
    <a href="<?php echo BASE_URL; ?>pages/events.php" 
        class="<?php echo (BASE_URL . 'pages/events.php' === 'http://localhost' . $_SERVER['REQUEST_URI']) ? 'active' : ''; ?>">
        <i class="fas fa-calendar-alt icon"></i><span>Events</span>
    </a>
    <?php } ?>
    <?php if($user_role=="admin") { ?>  
           
    <a href="<?php echo BASE_URL; ?>pages/admin_events.php" 
        class="<?php echo (BASE_URL . 'pages/admin_events.php' === 'http://localhost' . $_SERVER['REQUEST_URI']) ? 'active' : ''; ?>">
        <i class="fas fa-calendar-alt icon"></i><span>All Events</span>
    </a>
    <?php } ?>

</div>
