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
    ["name" => "Fancy Monitor", "price" => 199.99, "category" => "Electronics", "description" => "24-inch FHD display with IPS panel"],
    ["name" => "Fancy Monitor", "price" => 199.99, "category" => "Electronics", "description" => "24-inch FHD display with IPS panel"], // intentional duplicate for testing
    ["name" => "High-End Laptop", "price" => 1299.99, "category" => "Computers", "description" => "High-performance laptop with powerful processor"],
    ["name" => "Flagship Smartphone", "price" => 799.99, "category" => "Mobile Phones", "description" => "Latest flagship smartphone with premium camera"],
    ["name" => "Noise-Cancelling Headphones", "price" => 349.99, "category" => "Audio", "description" => "Premium noise-cancelling wireless headphones"],
    ["name" => "Smart Home Speaker", "price" => 49.99, "category" => "Smart Home", "description" => "Compact smart speaker with voice assistant"],
];

$productSource2 = [
    ["name" => "Premium Tablet", "price" => 999.99, "category" => "Mobile Phones", "description" => "High-end tablet with advanced display"],
    ["name" => "Budget Smartphone", "price" => 599.99, "category" => "Mobile Phones", "description" => "Affordable smartphone with great features"],
    ["name" => "Comfort Headphones", "price" => 299.99, "category" => "Audio", "description" => "Comfortable noise-cancelling headphones"],
    ["name" => "Convertible Laptop", "price" => 1099.99, "category" => "Computers", "description" => "Convertible 2-in-1 laptop with touchscreen"],
    ["name" => "Smart Home Speaker", "price" => 49.99, "category" => "Smart Home", "description" => "Compact smart speaker with voice assistant"], // intentional duplicate from productSource1 for testing
    ["name" => "Fancy Monitor", "price" => 199.99, "category" => "Electronics", "description" => "24-inch FHD display with IPS panel"], // intentional duplicate from productSource1 for testing
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
            $product['name'] = $product['name'] . "*"; // Append an asterisk to the product's name to indicate that a discount has been applied
            $product['description'] = "DISCOUNTED*: " . $product['description'] . " (discounted from $" . $product['price'] . ")"; // Prepend "DISCOUNTED*: " to the product's description to indicate that a discount has been applied
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
// Loop over and print each product's name, price, category, and description in a formatted manner
foreach ($uniqueProducts as $product) {
    printf("Name: %-30s Price: $%-10.2f Category: %-20s Description: %s\n",
    $product['name'],
    $product['price'],
    $product['category'],
    $product['description']
);
}

echo "\nCombined Inventory After Electronics Discount:\n";
$discountedProducts = applyDiscountToCategory($uniqueProducts, "Electronics", 10); // Apply a 10% discount to all products in the "Electronics" category and print the updated inventory
// Loop over and print each product's name, price, category, and description in a formatted manner after applying the discount
foreach ($discountedProducts as $product) {
    printf("Name: %-30s Price: $%-10.2f Category: %-20s Description: %s\n",
    $product['name'],
    $product['price'],
    $product['category'],
    $product['description']
    );
}

// end of question 2

// start of question 3

echo "\nQUESTION 3:";

// Format product description function
function formatProductDescription($description){
    $result = strtolower($description); // Convert the description to lowercase for consistency
    $result = str_replace('_', ' ', $result); // Replace underscores with spaces to improve readability 
    $result = ucfirst($result); // Capitalize only the first word's first letter
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
    
    // Check if the word "monitor" appears (instead of "leather" given the items I have) in the description
    if (stripos(strtolower($description), 'monitor') !== false) {
        echo "Keyword found\n"; // Print "Keyword found" if the word "monitor" is present in the description
    } else {
        echo "Keyword not found\n"; // Print "Keyword not found" if the word "monitor" is not present in the description
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
$rawDescription = "HIGH_QUALITY_MONITOR_FOR_OFFICE_USE!!"; // Example raw description with uppercase letters, underscores, and special characters
echo "\nFormatted Description:\n"; // Format the raw description and print the formatted version
echo formatProductDescription($rawDescription) . "\n"; // Print the formatted product description

// Analyze description
echo "\nDescription Analysis:\n"; // Analyze a sample product description and print the results of the analysis
$analysisText = "This is a high-quality monitor with deep contrast and brightness.";// Example product description to analyze
analyzeDescription($analysisText); // Print the analysis of the product description

// Format customer review
echo "\nCustomer Review Processing:\n"; // Format a sample customer review and print the results of the formatting
$review = "Great product! Fast delivery and excellent service."; // Example customer review to format
formatReview($review); // Print the formatted customer review with the preview, position of "excellent", and the full updated review

// end of question 3
?>