<?php
// Start the session
session_start();
?>

<?php
// Establish a connection to the database
$servername = '172.104.166.158';
$usernameDB = 'training_jeelp';
$passwordDB = 'ms9PxuU3eGz5RbjP';
$database   = 'training_jeelp';

// Create connection
$conn = new mysqli( $servername, $usernameDB, $passwordDB, $database );

// Check connection
if ( $conn->connect_error ) {
	die( 'Connection failed: ' . $conn->connect_error );
}

// SQL query to fetch all users
$sql    = 'SELECT * FROM orderplace';
$result = $conn->query( $sql );

?>


<?php require 'admin_functions.php'; ?>


<?php echo template_header( 'admin_manage_orders' ); ?>

<main class="manageOrder_container">
	<h1 class="manageOrder_container-heading">Users Order Data</h1>
	<table>
		<tr>
			<th>ID</th>
			<th>User_id</th>
			<th>Username</th>
			<th>Email</th>
			<th>Product_id</th>
			<th>Product_name</th>
			<th>Product_img</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Total</th>
			<th>Order_at</th>
			<!-- Add more columns as needed -->
		</tr>
		<?php
		if ( $result->num_rows > 0 ) {
			while ( $row = $result->fetch_assoc() ) {
				echo '<tr>';
				echo '<td>' . $row['id'] . '</td>';
				echo '<td>' . $row['user_id'] . '</td>';
				echo '<td>' . $row['username'] . '</td>';
				echo '<td>' . $row['email'] . '</td>';
				echo '<td>' . $row['product_id'] . '</td>';
				echo '<td>' . $row['product_name'] . '</td>';
				echo '<td>' . $row['product_img'] . '</td>';
				echo '<td>' . $row['quantity'] . '</td>';
				echo '<td>' . $row['price'] . '</td>';
				echo '<td>' . $row['total'] . '</td>';
				echo '<td>' . $row['created_at'] . '</td>';
				// Add more columns as needed
				echo '</tr>';
			}
		} else {
			echo "<tr><td colspan='5'>0 results</td></tr>";
		}
		$conn->close();
		?>
	</table>

</main>



<?php echo template_footer(); ?>
