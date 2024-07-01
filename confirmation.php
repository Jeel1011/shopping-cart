<?php

// Check if the user is logged in
if ( ! isset( $_SESSION['username'] ) ) {
	// Redirect the user to the login page if not logged in
	header( 'Location: index.php' );
	exit();
}

// Fetch user details from the database
$username = $_SESSION['username'];
$stmt     = $pdo->prepare( 'SELECT * FROM users WHERE username = ?' );
$stmt->execute( array( $username ) );
$user = $stmt->fetch( PDO::FETCH_ASSOC );

// Fetch cart details from session
$cart = isset( $_SESSION['cart'] ) ? $_SESSION['cart'] : array();

?>

<?php echo template_header( 'Confirmation' ); ?>

<div class="confirmation content-wrapper">
	<h1>Order Confirmation</h1>
	<h2>User Details</h2>
	<p><strong>Username:</strong> <?php echo $user['username']; ?></p>
	<p><strong>Email:</strong> <?php echo $user['email']; ?></p>
	<p><strong>Date:</strong> <?php echo date( 'Y-m-d' ); ?></p>
	<h2>Product Details</h2>
	<table>
		<thead>
			<tr>
                <td>Product</td>
				<td>Name</td>
				<td>Price</td>
				<td>Quantity</td>
				<td>Total</td>
			</tr>
		</thead>
		<tbody>
		    <?php foreach ($cart as $productID => $quantity) : ?>
                <?php
                // Retrieve product details from the database based on the product ID
                $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
                $stmt->execute([$productID]);
                $product_details = $stmt->fetch(PDO::FETCH_ASSOC);
                // Check if product details are fetched successfully
                if ($product_details) :
                    ?>
                    <tr>
                        <td>
                            <img src="imgs/<?php echo $product_details['img']; ?>" alt="<?php echo $product_details['name']; ?>" width="100">
                        </td>
                        <td><?php echo $product_details['name']; ?></td>
                        <td>$<?php echo $product_details['price']; ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td>$<?php echo $product_details['price'] * $quantity; ?></td>
                    </tr>

					<?php endif; ?>
				<?php endforeach; ?>

		</tbody>
	</table>
	<form action="place_order.php" method="post">
		<input type="submit" value="Proceed to Payment" class="confirmationbutton" name="confirmplaceorder">
	</form>
</div>

<?php echo template_footer(); ?>
