<?php
session_start();
session_destroy();
header("Location: index.php");
exit();
?>
<?php
// Start or resume a session
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Unset specific cookies (if needed)
setcookie("cookie_name1", "", time() - 3600, "/");
setcookie("cookie_name2", "", time() - 3600, "/");

// Redirect the user to a login page or another appropriate page
header("Location: index.php");
exit();
?>