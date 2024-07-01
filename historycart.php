<?php
// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if ( isset( $_GET['remove'] ) && is_numeric( $_GET['remove'] ) && isset( $_SESSION['cart'] ) && isset( $_SESSION['cart'][ $_GET['remove'] ] ) ) {
//Remove the product from the shopping cart
unset( $_SESSION['cart'][ $_GET['remove'] ] );
}

// Check the session variable for products in cart
$products_in_cart = isset( $_SESSION['cart'] ) ? $_SESSION['cart'] : array();
$products         = array();
$subtotal         = 0.00;
// If there are products in cart
if ( $products_in_cart ) {
	$array_to_question_marks = implode( ',', array_fill( 0, count( $products_in_cart ), '?' ) );
	$stmt                    = $pdo->prepare( 'SELECT * FROM orderplace WHERE id IN (' . $array_to_question_marks . ')' );

	$stmt->execute( array_keys( $products_in_cart ) );
	// Fetch the products from the database and return the result as an Array
	$products = $stmt->fetchAll( PDO::FETCH_ASSOC );
	// Calculate the subtotal
	foreach ( $products as $product ) {
		$subtotal += (float) $product['price'] * (int) $products_in_cart[ $product['id'] ];
	}
}
?>


<?php
session_start();

// Check if the user is logged in
if ( ! isset( $_SESSION['username'] ) ) {
	header( 'Location: index.php' );
	exit;
}

// Database connection parameters
$servername = '172.104.166.158';
$usernameDB = 'training_jeelp';
$passwordDB = 'ms9PxuU3eGz5RbjP';
$database   = 'training_jeelp';

// Create PDO connection
$pdo = new PDO( "mysql:host=$servername;dbname=$database", $usernameDB, $passwordDB );
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

// Fetch cart items for the logged-in user
$stmt = $pdo->prepare( 'SELECT * FROM orderplace WHERE username = ?' );
$stmt->execute( array( $_SESSION['username'] ) );
$cartItems = $stmt->fetchAll( PDO::FETCH_ASSOC );

// Calculate subtotal
$subtotal = 0.00;
foreach ( $cartItems as $item ) {
	$subtotal += (float) $item['total'];
}
?>


<?php
// Include the file containing the function definitions
require 'functions.php';
?>

<?php echo template_header( 'Cart' ); ?>

<div class="cart content-wrapper">
	<h1>Order History</h1>
	<form action="place_order.php" method="post">
		<table>
			<thead>
				<tr>
					<td colspan="2">Product</td>
					<td>Price</td>
					<td>Quantity</td>
					<td>Total</td>
				</tr>
			</thead>
			<tbody>
				<?php if ( empty( $cartItems ) ) : ?>
				<tr>
					<td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
				</tr>
				<?php else : ?>
					<?php foreach ( $cartItems as $item ) : ?>
				<tr>
					<td class="img">
						<img src="imgs/<?php echo $item['product_img']; ?>" width="50" height="50" alt="<?php echo $item['product_name']; ?>">
					</td>
					<td>
						<?php echo $item['product_name']; ?>
						<br>
						<a href="index.php?page=cart&remove=<?php echo $item['id']; ?>" class="remove">Remove</a>
					</td>
					<td class="price">&dollar;<?php echo $item['price']; ?></td>
					<td class="quantity">
						<?php echo $item['quantity']; ?>
					</td>
					<td class="price">&dollar;<?php echo $item['total']; ?></td>
				</tr>
				<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
		<div class="subtotal">
			<span class="text">Subtotal</span>
			<span class="price">&dollar;<?php echo $subtotal; ?></span>
		</div>

	</form>
</div>

<?php echo template_footer(); ?>
