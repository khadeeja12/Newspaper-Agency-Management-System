<?php
session_start();
include("db_conn.php");

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
}


// Initialize $row variable
$row = [];

// Fetch user data based on ID (assuming ID is passed as a parameter)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM user WHERE id = $id";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        // Handle case where user with given ID is not found
        echo "User not found";
        exit();
    }
}

//when click on update button
if (isset($_POST['update'])) {
    if (!isset($id)) {
        echo "User ID is missing";
        exit();
    }

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phoneno = $_POST['phoneno'];
    $address = $_POST['address'];
    $houseno = $_POST['houseno'];
    $region = $_POST['region'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $update_query = "UPDATE user SET firstname='$firstname', lastname='$lastname', email='$email', phoneno='$phoneno', address='$address', houseno='$houseno', region='$region' , username='$username', password='$password' WHERE id=$id";

    if (mysqli_query($con, $update_query)) {
        header("location: user_profile.php?id=$id");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Edit profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 600px;
            margin: 60px auto;
            padding: 40px 40px 20px 40px;
            background-color: #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            font-family: 'Open Sanso';
        }

        label {
            color: #555;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .buttons {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button {
            padding: 10px 20px;
            background-color:black;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2> Edit User Profile</h2>
        <form method="POST" action="user_edit.php?id=<?php echo $id; ?>">
            <label for="firstname">First Name</label>
            <input type="text" value="<?php echo $row['firstname']; ?>" name="firstname" id="firstname" placeholder="Enter first name" required>
            
            <label for="lastname">Last Name</label>
            <input type="text" value="<?php echo $row['lastname']; ?>" name="lastname" id="lastname" placeholder="Enter last name" required>
            
            <label for="email">Email </label>
            <input type="email"value="<?php echo $row['email']; ?>" name="email" id="email" placeholder="Enter email address" required>

            <label for="phoneno">Phone Number</label>
            <input type="text"value="<?php echo $row['phoneno']; ?>" name="phoneno" id="phoneno" placeholder="Enter phone number" required>

            <label for="address">Address</label>
            <input type="text"value="<?php echo $row['address']; ?>" name="address" id="address" placeholder="Enter address" required>

            <label for="houseno">House No</label>
            <input type="text" value="<?php echo $row['houseno']; ?>" name="houseno" id="houseno" placeholder="Enter house number" required>

            <label for="region">Select the Region</label>
            <select id="region" name="region" required>
                <option value="" disabled>Select Region</option>
                <option value="kuzhivelipady" <?php if($row['region'] == 'kuzhivelipady') echo 'selected'; ?>>Kuzhivelipady</option>
                <option value="thevakkal" <?php if($row['region'] == 'thevakkal') echo 'selected'; ?>>Thevakkal</option>
                <option value="kangarapady" <?php if($row['region'] == 'kangarappady') echo 'selected'; ?>>Kangarapady</option>
                <option value="njarakatummola" <?php if($row['region'] == 'njarakatummol') echo 'selected'; ?>>Njarakatummola</option>
                <option value="mochankulam" <?php if($row['region'] == 'mochankulam') echo 'selected'; ?>>Mochankulam</option>
                <option value="pukkatupady" <?php if($row['region'] == 'pukkatupad') echo 'selected'; ?>>Pukkatupady</option>
            </select>
            
            <label for="username">Username</label>
            <input type="text" value="<?php echo $row['username']; ?>" name="username" id="username" placeholder="Enter Username" required>

            <label for="houseno">Password</label>
            <input type="text" value="<?php echo $row['password']; ?>" name="password" id="password" placeholder="Enter password" required>
            <div class="buttons">
                <button type="submit" name="update" value="update" class="button">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
