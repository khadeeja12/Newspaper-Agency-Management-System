<?php
include 'db_conn.php';

// Function to handle license image upload
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

if(isset($_POST['register1']))
{
    extract($_POST);
    $first=$_POST['firstname'];
    $last=$_POST['lastname'];
    $email=$_POST['email'];
    $phno=$_POST['phoneno'];
    $addr=$_POST['address'];
    $uname=$_POST['username'];
    $pass=$_POST['password'];
    
    if (isset($_FILES['licenseImage']) && isset($_FILES['licenseImage']['error']) && $_FILES['licenseImage']['error'] === UPLOAD_ERR_OK) {
        $licenseImage = uploadLicenseImage();
    } else {
        $licenseImage = ""; // No file selected, set empty string
    }

    
    $q="INSERT INTO paperboy(firstname,lastname,email,phoneno,address,username,password,license_image)values('$first','$last','$email',$phno,'$addr','$uname','$pass','$licenseImage')";

    if($con->query($q)===TRUE)
    {
        $q="INSERT INTO login(username,password,usertype)values('$uname','$pass','paperboy')";
        if($con->query($q)===TRUE)
        {
            header("location:index.php");
            exit();
        }
        else
        {
            echo" </br>Error";
        }
    }
    $con->close();
}




if(isset($_POST['register2']))
{
    extract($_POST);
    $first=$_POST['firstname'];
    $last=$_POST['lastname'];
    $email=$_POST['email'];
    $phno=$_POST['phoneno'];
    $address=$_POST['address'];
    $houseno=$_POST['houseno'];
    $region = $_POST['region'];
    $uname=$_POST['username'];
    $pass=$_POST['password'];
    $q="INSERT INTO user(firstname,lastname,email,phoneno,address,houseno,region,username,password)values('$first','$last','$email',$phno,'$address','$houseno','$region','$uname','$pass')";
    if($con->query($q)===TRUE)
    {
     $q="INSERT INTO login(username,password,usertype)values('$uname','$pass','user')";
      if($con->query($q)===TRUE)
      {
        
        header("location:index.php");
        exit();
      }
     else
     {
        echo" </br>Error";
     }
}
// $con->close();
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Add  CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        .container {
            max-width:600px;
            margin: 60px auto;
            padding: 200px ;
            background-color: #fff;
            border-radius: 5px;
            bottom: 15%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .buttons {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .button {
            padding: 10px 20px;
            margin: 0 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #0056b3;
        }
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: transparent;
            margin: 0 auto; /* Remove the margin */
            padding: 20px;
             /* border: 1px solid #888;  */
            width: 50%;
            border-radius: 5px;
            position: absolute;
            top: 0%; /* Position at the top of the screen */
            left: 50%;
            transform: translateX(-50%);
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .submit-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .submit-button:hover {
            background-color: #0056b3;
        }
    </style>
    
</head>
<body>
    <div>
<nav class="bg-gray-700 text-white flex justify-between">
        <span class="ml-4 text-xl flex items-center max-3 ">AR Agencies</span>
        <ul class="px-20 py-4 flex space-x-11 justify-end">
            <li class="cursor-pointer"><a href="index.php" class="block py-2 px-3 text-white bg-white rounded md:bg-transparent md:text-white md:p-0 md:dark:text-white dark:bg-white md:dark:bg-transparent" aria-current="page">Home</a> </li>
            <li class="cursor-pointer">Services</li>
            <li class="cursor-pointer"><a href="register.php" class="block py-2 px-3 text-white bg-white rounded md:bg-transparent md:text-white md:p-0 md:dark:text-white dark:bg-white md:dark:bg-transparent" aria-current="page2">Register</a></li>
            <li class="cursor-pointer"><a href="login.php" class="block py-2 px-3 text-white bg-white rounded md:bg-transparent md:text-white md:p-0 md:dark:text-white dark:bg-white md:dark:bg-transparent" aria-current="page">Login</a></li>
     </ul>
    </nav></div>

     <div class="container">
        <div style='font-size:40px;'>
        <center><h1><b>Registration</b></h1></center>
    </div>
        <br><br>
        <div class="buttons">
            <button class="button" onclick="openModal('paperboy')">Register as Paper Boy</button>
            <button class="button" onclick="openModal('customer')">Register as Customer</button>
        </div>
     </div>

    <!-- Success Message Modal -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('successModal')">&times;</span>
            <h2>Success</h2>
            <div id="successContent" class="message"></div>
        </div>
    </div>

    <!-- Paper Boy Registration Modal -->
    <div id="paperboyModal" class="modal">
        <div class="modal-content">
            
            <!-- form for paper boy registration -->
            <form class="max-w-lg mx-auto mt-20 border-2 bg-gray-200 rounded-lg p-10 pb-1 pt-4" method="POST" action="" enctype="multipart/form-data">
            <span class="close" onclick="closeModal('paperboy')">&times;</span>
         <h1 class="text-3xl font-serif mb-6 text-gray-700 ml-20">Paperboy Registration</h1>
    
    
    <div class="grid md:grid-cols-2 md:gap-6">
      <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="firstname" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-800 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
          <label for="floating_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 px-6 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">First name</label>
      </div>
      <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="lastname" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-800 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
          <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 px-6 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Last name</label>
      </div>
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <input type="email" name="email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-800 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 px-6 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Email address</label>
    </div>
    <div class="grid md:grid-cols-2 md:gap-6">
      <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="phoneno" id="floating_phone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-800 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
          <label for="floating_phone" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 px-6 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Phone number </label>
      </div>
      <div class="relative z-0 w-full mb-6 group">
          <input type="text" name="address" id="floating_company" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-800 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
          <label for="floating_place" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 px-6 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Address</label>
      </div>
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <input type="text" name="username" id="floating_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-800 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 px-6 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Username</label>
    </div>
    <div class="relative z-0 w-full mb-10 group">
        <input type="password" name="password" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-800 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 px-6 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Password</label>
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <input type="file" name="licenseImage"  id="licenseImage" accept="image/*"  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-800 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_file" class="peer-focus:font-medium absolute text-md text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 px-6 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">License Image upload</label>
    </div>
    
    <center><button type="submit" name="register1" class="text-white mb-5 mx-auto bg-gray-700 hover:bg-gray-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-800">Register</button></center>
  </form>
        </div>
    </div>

    <!-- Customer Registration Modal -->
    <div id="customerModal" class="modal">
    <div class="modal-content">
            
            <!--  form for paper boy registration -->
            <form class="max-w-lg mx-auto mt-20 border-2 bg-gray-200 rounded-lg p-10 pb-1 pt-4" method="POST" action="">
            <span class="close" onclick="closeModal('customer')">&times;</span>
         <h1 class="text-4xl font-serif mb-6 text-gray-700 ml-20">User Registration</h1>
    

    <div class="grid md:grid-cols-2 md:gap-6">
      <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="firstname" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-800 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
          <label for="floating_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 px-6 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">First name</label>
      </div>
      <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="lastname" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-800 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
          <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 px-6 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Last name</label>
      </div>
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <input type="email" name="email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-800 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 px-6 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Email address</label>
    </div>
    <div class="grid md:grid-cols-2 md:gap-6">
      <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="phoneno" id="floating_phone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-800 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
          <label for="floating_phone" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 px-6 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Phone number </label>
      </div>
      <div class="relative z-0 w-full mb-6 group">
          <input type="text" name="address" id="floating_company" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-800 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
          <label for="floating_place" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 px-6 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Address</label>
      </div>
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <input type="text" name="houseno" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-800 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 px-6 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">House No</label>
    </div>
    <div class="mb-5">
    <label for="region" class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Select the Region</label>
    <select id="region" name="region" class="bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

    <option value="">Select Region</option>
                    <option value="kuzhivelipady">Kuzhivelipady</option>
                    <option value="thevakkal">Thevakkal</option>
                    <option value="kangarapady">Kangarapady</option>
                    <option value="njarakatummola">Njarakatummola</option>
                    <option value="mochankulam">Mochankulam</option>
                    <option value="pukkatupady">Pukkatupady</option>
  </select>
   </div>
    <div class="relative z-0 w-full mb-5 group">
        <input type="text" name="username" id="floating_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-800 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 px-6 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Username</label>
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <input type="password" name="password" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-800 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 px-6 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Password</label>
    </div>
    
    <center><button type="submit" name="register2" class="text-white mb-5 mx-auto bg-gray-700 hover:bg-gray-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-800">Register</button></center>
  </form>
        </div>
    </div>

    <!-- Display the message -->
    <?php echo $message; ?>

    <script>
        // Function to open modal
        function openModal(modalId) {
            var modal = document.getElementById(modalId + "Modal");
            modal.style.display = "block";
        }

        // Function to close modal
        function closeModal(modalId) {
            var modal = document.getElementById(modalId + "Modal");
            modal.style.display = "none";
        }

        // Close the modal when the user clicks outside of it
        window.onclick = function(event) {
            if (event.target.className === "modal") {
                event.target.style.display = "none";
            }
        }

        // Display the success message modal
        function showSuccessMessage(message) {
            var successModal = document.getElementById("successModal");
            var successContent = document.getElementById("successContent");
            successContent.innerHTML = message;
            successModal.style.display = "block";
        }

        // Display the error message modal
        function showErrorMessage(message) {
            var errorModal = document.getElementById("errorModal");
            var errorContent = document.getElementById("errorContent");
            errorContent.innerHTML = message;
            errorModal.style.display = "block";
        }

        // Handle success or failure message from server
        <?php if (!empty($message)) : ?>
            showSuccessMessage("<?php echo $message; ?>");
        <?php elseif (!empty($error)) : ?>
            showErrorMessage("<?php echo $error; ?>");
        <?php endif; ?>
    </script>
     <!-- <footer>
        &copy; <?php echo date("Y"); ?> PaperPulse - All rights reserved.
    </footer> -->
</body>
</html>
