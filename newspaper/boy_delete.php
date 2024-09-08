<?php
// Check if user ID is set and not empty
if (isset($_POST['id']) && !empty($_POST['id'])) {
    // Connect to the database
    $con = mysqli_connect("localhost", "root", "", "newspaper");

    // Check the connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare the SQL statement to delete the user
    $id = $_POST['id'];
    $sql = "DELETE FROM paperboy WHERE id = $id";

    // Execute the SQL statement
    if (mysqli_query($con, $sql)) {
        // If deletion is successful, redirect back to the user profile page
        header("Location: boy_profile.php");
        exit();
    } else {
        // If an error occurs, display an error message
        echo "Error deleting user: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
} else {
    // If user ID is not set or empty, redirect back to the user profile page
    header("Location: boy_profile.php");
    exit();
}
?>
