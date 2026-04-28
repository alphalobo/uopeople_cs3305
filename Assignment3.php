<?php

// Question 1 Start
function calculateTotal($price, $quantity) {
    return ($price * $quantity)* 1.10; // Adding 10% tax
}

function formatProductName($name) {
    $result = trim($name); // Remove leading and trailing whitespace
    $result = substr($result, 0, 50); // Limit to 50 characters
    $result = ucwords(strtolower($name)); // Capitalize only the first letter of each word
    return $result;
}

function calculateDiscount($price, $discountPercent) {
    return $price * (1 - $discountPercent / 100);
}

// Question 1 End

// Question 2 Start
// array of products with categories
$productSource1 = [
    ["name" => "Dell 24 inch Monitor", "price" => 199.99, "category" => "Electronics"],
    ["name" => "Dell 24 inch Monitor", "price" => 199.99, "category" => "Electronics"], // intentional duplicate for testing
    ["name" => "Apple MacBook Pro", "price" => 1299.99, "category" => "Computers"],
    ["name" => "Samsung Galaxy S25", "price" => 799.99, "category" => "Mobile Phones"],
    ["name" => "Sony WH-1000XM4 Headphones", "price" => 349.99, "category" => "Audio"],
    ["name" => "Amazon Echo Dot", "price" => 49.99, "category" => "Smart Home"],
];

$productSource2 = [
    ["name" => "Apple iPhone 15", "price" => 999.99, "category" => "Mobile Phones"],
    ["name" => "Google Pixel 6", "price" => 599.99, "category" => "Mobile Phones"],
    ["name" => "Bose QuietComfort 35 II", "price" => 299.99, "category" => "Audio"],
    ["name" => "HP Spectre x360", "price" => 1099.99, "category" => "Computers"],
    ["name" => "Amazon Echo Dot", "price" => 49.99, "category" => "Smart Home"], // intentional duplicate for testing
    ["name" => "Dell 24 inch Monitor", "price" => 199.99, "category" => "Electronics"], // intentional duplicate for testing
];

function removeDuplicateProducts($products) {
    $uniqueProducts = []; // Initialize an empty array to store unique products
    foreach ($products as $product) { // Loop through each product in the input array
        if (!in_array($product, $uniqueProducts)) { // Check if the product is not already in the unique array
            $uniqueProducts[] = $product; // Add the product to the unique array if it's not a duplicate
        }
    }
    return $uniqueProducts; // Return the array with duplicates removed
}

function sortProductByPriceAscending($products) {
    return sort($products); // Return the sorted array of products
}

function applyDiscountToCategory($products, $category, $discountPercent) {
    foreach ($products as &$product) { // Loop through each product by reference to modify it directly
        if ($product['category'] === $category) { // Check if the product's category matches the specified category
            $product['price'] = calculateDiscount($product['price'], $discountPercent); // Apply the discount to the product's price
        }
    }
    return $products; // Return the modified array of products
}

// Merge the two product sources
$mergedProducts = array_merge($productSource1, $productSource2);

// Remove duplicates
$uniqueProducts = removeDuplicateProducts($mergedProducts);

// Print the combined inventory
echo "Combined Inventory:\n";
foreach ($uniqueProducts as $product) {
    echo "Name: " . $product['name'] . ", Price: $" . $product['price'] . ", Category: " . $product['category'] . "\n";
}

// end of question 2

?>