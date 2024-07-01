<?php
// Start session
session_start();


// Check if the user is logged in
if (!isset($_SESSION['username']))  {
    // Redirect the user to the login page
    header("Location: index.php");
    exit;
}


// Database connection parameters
$servername = '172.104.166.158';
$usernameDB = 'training_jeelp';
$passwordDB = 'ms9PxuU3eGz5RbjP';
$database   = 'training_jeelp';

// Create connection
$pdo = new PDO("mysql:host=$servername;dbname=$database", $usernameDB, $passwordDB);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check if the Place Order button is clicked
if (isset($_POST['confirmplaceorder'])) {
    // Retrieve username from session
    $username = $_SESSION['username'];
    
    // Retrieve user ID from the users table
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Check if user exists
    if ($user) {
        $userID = $user['id'];
        
        // Retrieve email from the users table using the user ID
        $stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
        $stmt->execute([$userID]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        $email = $userData['email'];
        
        // Retrieve cart data
        $cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

        // Loop through cart items and insert into orderplace table
        foreach ($cartItems as $productID => $quantity) {
            // Fetch product details from the database
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([$productID]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($product) {
                // Calculate total price
                $total = $quantity * $product['price'];

                // Insert cart item into orderplace table
                $stmt = $pdo->prepare("INSERT INTO orderplace (user_id, username, email, product_id, product_name, product_img, quantity, price, total, created_at) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
                $stmt->execute([$userID, $username, $email, $productID, $product['name'], $product['img'], $quantity, $product['price'], $total]);
            }
        }

        // Redirect the user to a confirmation page or any other page
        header("Location: placeorder.php");
        exit;
    } else {
        // User not found in the database, handle error
        echo "Error: User not found";
        exit;
    }
}
