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
    $query = "SELECT * FROM paperboy WHERE id = $id";
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
//when click on update button
if (isset($_POST['update2'])) {
    if (!isset($id)) {
        echo "User ID is missing";
        exit();
    }

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phoneno = $_POST['phoneno'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if a new license image is uploaded
    $licenseImage = "";
    if (isset($_FILES['license_image']) && $_FILES['license_image']['error'] === UPLOAD_ERR_OK) {
        // Handle file upload and obtain the file name
        $targetDirectory = "uploads/";
        $randomFilename = generateRandomString() . '.jpg';
        $targetFile = $targetDirectory . $randomFilename;

        if (move_uploaded_file($_FILES["license_image"]["tmp_name"], $targetFile)) {
            $licenseImage = $randomFilename;
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    }

    // Build the update query
    $update_query = "UPDATE paperboy SET firstname='$firstname', lastname='$lastname', email='$email', phoneno='$phoneno', address='$address', username='$username', password='$password'";
    
    // Update the license image if a new one is uploaded
    if (!empty($licenseImage)) {
        $update_query .= ", license_image='$licenseImage'";
    }
    
    $update_query .= " WHERE id=$id";

    if (mysqli_query($con, $update_query)) {
        header("location: boy_profile.php?id=$id");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}

// Handle file upload if a new license image is provided
function uploadLicenseImage() {
    $targetDirectory = "uploads/";
    $randomFilename = generateRandomString() . '.jpg'; // Generate random filename with .jpg extension
    $targetFile = $targetDirectory . $randomFilename;

    if (move_uploaded_file($_FILES["licenseImage"]["tmp_name"], $targetFile)) {
        return $randomFilename; // Return the generated filename if upload is successful
    } else {
        return false; // Return false if upload fails
    }
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

if (isset($_FILES['licenseImage']) && isset($_FILES['licenseImage']['error']) && $_FILES['licenseImage']['error'] === UPLOAD_ERR_OK) {
    $licenseImage = uploadLicenseImage();
} else {
    $licenseImage = ""; // No file selected, set empty string
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paperboy Edit profile</title>
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
        <h2> Edit Paperboy Profile</h2>
        <form method="POST" action="boy_edit.php?id=<?php echo $id; ?>" enctype="multipart/form-data">

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

            <label for="username">Username</label>
            <input type="text" value="<?php echo $row['username']; ?>" name="username" id="username" placeholder="Enter Username" required>

            <label for="houseno">Password</label>
            <input type="text" value="<?php echo $row['password']; ?>" name="password" id="password" placeholder="Enter password" required>
             
            <label for="license_image">License Image</label>
            <input type="file" name="license_image" id="license_image">
            
            <?php
            // Check if the row contains the license image information
            if (!empty($row['license_image'])) {
                // Display the previously uploaded image
                echo '<img src="uploads/' . $row['license_image'] . '" alt="Previous License Image" style="max-width: 100%;">';
                // Provide a hidden input field to retain the previously uploaded image
                echo '<input type="hidden" name="prev_license_image" value="' . $row['license_image'] . '">';
            }
            ?>
            <div class="buttons">
                <button type="submit" name="update2" value="update2" class="button">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
