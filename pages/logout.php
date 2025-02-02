<?php
session_start(); // Start session

// Destroy session
session_unset();
session_destroy();

// Redirect to login or home page
header("Location: ../index.php");
exit();
?>
