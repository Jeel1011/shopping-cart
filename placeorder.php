<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']))  {
    // Redirect the user to the login page or display an error message
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
if (isset($_POST['placeorder'])) {
    // Retrieve user ID, username, and email from session
    $userID = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

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
}
?>

<?php
// Include the file containing the function definitions
include 'functions.php';
?>

<?=template_header('Place Order')?>

<div class="placeorder content-wrapper">
    <h1>Your Order Has Been Placed</h1>
    <p>Thank you for ordering with us! We'll contact you by email with your order details.</p>
</div>

<?=template_footer()?>
