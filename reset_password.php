<?php
session_start();
require_once 'config.php';
require_once 'auth.php';

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    
    if (empty($email)) {
        $message = "Email address is required";
        $messageType = "danger";
    } else {
        $result = resetPassword($email);
        
        if ($result['success']) {
            $message = "Password reset instructions have been sent to your email";
            $messageType = "success";
        } else {
            $message = $result['message'];
            $messageType = "danger";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Inventory Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="text-center mb-4">Reset Password</h4>
                        
                        <?php if ($message): ?>
                            <div class="alert alert-<?php echo $messageType; ?>"><?php echo $message; ?></div>
                        <?php endif; ?>
                        
                        <form method="post" action="reset_password.php">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="far fa-envelope text-muted"></i></span>
                                    <input type="email" class="form-control border-start-0" id="email" name="email" placeholder="Enter your email address">
                                </div>
                                <div class="form-text">We'll send you instructions to reset your password.</div>
                            </div>
                            
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary">Reset Password</button>
                            </div>
                            
                            <div class="text-center mt-3">
                                <a href="login.php" class="text-decoration-none">
                                    <i class="fas fa-arrow-left"></i> Back to Login
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
