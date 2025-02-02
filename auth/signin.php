<?php

require_once '../includes/config.php';
$pageTitle = "Login";

include '../content/templates/guest/header.php';

// Redirect logged-in users to the dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: ../pages/dashboard.php");
    exit();
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT id, name, email, password ,role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $user_name, $user_email, $hashed_password, $user_role);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Save user details in the session
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['user_role'] = $user_role;

                // Redirect to the dashboard
                header("Location: ../pages/dashboard.php");
                exit();
            } else {
                echo "<div class='alert alert-danger margin-guest'>Incorrect password!</div>";
            }
        } else {
            echo "<div class='alert alert-danger margin-guest'>Email not found!</div>";
        }
        $stmt->close();
    } else {
        echo "<div class='alert alert-danger margin-guest'>All fields are required!</div>";
    }
}
?>

<div class="container d-flex justify-content-center align-items-center padding-guest">
    <div class="form-container">
        <div class="form-header text-center">
            <h2>Login</h2>
        </div>
        <form action="signin.php" method="POST">
            <div class="mb-3 input-with-icon">
                <i class="form-icon fas fa-envelope"></i>
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3 input-with-icon">
                <i class="form-icon fas fa-lock"></i>
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="mt-3 text-center">
            <p>Don't have an account? <a href="signup.php">Register here</a></p>
        </div>
    </div>
</div>

<?php
include '../content/templates/guest/footer.php';
?>
