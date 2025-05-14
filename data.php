<?php
/**
 * Data Module
 * Handles data operations for products, inventory, sales, etc.
 */

/**
 * Get sales data for dashboard
 * 
 * @return array Sales statistics
 */
function getSalesData() {
    // In real application, fetch from database
    // Sample data for demonstration
    return [
        'totalSales' => 85762,
        'cost' => 42350,
        'revenue' => 43412,
        'orders' => 2156,
        'avg' => 39.78,
        'profit' => 43412
    ];
}

/**
 * Get inventory summary for dashboard
 * 
 * @return array Inventory statistics
 */
function getInventorySummary() {
    // In real application, calculate from database
    return [
        'totalProducts' => 95,
        'totalCategories' => 8,
        'lowStock' => 12,
        'outOfStock' => 3
    ];
}

/**
 * Get product summary for dashboard
 * 
 * @return array List of products for dashboard
 */
function getProductSummary() {
    // In real application, fetch from database
    return [
        [
            'id' => 1,
            'name' => 'Coffee Beans',
            'image' => 'https://pixabay.com/get/g09b171b5ed8e25846beaf8c75fb4facd1ec57f29366d6b6b1b18103f89dadf0bdb431e1d9a8ee43e8198fed760eb7aa4567631217bd8b501bf955c1ff943c2c0_1280.jpg',
            'price' => 15.99,
            'quantity' => 42
        ],
        [
            'id' => 2,
            'name' => 'Rice',
            'image' => 'https://pixabay.com/get/gb04569e09c01bfb0ebae3c532be17e8cc30eaf7b38453d420eb6de9584f2cbb46711464494a3627186ce667b3b6306f29daa4fef2d912ad3b0bbb9971b06c804_1280.jpg',
            'price' => 20.50,
            'quantity' => 3
        ],
        [
            'id' => 3,
            'name' => 'Office Supplies',
            'image' => 'https://pixabay.com/get/g749487ae0b20caed3d262fbb56871849ea31330bf601af84951294c783333fe98701440317be2f573c72cfc7c36406eb24808ca9eafa4d9fc766150cac632df9_1280.jpg',
            'price' => 45.75,
            'quantity' => 18
        ]
    ];
}

/**
 * Get all products
 * 
 * @return array List of products
 */
function getProducts() {
    // In real application, fetch from database with pagination
    return [
        [
            'id' => 1,
            'name' => 'Coffee Beans',
            'image' => 'https://pixabay.com/get/g09b171b5ed8e25846beaf8c75fb4facd1ec57f29366d6b6b1b18103f89dadf0bdb431e1d9a8ee43e8198fed760eb7aa4567631217bd8b501bf955c1ff943c2c0_1280.jpg',
            'category' => 'Beverages',
            'sku' => 'BEV-001',
            'price' => 15.99,
            'cost_price' => 10.50,
            'quantity' => 42,
            'unit' => 'Kg',
            'last_update' => '2023-06-15'
        ],
        [
            'id' => 2,
            'name' => 'Rice',
            'image' => 'https://pixabay.com/get/gb04569e09c01bfb0ebae3c532be17e8cc30eaf7b38453d420eb6de9584f2cbb46711464494a3627186ce667b3b6306f29daa4fef2d912ad3b0bbb9971b06c804_1280.jpg',
            'category' => 'Grains',
            'sku' => 'GRN-002',
            'price' => 20.50,
            'cost_price' => 15.25,
            'quantity' => 3,
            'unit' => 'Kg',
            'last_update' => '2023-07-01'
        ],
        [
            'id' => 3,
            'name' => 'Office Supplies',
            'image' => 'https://pixabay.com/get/g749487ae0b20caed3d262fbb56871849ea31330bf601af84951294c783333fe98701440317be2f573c72cfc7c36406eb24808ca9eafa4d9fc766150cac632df9_1280.jpg',
            'category' => 'Stationery',
            'sku' => 'STA-003',
            'price' => 45.75,
            'cost_price' => 30.00,
            'quantity' => 18,
            'unit' => 'Boxes',
            'last_update' => '2023-06-25'
        ],
        [
            'id' => 4,
            'name' => 'Bottled Water',
            'image' => 'https://pixabay.com/get/gc9c606b1fc417767214f17349bb6d0bcf7b001cbff6009195a7c7cd14b9fa40af17d8091b28dc92546102da73f98d698240d4005dc8e3cb0e213de57bdf24b78_1280.jpg',
            'category' => 'Beverages',
            'sku' => 'BEV-004',
            'price' => 1.99,
            'cost_price' => 0.75,
            'quantity' => 120,
            'unit' => 'Pieces',
            'last_update' => '2023-07-05'
        ],
        [
            'id' => 5,
            'name' => 'Tea',
            'image' => 'https://pixabay.com/get/gd2a39ed6159fd039d479bb37f28f7883af1d04b2f604d31b4c4d41c671e4310ac5a7e084fb65d2bad9981ec53430362f41f5698c013aeb0b221411a3ea2805f5_1280.jpg',
            'category' => 'Beverages',
            'sku' => 'BEV-005',
            'price' => 12.50,
            'cost_price' => 8.00,
            'quantity' => 25,
            'unit' => 'Boxes',
            'last_update' => '2023-06-30'
        ],
        [
            'id' => 6,
            'name' => 'Flour',
            'image' => 'https://pixabay.com/get/g72eac2b1e169db3a5291ad426754e832c2adf2f44aa27aaaae1c75d7f72a22fc687b65f9552dfa042c79366948d0efc26cb46dd1c22a60de6644cffa440fa70b_1280.jpg',
            'category' => 'Baking',
            'sku' => 'BAK-006',
            'price' => 8.75,
            'cost_price' => 5.50,
            'quantity' => 0,
            'unit' => 'Kg',
            'last_update' => '2023-07-02'
        ]
    ];
}

/**
 * Get categories
 * 
 * @return array List of categories
 */
function getCategories() {
    // In real application, fetch from database
    return [
        ['id' => 1, 'name' => 'Beverages'],
        ['id' => 2, 'name' => 'Grains'],
        ['id' => 3, 'name' => 'Stationery'],
        ['id' => 4, 'name' => 'Baking'],
        ['id' => 5, 'name' => 'Canned Goods'],
        ['id' => 6, 'name' => 'Cleaning Supplies'],
        ['id' => 7, 'name' => 'Dairy'],
        ['id' => 8, 'name' => 'Produce']
    ];
}

/**
 * Add new product
 * 
 * @param array $data Product data
 * @return array Success status and message
 */
function addProduct($data) {
    // In real application, insert into database
    // Just simulation in this version
    
    // Validate required fields
    $requiredFields = ['name', 'sku', 'category_id', 'price', 'quantity'];
    foreach ($requiredFields as $field) {
        if (!isset($data[$field]) || empty($data[$field])) {
            return ['success' => false, 'message' => "Field '{$field}' is required"];
        }
    }
    
    // Check if SKU exists (would query database in real app)
    $existingSKUs = ['BEV-001', 'GRN-002', 'STA-003', 'BEV-004', 'BEV-005', 'BAK-006'];
    if (in_array($data['sku'], $existingSKUs)) {
        return ['success' => false, 'message' => "Product with SKU '{$data['sku']}' already exists"];
    }
    
    // In real app, we would insert the product into database here
    
    return ['success' => true, 'message' => 'Product added successfully'];
}
?>
