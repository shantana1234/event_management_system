<?php

require_once '../includes/config.php';
$pageTitle = "Sign Up";

include '../content/templates/guest/header.php';

$is_logged_in = isset($_SESSION['user_id']);
if ($is_logged_in) {

    header("Location: ../pages/dashboard.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = "user";

    if (!empty($name) && !empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<div class='alert alert-danger'>Email is already registered!</div>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);

            if ($stmt->execute()) {
                // Fetch the ID of the newly registered user
                $user_id = $stmt->insert_id;

                // Save user details in the session
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $name;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_role'] = $role;

                // Redirect to profile page
                header("Location: ../pages/dashboard.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'>Something went wrong.</div>";
            }
        }
        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>All fields are required!</div>";
    }
}

?>

<div class="container d-flex justify-content-center align-items-center padding-guest">
    <div class="form-container">
        <div class="form-header text-center">
            <h2>Register</h2>
        </div>
        <form id="signupForm" action="signup.php" method="POST" novalidate>
            <div class="mb-3 input-with-icon">
                <i class="form-icon fas fa-user"></i>
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                <small class="text-danger d-none" id="nameError">Name must be at least 3 characters.</small>
            </div>
            <div class="mb-3 input-with-icon">
                <i class="form-icon fas fa-envelope"></i>
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                <small class="text-danger d-none" id="emailError">Please enter a valid email address.</small>
            </div>
            <div class="mb-3 input-with-icon">
                <i class="form-icon fas fa-lock"></i>
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                <small class="text-danger d-none" id="passwordError">
                    Password must be at least 8 characters, include an uppercase, lowercase, number, and special character.
                </small>
            </div>
            <button type="submit" name="register" class="btn btn-success w-100">Register</button>
        </form>
    </div>
</div>


    <?php
include '../content/templates/guest/footer.php';
?>