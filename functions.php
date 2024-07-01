<?php
function pdo_connect_mysql() {
	// Update the details below with your MySQL details
	$DATABASE_HOST = '172.104.166.158';
	$DATABASE_USER = 'training_jeelp';
	$DATABASE_PASS = 'ms9PxuU3eGz5RbjP';
	$DATABASE_NAME = 'training_jeelp';
	try {
		return new PDO( 'mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS );
	} catch ( PDOException $exception ) {
		// If there is an error with the connection, stop the script and display the error.
		exit( 'Failed to connect to database!' );
	}
}

function template_header( $title ) {
	$num_items_in_cart = isset( $_SESSION['cart'] ) ? count( $_SESSION['cart'] ) : 0;
	$username          = isset( $_SESSION['username'] ) ? $_SESSION['username'] : ''; 
	echo <<<EOT

	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
			<title>$title</title>
			<link href="style.css" rel="stylesheet" type="text/css">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		</head>
		<body>
		<!-- Notification bar -->
	<div id="successNotification" class="notification"></div>

			<header>
				<div class="content-wrapper">
					<h1>JeelMart</h1>
					<button id="toggleNavButton" class="togglenavbutton">Toggle Navigation</button> <!-- Button to toggle navigation -->

					<nav id="mainNav">
						<a href="index.php">Home</a>
						<a href="index.php?page=products">Products</a>
						<a href="#" class="menubar__profile-list-text btn-open-popup" onclick="toggleregister()">Registration</a>
						<a href="#" class="menubar__profile-list-text btn-open-popup" onclick="togglelogin()">login</a>
						<a href="logout.php">logout</a>
						<a href="historycart.php">History</a>

						<a class="username">$username</a>
					</nav>
					<div class="link-icons">
						<a href="index.php?page=cart">
							<i class="fas fa-shopping-cart"></i>
							<span>$num_items_in_cart</span>
						</a>
					</div>
					
				</div>
			</header>
			

			<!-- registration form -->
				<div id="registrationOverlay" class="overlay-container" > 
					<div class="popup-box"> 
						<span class="popupbox--heading">
							<h2>Registration Form</h2> 
							<img src="./imgs/close_icon.svg" alt="close-icon" class="btn-close-popup" onclick="toggleregister()">
						</span>
			
						<div id="error-msg"></div>
						<form id="registrationForm" class="form-container" action="register.php" method="post" onsubmit="return validateregisterForm()">
							<label class="form-label" for="name"> Username: </label> 
							<input class="form-input" type="text" placeholder="Enter Your Username" id="username" name="username" maxlength="25">
			
							<label class="form-label" for="mobile">Mobile Number: </label> 
							<input class="form-input" type="tel" placeholder="Enter Your Username"	id="mobile" name="mobile" maxlength="10"> 
			
							<label class="form-label" for="email">Email:</label> 
							<input class="form-input" type="email" placeholder="Enter Your Email" id="email" name="email"> 
			
							<label class="form-label" for="password">Password:</label>
							<input class="form-input" type="password" id="password" placeholder="Enter Your Password" name="password" minlength="8" maxlength="16" >
			
							<label class="form-label" for="confirmPassword">Confirm Password:</label>
							<input class="form-input" type="password" id="confirmPassword" placeholder="Enter Your Confirm Password" name="confirmPassword" minlength="8" maxlength="16" >
			
							<button class="btn-submit container__registration-submitButton"	type="submit"> Submit </button> 
							<span class="login-request">Already registered? <a href="#" onclick="ToggleLoginRequset()">Login</a></span> <!-- Link to login form -->
						</form> 
					</div> 
				</div> 
				
				
				
			<!-- login form -->
				<div id="loginOverlay" class="overlay-container"> 
			
					<div class="popup-box"> 
						<h2>Login Form</h2> 
						<div id="loginErrorMsg" class="loginErrorMsg"></div> <!-- Move the error message container here -->

						<img src="./imgs/close_icon.svg" alt="close-icon" class="btn-close-popup" onclick="togglelogin()">
						
						<form id="loginForm" class="form-container" action="login_process.php" method="post" onsubmit="return validateLoginForm()">
							<label class="form-label" for="lusername"> Username: </label> 
							<input class="form-input" type="text" placeholder="Enter Your Username" id="lusername" name="lusername" maxlength="25">
			
							<label class="form-label" for="lpassword">Password:</label>
							<input class="form-input" type="password" id="lpassword" placeholder="Enter Your Password" name="lpassword" minlength="8" maxlength="16" >
			
							<button class="btn-submit container__login-submitButton" type="submit"> Submit </button> 

							<span class="login-request">Not registered? <a href="#" onclick="ToggleRegistrationRequset()">Registration</a></span> <!-- Link to login form -->

						</form> 
					</div> 
				</div> 
			<main>
	EOT;
}
// Template footer
function template_footer() {
	$year = date( 'Y' );
	echo <<<EOT
        </main>
        <footer>
    <div class="footer_wrapper">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis felis eu arcu lacinia ultrices eget nec enim.</p>
            </div>
            <div class="footer-section">
                <h3>Useful Links</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Shop</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p>123 Main Street<br>City, State 12345<br>Email: jeel10@gmail.com<br>Phone: 123-456-7890</p>
            </div>
			<div class="footer-section">
                <h3>Social media links</h3>
				<ul>
					<li><a href="#">linkedIn</a></li>
					<li><a href="#">Instagram</a></li>
					<li><a href="#">Facebook</a></li>
					<li><a href="#">GitHub</a></li>
				</ul>
			</div>
        </div>
        <p class="copyright">&copy; 2024, JeelMart Website</p>
    </div>
</footer>


		<script src="./script.js"></script>
    </body>
</html>
EOT;
}