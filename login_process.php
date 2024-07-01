<?php
session_start(); // Start session

// Check if the user is already logged in
if ( isset( $_SESSION['username'] ) ) {
	// If user is already logged in, set error message and redirect back to login page
	$error_message = 'You are already logged in. Please logout first to log in with a different account.';
	header( 'Location: index.php?error=' . urlencode( $error_message ) );
	exit();
}

// Database configuration
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

// Retrieve form data and sanitize inputs
$username = mysqli_real_escape_string( $conn, $_POST['lusername'] );
$password = mysqli_real_escape_string( $conn, $_POST['lpassword'] );

// Query to check if the username exists in adminuser table
$sql    = "SELECT * FROM adminuser WHERE username = '$username'";
$result = $conn->query( $sql );

if ( $result->num_rows == 1 ) {
    // Username exists in adminuser table, fetch the user's data
    $user = $result->fetch_assoc();
    // Verify password
    if ( $password === $user['password'] ) {
        // Password is correct, set session and redirect to admin panel
        $_SESSION['username'] = $username;
        header( 'Location: admin.php' ); // Redirect to admin panel page
        exit();
    } else {
        // Password is incorrect
        $error_message = 'Password is incorrect.';
        header( 'Location: index.php?error=' . urlencode( $error_message ) );
        exit();
    }
} else {
	// Username not found in adminuser table, check in users table
	$sql    = "SELECT * FROM users WHERE username = '$username'";
	$result = $conn->query( $sql );

	if ( $result->num_rows == 1 ) {
		// Username exists in users table, fetch the user's data
		$user = $result->fetch_assoc();
		// Verify password
		if ( password_verify( $password, $user['password'] ) ) {
			// Password is correct, set session and redirect to dashboard
			$_SESSION['username'] = $username;
			header( 'Location: index.php' ); // Redirect to index page or any other desired page
			exit();
		} else {
			// Password is incorrect
			$error_message = 'Password is incorrect.';
			header( 'Location: index.php?error=' . urlencode( $error_message ) );
			exit();
		}
	} else {
		// User not found in both adminuser and users table
		$error_message = 'User not found.';
		header( 'Location: index.php?error=' . urlencode( $error_message ) );
		exit();
	}
}

$conn->close();
