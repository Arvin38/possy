<?php
session_start();
require_once 'config.php';
require_once 'data.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get dashboard data
$salesData = getSalesData();
$inventorySummary = getInventorySummary();
$productSummary = getProductSummary();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Inventory Management System</title>
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
                <h2 class="mb-4">Dashboard</h2>
                
                <!-- Sales Overview Section -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Sale Overview</h5>
                        <div class="row mt-4">
                            <div class="col-md-2">
                                <div class="stats-item text-center">
                                    <h3 class="text-primary">$<?php echo number_format($salesData['totalSales']); ?></h3>
                                    <p class="text-muted mb-0">Total Sales</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="stats-item text-center">
                                    <h3 class="text-info">$<?php echo number_format($salesData['cost']); ?></h3>
                                    <p class="text-muted mb-0">Cost</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="stats-item text-center">
                                    <h3 class="text-success">$<?php echo number_format($salesData['revenue']); ?></h3>
                                    <p class="text-muted mb-0">Revenue</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="stats-item text-center">
                                    <h3 class="text-warning"><?php echo $salesData['orders']; ?></h3>
                                    <p class="text-muted mb-0">Orders</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="stats-item text-center">
                                    <h3 class="text-danger">$<?php echo number_format($salesData['avg']); ?></h3>
                                    <p class="text-muted mb-0">AVG</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="stats-item text-center">
                                    <h3 class="text-dark">$<?php echo number_format($salesData['profit']); ?></h3>
                                    <p class="text-muted mb-0">Profit</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Sales Chart -->
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title">Sales & Purchases</h5>
                                    <select class="form-select form-select-sm" style="width: 120px;">
                                        <option selected>Monthly</option>
                                        <option>Weekly</option>
                                        <option>Daily</option>
                                    </select>
                                </div>
                                <canvas id="salesChart" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Inventory Summary -->
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Inventory Summary</h5>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <h4 class="mb-0 text-primary"><?php echo $inventorySummary['totalProducts']; ?></h4>
                                            <p class="text-muted mb-0">Total Products</p>
                                        </div>
                                        <div class="bg-light rounded-circle p-3">
                                            <i class="fas fa-box text-primary"></i>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <h4 class="mb-0 text-success"><?php echo $inventorySummary['totalCategories']; ?></h4>
                                            <p class="text-muted mb-0">Total Categories</p>
                                        </div>
                                        <div class="bg-light rounded-circle p-3">
                                            <i class="fas fa-tags text-success"></i>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <h4 class="mb-0 text-danger"><?php echo $inventorySummary['lowStock']; ?></h4>
                                            <p class="text-muted mb-0">Low Stock Items</p>
                                        </div>
                                        <div class="bg-light rounded-circle p-3">
                                            <i class="fas fa-exclamation-triangle text-danger"></i>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4 class="mb-0 text-warning"><?php echo $inventorySummary['outOfStock']; ?></h4>
                                            <p class="text-muted mb-0">Out of Stock</p>
                                        </div>
                                        <div class="bg-light rounded-circle p-3">
                                            <i class="fas fa-times-circle text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Product Summary -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Product Summary</h5>
                                <div class="row mt-4">
                                    <?php foreach ($productSummary as $product): ?>
                                    <div class="col-md-4 mb-3">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1"><?php echo $product['name']; ?></h6>
                                                <p class="mb-1 text-muted small">Price: $<?php echo number_format($product['price'], 2); ?></p>
                                                <p class="mb-0 text-muted small">Qty: <?php echo $product['quantity']; ?> in stock</p>
                                                <?php if ($product['quantity'] <= 5): ?>
                                                <span class="badge bg-danger">Low Stock</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include 'includes/footer.php'; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/chart.js"></script>
</body>
</html>
