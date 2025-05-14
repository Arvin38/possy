<?php
session_start();
require_once 'config.php';
require_once 'data.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productName = $_POST['productName'] ?? '';
    $sku = $_POST['sku'] ?? '';
    $category = $_POST['category'] ?? '';
    $buyingPrice = $_POST['buyingPrice'] ?? 0;
    $sellingPrice = $_POST['sellingPrice'] ?? 0;
    $quantity = $_POST['quantity'] ?? 0;
    $unit = $_POST['unit'] ?? 'Pieces';
    $expiryDate = $_POST['expiryDate'] ?? null;
    $description = $_POST['description'] ?? '';
    
    // Validate inputs
    $errors = [];
    
    if (empty($productName)) {
        $errors[] = "Product name is required";
    }
    
    if (empty($sku)) {
        $errors[] = "SKU is required";
    }
    
    if (empty($category)) {
        $errors[] = "Category is required";
    }
    
    if ($buyingPrice <= 0) {
        $errors[] = "Buying price must be greater than zero";
    }
    
    if ($sellingPrice <= 0) {
        $errors[] = "Selling price must be greater than zero";
    }
    
    if ($quantity < 0) {
        $errors[] = "Quantity cannot be negative";
    }
    
    // If there are no errors, add the product
    if (empty($errors)) {
        $result = addProduct([
            'name' => $productName,
            'sku' => $sku,
            'category_id' => $category,
            'cost_price' => $buyingPrice,
            'price' => $sellingPrice,
            'quantity' => $quantity,
            'unit' => $unit,
            'expiry_date' => $expiryDate,
            'description' => $description
        ]);
        
        if ($result['success']) {
            $_SESSION['success_message'] = "Product added successfully";
        } else {
            $_SESSION['error_message'] = $result['message'];
        }
    } else {
        $_SESSION['error_message'] = implode(", ", $errors);
    }
    
    // Redirect back to inventory page
    header("Location: inventory.php");
    exit();
}
else {
    // If not POST request, redirect to inventory page
    header("Location: inventory.php");
    exit();
}
?>
