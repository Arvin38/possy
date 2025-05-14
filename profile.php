<?php
session_start();
require_once 'config.php';
require_once 'data.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user data
$user = getUserById($_SESSION['user_id']);

// Handle profile update
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = $_POST['fullName'] ?? '';
    $email = $_POST['email'] ?? '';
    $currentPassword = $_POST['currentPassword'] ?? '';
    $newPassword = $_POST['newPassword'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';
    
    // Validate inputs
    if (empty($fullName) || empty($email)) {
        $message = "Full name and email are required";
        $messageType = "danger";
    } elseif (!empty($newPassword) && $newPassword != $confirmPassword) {
        $message = "New password and confirm password do not match";
        $messageType = "danger";
    } else {
        $updateData = [
            'full_name' => $fullName,
            'email' => $email
        ];
        
        // Only update password if provided
        if (!empty($newPassword)) {
            $updateData['password'] = $newPassword;
            $updateData['current_password'] = $currentPassword;
        }
        
        $result = updateUser($_SESSION['user_id'], $updateData);
        
        if ($result['success']) {
            $message = "Profile updated successfully";
            $messageType = "success";
            $user = getUserById($_SESSION['user_id']); // Refresh user data
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
    <title>Profile - Inventory Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="d-flex">
        <?php include 'includes/sidebar.php'; ?>
        
        <div class="content-wrapper">
            <?php include 'includes/header.php'; ?>
            
            <div class="container-fluid p-4">
                <h2 class="mb-4">My Profile</h2>
                
                <?php if ($message): ?>
                    <div class="alert alert-<?php echo $messageType; ?>"><?php echo $message; ?></div>
                <?php endif; ?>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body text-center p-4">
                                <div class="avatar-container mb-3">
                                    <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['full_name']); ?>&background=random&color=fff&size=128" class="rounded-circle img-thumbnail" alt="Profile Picture">
                                </div>
                                <h5><?php echo $user['full_name']; ?></h5>
                                <p class="text-muted"><?php echo $user['email']; ?></p>
                                <div class="mt-3">
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-camera"></i> Change Photo
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Account Details</h5>
                                <div class="mt-3">
                                    <p class="mb-1"><strong>Username:</strong> <?php echo $user['username']; ?></p>
                                    <p class="mb-1"><strong>Role:</strong> <?php echo $user['role']; ?></p>
                                    <p class="mb-1"><strong>Last Login:</strong> <?php echo date('M d, Y H:i', strtotime($user['last_login'])); ?></p>
                                    <p class="mb-0"><strong>Account Created:</strong> <?php echo date('M d, Y', strtotime($user['created_at'])); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Edit Profile</h5>
                                
                                <form method="post" action="profile.php" class="mt-4">
                                    <div class="mb-3">
                                        <label for="fullName" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="fullName" name="fullName" value="<?php echo $user['full_name']; ?>" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" value="<?php echo $user['username']; ?>" disabled>
                                        <div class="form-text">Username cannot be changed</div>
                                    </div>
                                    
                                    <hr class="my-4">
                                    
                                    <h6>Change Password</h6>
                                    
                                    <div class="mb-3">
                                        <label for="currentPassword" class="form-label">Current Password</label>
                                        <input type="password" class="form-control" id="currentPassword" name="currentPassword">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="newPassword" class="form-label">New Password</label>
                                        <input type="password" class="form-control" id="newPassword" name="newPassword">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                                    </div>
                                    
                                    <div class="d-grid gap-2 mt-4">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include 'includes/footer.php'; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
