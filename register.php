<?php
// Database connection
$servername = '172.104.166.158';
$usernameDB = 'training_jeelp';
$passwordDB = 'ms9PxuU3eGz5RbjP';
$database   = 'training_jeelp';

$conn = new mysqli( $servername, $usernameDB, $passwordDB, $database );
if ( $conn->connect_error ) {
	die( 'Connection failed: ' . $conn->connect_error );
}

// Function to validate input
function test_input( $data ) {
	$data = trim( $data );
	$data = stripslashes( $data );
	$data = htmlspecialchars( $data );
	return $data;
}

// Validate and sanitize inputs
$username        = test_input( $_POST['username'] );
$mobile          = test_input( $_POST['mobile'] );
$email           = test_input( $_POST['email'] );
$password        = test_input( $_POST['password'] );
$confirmPassword = test_input( $_POST['confirmPassword'] );

// Error message container
$errorMsg = '';

// Validate inputs
if ( empty( $username ) || empty( $mobile ) || empty( $email ) || empty( $password ) || empty( $confirmPassword ) ) {
	$errorMsg = 'All input fields are required.';
} else {
	// Validate username
	if ( ! preg_match( '/^[a-zA-Z0-9]{1,25}$/', $username ) ) {
		$errorMsg = 'Username should contain only letters and numbers.';
	}
	// Validate mobile number
	elseif ( ! preg_match( '/^[0-9]{10}$/', $mobile ) ) {
		$errorMsg = 'Mobile Number should contain only digits.';
	}
	// Validate email
	elseif ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
		$errorMsg = 'Please enter a valid email address.';
	}
	// Validate password
	elseif ( ! preg_match( '/^(?=.*[a-z])(?=.*[A-Z]).{8,16}$/', $password ) ) {
		$errorMsg = 'Password should contain at least one uppercase letter.';
	}
	// Check if password and confirm password match
	elseif ( $password !== $confirmPassword ) {
		$errorMsg = 'Password and Confirm Password must match.';
	} else {
		// Password encryption
		$hashedPassword        = password_hash( $password, PASSWORD_DEFAULT );
		$hashedconfirmPassword = password_hash( $confirmPassword, PASSWORD_DEFAULT );

		// Insert into database
		$sql = "INSERT INTO users (username, mobile, email, password, confirmPassword, registration_date)
                VALUES ('$username', '$mobile', '$email', '$hashedPassword', '$hashedconfirmPassword', NOW())";

		if ( $conn->query( $sql ) === true ) {
			header( 'Location: ./index.php?message=success' );
			exit;
		} else {
			$errorMsg = 'Error: ' . $sql . '<br>' . $conn->error;
		}
	}
}

// Display error message if validation fails
if ( ! empty( $errorMsg ) ) {
	echo $errorMsg;
}

$conn->close();

