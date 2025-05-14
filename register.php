<?php
session_start();
require_once 'config.php';
require_once 'auth.php';

// If already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

// Process registration form
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = $_POST['fullName'] ?? '';
    $email = $_POST['email'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';
    
    // Validate inputs
    if (empty($fullName) || empty($email) || empty($username) || empty($password) || empty($confirmPassword)) {
        $message = "All fields are required";
        $messageType = "danger";
    } elseif ($password != $confirmPassword) {
        $message = "Passwords do not match";
        $messageType = "danger";
    } elseif (strlen($password) < 6) {
        $message = "Password must be at least 6 characters long";
        $messageType = "danger";
    } else {
        // In a real app, this would register the user in the database
        // For demo, we'll just show success message
        $message = "Registration successful! You can now log in.";
        $messageType = "success";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Inventory Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .register-container {
            width: 100%;
            max-width: 550px;
            padding: 15px;
        }
        .register-card {
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .register-header {
            font-size: 1.5rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .register-subheader {
            font-size: 0.875rem;
            color: #6c757d;
            margin-bottom: 1.5rem;
        }
        .register-logo {
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="card register-card border-0">
            <div class="card-body p-4">
                <div class="text-center register-logo">
                    <img src="assets/img/apostle_logo.svg" alt="Apostle" height="40">
                </div>
                <h4 class="text-center register-header">Create New Account</h4>
                <p class="text-center register-subheader">Enter your details to register</p>
                
                <?php if ($message): ?>
                    <div class="alert alert-<?php echo $messageType; ?>"><?php echo $message; ?></div>
                <?php endif; ?>
                
                <form method="post" action="register.php">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="far fa-user text-muted"></i></span>
                                <input type="text" class="form-control border-start-0" id="fullName" name="fullName" placeholder="Enter your full name">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="far fa-envelope text-muted"></i></span>
                                <input type="email" class="form-control border-start-0" id="email" name="email" placeholder="Enter your email">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="fas fa-at text-muted"></i></span>
                                <input type="text" class="form-control border-start-0" id="username" name="username" placeholder="Choose a username">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="fas fa-lock text-muted"></i></span>
                                <input type="password" class="form-control border-start-0" id="password" name="password" placeholder="Create a password">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="fas fa-lock text-muted"></i></span>
                                <input type="password" class="form-control border-start-0" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="termsAgree" name="termsAgree" required>
                        <label class="form-check-label" for="termsAgree">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
                    </div>
                    
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary py-2">Create Account</button>
                    </div>
                    
                    <div class="text-center mt-4">
                        <p class="mb-0">Already have an account? <a href="login.php" class="text-decoration-none">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>