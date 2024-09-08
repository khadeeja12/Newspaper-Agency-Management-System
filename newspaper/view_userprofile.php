<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* background-image: url('1.jpg');
            background-repeat: no-repeat;
            background-size: auto 150vh; */
        }

        .profile-card {
            background-color: #fff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
            text-align: center;
        }

        .profile-icon {
            font-size: 72px;
            color: #3498db;
            margin-bottom: 20px;
        }

        .profile-name {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .profile-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 10px 20px;
            border-radius: 10px;
            background-color: #f2f2f2;
            transition: background-color 0.3s ease;
        }

        .profile-info:hover {
            background-color: #e0e0e0;
        }

        .profile-info span {
            font-weight: bold;
            color: #555;
            width: 150px;
            flex: 1;
        }

        .profile-info p {
            margin: 0;
            color: #333;
            font-size: 18px;
            flex: 2;
            text-align: left;
            padding-left: 20px;
        }
    </style>
</head>

<body>

    <div class="profile-card">
        <div class="profile-icon">
            <i class="fas fa-user-circle"></i>
        </div>
        <?php
        session_start();
        include("db_conn.php");

        // Check if the user is logged in
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];

            // Query to select the profile of the logged-in user
            $sql = "SELECT * FROM user WHERE username = '$username'";

            $result = mysqli_query($con, $sql);
            if (!$result) {
                // Print out the MySQL error for debugging purposes
                echo "Error executing query: " . mysqli_error($con) . "<br>";
            }
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    // Display the user profile
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Display the first name and last name together
                        echo '<div class="profile-name">' . $row['firstname'] . ' ' . $row['lastname'] . '</div>';
                        // Display the rest of the details
                        echo '<div class="profile-info">';
                        echo '<span style="color: #f39c12;">Email</span>';
                        echo '<p>' . $row['email'] . '</p>';
                        echo '</div>';
                        echo '<div class="profile-info">';
                        echo '<span style="color: #e74c3c;">Phone Number</span>';
                        echo '<p>' . $row['phoneno'] . '</p>';
                        echo '</div>';
                        echo '<div class="profile-info">';
                        echo '<span style="color: #9b59b6;">Address</span>';
                        echo '<p>' . $row['address'] . '</p>';
                        echo '</div>';
                        echo '<div class="profile-info">';
                        echo '<span style="color: #2c3e50;">House Number</span>';
                        echo '<p>' . $row['houseno'] . '</p>';
                        echo '</div>';
                        echo '<div class="profile-info">';
                        echo '<span style="color: #e67e22;">Region</span>';
                        echo '<p>' . $row['region'] . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo "No profile found.";
                }
            } else {
                echo "Error executing query: " . mysqli_error($con);
            }
        } else {
            // Redirect the user to the login page if not logged in
            header("Location: login.php");
            exit;
        }

        // Close the database connection
        mysqli_close($con);
        ?>
    </div>

</body>

</html>
