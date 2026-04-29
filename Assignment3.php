<?php

echo "<pre>";
// Question 1 Start
echo "QUESTION 1\n";

function calculateTotal($price, $quantity) {
    return ($price * $quantity)* 1.10; // Adding 10% tax
}

function formatProductName($name) {
    $result = trim($name); // Remove leading and trailing whitespace
    $result = substr($result, 0, 50); // Limit to 50 characters
    $result = ucwords(strtolower($result)); // Capitalize only the first letter of each word
    return $result;
}

function calculateDiscount($price, $discountPercent) {
    return $price * (1 - $discountPercent / 100);
}

echo "Total with tax (100 x 2): " . calculateTotal(100, 2) . "\n";
echo "Formatted product name: " . formatProductName("   apple macbook pro 16 inch   ") . "\n";
echo "Discounted price (R200 at 10%): " . calculateDiscount(200, 10) . "\n";

// Question 1 End

// Question 2 Start
echo "\nQUESTION 2:\n";

// array of products with categories
$productSource1 = [
    ["name" => "Dell 24 inch Monitor", "price" => 199.99, "category" => "Electronics", "description" => "24-inch FHD display with IPS panel"],
    ["name" => "Dell 24 inch Monitor", "price" => 199.99, "category" => "Electronics", "description" => "24-inch FHD display with IPS panel"], // intentional duplicate for testing
    ["name" => "Apple MacBook Pro", "price" => 1299.99, "category" => "Computers", "description" => "High-performance laptop with M-series chip"],
    ["name" => "Samsung Galaxy S25", "price" => 799.99, "category" => "Mobile Phones", "description" => "Latest flagship Android smartphone"],
    ["name" => "Sony WH-1000XM4 Headphones", "price" => 349.99, "category" => "Audio", "description" => "Premium noise-cancelling wireless headphones"],
    ["name" => "Amazon Echo Dot", "price" => 49.99, "category" => "Smart Home", "description" => "Compact smart speaker with Alexa"],
];

$productSource2 = [
    ["name" => "Apple iPhone 15", "price" => 999.99, "category" => "Mobile Phones", "description" => "Latest iPhone with advanced camera system"],
    ["name" => "Google Pixel 6", "price" => 599.99, "category" => "Mobile Phones", "description" => "Google's flagship phone with Tensor chip"],
    ["name" => "Bose QuietComfort 35 II", "price" => 299.99, "category" => "Audio", "description" => "Comfortable noise-cancelling headphones"],
    ["name" => "HP Spectre x360", "price" => 1099.99, "category" => "Computers", "description" => "Convertible 2-in-1 laptop with touchscreen"],
    ["name" => "Amazon Echo Dot", "price" => 49.99, "category" => "Smart Home", "description" => "Compact smart speaker with Alexa"], // intentional duplicate from productSource1 for testing
    ["name" => "Dell 24 inch Monitor", "price" => 199.99, "category" => "Electronics", "description" => "24-inch FHD display with IPS panel"], // intentional duplicate from productSource1 for testing
];

// Function to remove duplicate products based on their name, price, and category
function removeDuplicateProducts($products) {
    $uniqueProducts = []; // Initialize an empty array to store unique products
    foreach ($products as $product) { // Loop through each product in the input array
        if (!in_array($product, $uniqueProducts)) { // Check if the product is not already in the unique array
            $uniqueProducts[] = $product; // Add the product to the unique array if it's not a duplicate
        }
    }
    return $uniqueProducts; // Return the array with duplicates removed
}

// Function to sort products by price in ascending order
function sortProductByPriceAscending($products) {
    usort($products, function($a, $b) {
        return $a['price'] <=> $b['price'];
    });
    return $products;
}

// Function to filter products by category
function applyDiscountToCategory($products, $category, $discountPercent) {
    foreach ($products as &$product) { // Loop through each product by reference to modify it directly
        if ($product['category'] === $category) { // Check if the product's category matches the specified category
            $product['price'] = calculateDiscount($product['price'], $discountPercent); // Apply the discount to the product's price
        }
    }
    return $products; // Return the modified array of products
}

// Function to merge two product arrays
function mergeProductArrays($array1, $array2) {
    return array_merge($array1, $array2); // Merge the two product arrays into one
}

// Merge the two product sources
$mergedProducts = mergeProductArrays($productSource1, $productSource2);

// sort products by price in ascending order
$sortedProducts = sortProductByPriceAscending($mergedProducts);

// Remove duplicates
$uniqueProducts = removeDuplicateProducts($sortedProducts);

// Print the combined inventory
echo "Combined Inventory:\n";
foreach ($uniqueProducts as $product) {
    //echo "Name: " . $product['name'] . ", Price: $" . $product['price'] . ", Category: " . $product['category'] . "\n";

    printf("Name: %-30s Price: $%-10.2f Category: %s\n",
    $product['name'],
    $product['price'],
    $product['category']
);
}

$discountedProducts = applyDiscountToCategory($uniqueProducts, "Electronics", 10);

foreach ($discountedProducts as $product) {
    printf("Name: %-30s Price: $%-10.2f Category: %s\n",
        $product['name'],
        $product['price'],
        $product['category']
    );
}

// end of question 2

// start of question 3

echo "\nQUESTION 3:\n";

// Format product description function
function formatProductDescription($description){
    $result = strtolower($description); // Convert the description to lowercase for consistency
    $result = str_replace('_', ' ', $result); // Replace underscores with spaces to improve readability 
    return $result; // return the formatted description
}

function sanitizeProductName($name) {
    return preg_replace('/[^a-zA-Z0-9\s]/', '', $name); // Remove any characters that are not letters, numbers, spaces, or hyphens using regex
}

// Analyze the product description function
function analyzeDescription($description) {
    $charCount = strlen($description); // Calculate and print the total number of characters
    echo "Total characters: $charCount\n"; // Print the total number of characters in the description
    
    $wordCount = str_word_count($description); // Count and print the total number of words
    echo "Total words: $wordCount\n"; // Print the total number of words in the description
    
    // Check if the word "leather" appears in the description
    if (stripos(strtolower($description), 'leather') !== false) {
        echo "Keyword found\n"; // Print "Keyword found" if the word "leather" is present in the description
    } else {
        echo "Keyword not found\n"; // Print "Keyword not found" if the word "leather" is not present in the description
    }
}

// Format customer review function
function formatReview($review){
    $preview = (strlen($review) > 20) ? substr($review, 0, 20) . "..." : $review; // Extract and print the first 20 characters followed by "..."
    echo $preview . "\n"; //  Print the preview of the review

    $position = stripos($review, 'excellent'); // Search for the word "excellent" and print its starting position
    if ($position !== false) {
        echo "Starting position of 'excellent': $position\n"; // Print the starting position of the word "excellent" if it is found in the review
    } else {
        echo "'excellent' not found\n"; // Print "'excellent' not found" if the word "excellent" is not present in the review
    }

    $updatedReview = $review . " Thank you for your feedback!"; // Concatenate the review with the message and print the full updated review
    echo $updatedReview . "\n"; // Print the full updated review with the thank you message
}

// Format description
$rawDescription = "HIGH_QUALITY_LEATHER_wallet!!";
echo "\nFormatted Description:\n";
echo formatProductDescription($rawDescription) . "\n";

// Analyze description
echo "\nDescription Analysis:\n";
$analysisText = "This is a high-quality leather wallet with RFID protection.";
analyzeDescription($analysisText);

// Format customer review
echo "\nCustomer Review Processing:\n";
$review = "Great product! Fast delivery and excellent service.";
formatReview($review);

// end of question 3
?>