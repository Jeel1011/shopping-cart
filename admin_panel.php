<?php echo template_header( 'admin_panel' ); ?>


<main class="adminContainer">
	<h1>Admin Pannel</h1>
	<section class="adminContainer_details">
		<div class="admincontainer_signupBox">
			<h3>SignUp</h3>
			<p>
			<?php
                // Establish a connection to the database


				$servername = '172.104.166.158';
                $usernameDB = 'training_jeelp';
                $passwordDB = 'ms9PxuU3eGz5RbjP';
                $database   = 'training_jeelp';

                // Create connection
                $conn = new mysqli($servername, $usernameDB, $passwordDB, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // SQL query to get the total product count
                $sql = "SELECT COUNT(*) as total_users FROM users";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        // Display the total product count within the <p> tag
                        echo $row["total_users"];
                    }
                } else {
                    echo "0";
                }
                $conn->close();
                ?>
			</p>
			<a href="admin_manage_users.php" class="manageuser_button">View SignUps</a>
			<!-- <button type="submit" class="manageuser_button" name="Manage Users" value="View Signups"> View SignUps</button> -->
		</div>
		<div class="admincontainer_signupBox">
			<h3>Products</h3>
			<p>
                <?php
                // Establish a connection to the database
				// Establish a connection to the database
				$servername = '172.104.166.158';
                $usernameDB = 'training_jeelp';
                $passwordDB = 'ms9PxuU3eGz5RbjP';
                $database   = 'training_jeelp';

                // Create connection
                $conn = new mysqli($servername, $usernameDB, $passwordDB, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // SQL query to get the total product count
                $sql = "SELECT COUNT(*) as total_products FROM products";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        // Display the total product count within the <p> tag
                        echo $row["total_products"];
                    }
                } else {
                    echo "0";
                }
                $conn->close();
                ?>
            </p>
			<a href="admin_manage_products.php" class="manageuser_button">View Products</a>

			<!-- <button type="submit" class="manageuser_button" name="Manage Products" value="View Products">View Products</button> -->
		</div>
		<div class="admincontainer_signupBox">
			<h3>Orders</h3>
			<p>
			<?php
               // Establish a connection to the database
				$servername = '172.104.166.158';
                $usernameDB = 'training_jeelp';
                $passwordDB = 'ms9PxuU3eGz5RbjP';
                $database   = 'training_jeelp';

                // Create connection
                $conn = new mysqli($servername, $usernameDB, $passwordDB, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // SQL query to get the total product count
                $sql = "SELECT COUNT(*) as total_orders FROM orderplace";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        // Display the total product count within the <p> tag
                        echo $row["total_orders"];
                    }
                } else {
                    echo "0";
                }
                $conn->close();
                ?>
			</p>
            <a href="admin_manage_orders.php" class="manageuser_button">View Orders</a>

			<!-- <button type="submit" class="manageuser_button" name="Manage Order" value="View Order">View Order</button> -->
		</div>
	</section>
</main>

<?php echo template_footer(); ?>
