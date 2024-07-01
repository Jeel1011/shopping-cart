<?php
// Start the session.
session_start();
?>

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

// Check if the delete button is clicked
if (isset($_POST['delete_user'])) {
    $user_id = $_POST['delete_user'];
    // SQL query to delete the user
    $sql_delete = "DELETE FROM users WHERE id = $user_id";
    if ($conn->query($sql_delete) === TRUE) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}

// SQL query to fetch all users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

?>

<?php include 'admin_functions.php'; ?>

<?php echo template_header('admin_manage_users'); ?>

<main class="manageUser_container">
    <h1 class="manageUser_container-heading">User Data</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Registration Date</th>
            <th>Action</th>
            <!-- Add more columns as needed -->
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["mobile"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["registration_date"] . "</td>";
                // Add more columns as needed
                echo "<td>
                        <form method='post'>
                            <button type='submit' class='delete_user' name='delete_user' value='" . $row["id"] . "'>Delete</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>0 results</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</main>

<?php echo template_footer(); ?>
