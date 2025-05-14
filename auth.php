<?php
/**
 * Auth Module
 * Handles user authentication and authorization
 */

/**
 * Attempt to login a user
 * 
 * @param string $username The username
 * @param string $password The password
 * @return array Success status and message
 */
function loginUser($username, $password) {
    // In real application, validate against database
    // For demo, we'll use hardcoded values
    $validUsers = [
        'admin' => [
            'id' => 1,
            'password' => 'admin123',
            'full_name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'Administrator'
        ],
        'manager' => [
            'id' => 2,
            'password' => 'manager123',
            'full_name' => 'Store Manager',
            'email' => 'manager@example.com',
            'role' => 'Manager'
        ],
        'staff' => [
            'id' => 3,
            'password' => 'staff123',
            'full_name' => 'Staff Member',
            'email' => 'staff@example.com',
            'role' => 'Staff'
        ]
    ];
    
    if (!isset($validUsers[$username])) {
        return ['success' => false, 'message' => 'Invalid username or password'];
    }
    
    $user = $validUsers[$username];
    
    if ($password !== $user['password']) {
        return ['success' => false, 'message' => 'Invalid username or password'];
    }
    
    // Update last login (would be stored in db in real app)
    $user['last_login'] = date('Y-m-d H:i:s');
    
    return [
        'success' => true, 
        'message' => 'Login successful',
        'user_id' => $user['id']
    ];
}

/**
 * Reset password for user
 * 
 * @param string $email User email
 * @return array Success status and message
 */
function resetPassword($email) {
    // In real application, check if email exists in database
    // Then send reset link/token via email
    
    $validEmails = [
        'admin@example.com',
        'manager@example.com',
        'staff@example.com'
    ];
    
    if (!in_array($email, $validEmails)) {
        return ['success' => false, 'message' => 'Email address not found'];
    }
    
    // Simulate sending email
    return ['success' => true, 'message' => 'Password reset instructions sent to email'];
}

/**
 * Get user by ID
 * 
 * @param int $userId User ID
 * @return array|null User data or null if not found
 */
function getUserById($userId) {
    // In real application, fetch from database
    $users = [
        1 => [
            'id' => 1,
            'username' => 'admin',
            'full_name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'Administrator',
            'last_login' => date('Y-m-d H:i:s', strtotime('-2 hours')),
            'created_at' => date('Y-m-d H:i:s', strtotime('-1 year'))
        ],
        2 => [
            'id' => 2,
            'username' => 'manager',
            'full_name' => 'Store Manager',
            'email' => 'manager@example.com',
            'role' => 'Manager',
            'last_login' => date('Y-m-d H:i:s', strtotime('-1 day')),
            'created_at' => date('Y-m-d H:i:s', strtotime('-6 months'))
        ],
        3 => [
            'id' => 3,
            'username' => 'staff',
            'full_name' => 'Staff Member',
            'email' => 'staff@example.com',
            'role' => 'Staff',
            'last_login' => date('Y-m-d H:i:s', strtotime('-5 days')),
            'created_at' => date('Y-m-d H:i:s', strtotime('-2 months'))
        ]
    ];
    
    return isset($users[$userId]) ? $users[$userId] : null;
}

/**
 * Update user profile
 * 
 * @param int $userId User ID
 * @param array $data Update data
 * @return array Success status and message
 */
function updateUser($userId, $data) {
    // In real application, update database
    // Just simulation in this version
    
    // Validate current password if changing password
    if (isset($data['password']) && isset($data['current_password'])) {
        // In real app, verify current password against stored hash
        if ($data['current_password'] !== 'admin123') {
            return ['success' => false, 'message' => 'Current password is incorrect'];
        }
        
        // Password validation
        if (strlen($data['password']) < 6) {
            return ['success' => false, 'message' => 'Password must be at least 6 characters long'];
        }
    }
    
    return ['success' => true, 'message' => 'Profile updated successfully'];
}
?>
