<?php

require_once '../includes/config.php';
session_start(); // Start session
// include "../content/templates/authenticated/header.php";
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../content/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];
$user_role = $_SESSION['user_role'];

// var_dump($_SERVER['REQUEST_URI']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/fullcalendar.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  
  
   
    
    <style>
        /* Header styles */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 60px;
            background-color: #343a40;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            z-index: 1000;
        }
        .header .title {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .header .logout-btn {
            color: white;
            text-decoration: none;
            font-size: 1rem;
        }
        /* Sidebar styles */
        .sidebar {
            height: calc(100vh - 60px); /* Subtract header height */
            width: 250px;
            position: fixed;
            top: 60px; /* Below the header */
            left: 0;
            background-color: #343a40;
            padding: 15px;
            transition: width 0.3s;
            overflow: hidden;
        }
        .sidebar.minimized {
            width: 70px;
        }
        .sidebar a {
            color: white;
            display: flex;
            align-items: center;
            text-decoration: none;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            transition: background-color 0.3s, padding 0.3s;
        }
        .sidebar a.active {
            background-color: #495057;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .sidebar .icon {
            margin-right: 10px;
        }
        .sidebar.minimized .icon {
            margin-right: 0;
        }
        .sidebar.minimized a span {
            display: none;
        }
        .sidebar .toggle-btn {
            color: white;
            text-align: center;
            cursor: pointer;
            margin-bottom: 10px;
        }
        .main-content {
            margin-left: 150px;
            margin-top: 60px; /* Below the header */
            margin-bottom: 60px; /* Below the header */
            padding: 20px;
            transition: margin-left 0.3s;
        }
        .main-content.minimized {
            margin-top: 20px;
            margin-left: 70px;
        }
        .card-header {
            font-weight: bold;
        }
        .footer{
            background-color: #343a40;
        }

        /** table events */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table thead {
            background-color:rgb(57, 59, 61);
            color: white;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        table tbody tr:nth-child(even) {
            background-color: #ffffff;
        }

        table tbody tr:hover {
            background-color: #f1f1f1;
        }

        h1 {
            color: #2c3e50;
            text-align: center;
        }

        .action-links a {
            text-decoration: none;
            margin: 0 8px;
            font-size: 12px;
            font-weight: bold;
        }

        .action-links a.view {
            color:rgb(0, 83, 35);
        }

        .action-links a.edit {
            color:rgb(16, 27, 91);
        }

        .action-links a.delete {
            color:rgb(147, 15, 0);
        }

        .action-links a:hover {
            opacity: 0.8;
        }

        .view-form a {
            color: #3498db;
            text-decoration: none;
        }

        .view-form a:hover {
            text-decoration: underline;
        }
        .truncate {
            max-width: 400px; /* Limits the width for the description column */
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .header-with-button {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 5px;
        margin-bottom: 20px; /* Add spacing below */
    }

    .header-text {
        font-size: 20px; /* Larger font for the header */
        color: #2c3e50; /* Darker color for the text */
        margin: 0; /* Remove default margin */
    }

    .action-button {
        padding: 8px 30px; /* Add padding for the button */
        background-color:rgb(11, 109, 17); /* Primary blue color */
        color: #fff; /* White text */
        border: none; /* Remove border */
        border-radius: 5px; /* Rounded corners */
        cursor: pointer; /* Pointer cursor on hover */
        font-size: 14px; /* Button text size */
        transition: background-color 0.3s ease; /* Smooth hover effect */
    }

    .action-button:hover {
        background-color:rgb(43, 143, 83); /* Darker blue on hover */
        color: black;
    }

    /* modal */
    form {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .form-label{
        font-weight: bold;
    }
    input:focus, textarea:focus, select:focus {
    outline: none; /* Removes the default blue outline */
    box-shadow: 0 0 4px 2px rgba(0, 128, 0, 0.5); /* Adds a green glow */
    border-color: #008000; /* Optional: Change border color */
    }
    .custom-popup {
    border-radius: 12px;
    box-shadow: 0px 0px 10px rgba(23, 18, 18, 0.3);
    background-color: white;
}

.custom-title {
    font-size: 15px;
    font-weight: bold;
    color: red;
}
.swal2-html-container {
    font-size: 14px;
    font-weight: bold;
}

.custom-confirm-btn {
    font-size: 12px !important;
    font-weight: bold !important;
    padding: 8px 16px !important;
    border-radius: 8px !important;
}

.custom-cancel-btn {
    font-size: 12px !important;
    font-weight: bold !important;
    padding: 8px 16px !important;
    border-radius: 8px !important;
}

.copy-container {
            background-color: #f5f5f5; /* Light Gray */
            padding: 12px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            font-size: 12px;
        }
        .copy-icon {
            cursor: pointer;
            color: #6c757d;
            transition: color 0.3s ease;
            font-size: 20px;
        }
        .copy-icon:hover {
            color: #007bff; /* Blue on hover */
        }
    </style>
</head>
<body>
<div class="header">
        <div class="title">Dashboard</div>
        <a href="../pages/logout.php" class="logout-btn">Logout</a>
    </div>
    <div class="container mt-4">