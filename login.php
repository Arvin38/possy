<?php
session_start();
require_once 'config.php';
require_once 'auth.php';

// If already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

// Process login form
$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = "Username and password are required";
    } else {
        $result = loginUser($username, $password);
        if ($result['success']) {
            $_SESSION['user_id'] = $result['user_id'];
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = $result['message'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Inventory Management System</title>
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
        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 15px;
        }
        .login-card {
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .login-header {
            font-size: 1.5rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .login-subheader {
            font-size: 0.875rem;
            color: #6c757d;
            margin-bottom: 1.5rem;
        }
        .login-logo {
            margin-bottom: 1.5rem;
        }
        .social-login {
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .social-divider {
            text-align: center;
            position: relative;
            margin: 1.5rem 0;
        }
        .social-divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #dee2e6;
            z-index: 1;
        }
        .social-divider span {
            position: relative;
            z-index: 2;
            background: white;
            padding: 0 1rem;
            color: #6c757d;
            font-size: 0.8rem;
        }
        .custom-checkbox {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card login-card border-0">
            <div class="card-body p-4">
                <div class="text-center login-logo">
                    <img src="assets/img/apostle_logo.svg" alt="Apostle" height="40">
                </div>
                <h4 class="text-center login-header">Login</h4>
                <p class="text-center login-subheader">Sign in to your account</p>
                
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="post" action="login.php">
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="far fa-user text-muted"></i></span>
                            <input type="text" class="form-control border-start-0" id="username" name="username" placeholder="Username">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-lock text-muted"></i></span>
                            <input type="password" class="form-control border-start-0" id="password" name="password" placeholder="Password">
                        </div>
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label custom-checkbox" for="remember">Remember me</label>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary py-2">Login</button>
                    </div>
                    
                    <div class="text-center mt-3">
                        <a href="reset_password.php" class="text-decoration-none small">I forgot my password. Click here to reset</a>
                    </div>
                    
                    <div class="social-divider">
                        <span>or continue with</span>
                    </div>
                    
                    <div class="d-flex justify-content-center gap-3 social-login">
                        <a href="#" class="btn btn-outline-primary">
                            <i class="fab fa-facebook"></i> Facebook
                        </a>
                        <a href="#" class="btn btn-outline-danger">
                            <i class="fab fa-google"></i> Google
                        </a>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="register.php" class="btn btn-outline-secondary py-2">Register New Account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
