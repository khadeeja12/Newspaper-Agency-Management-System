<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        
        .flex-center {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
            
        }
        .heading {
            margin-bottom: 100px; 
            font-size: 2rem;
            font-weight: bold;
            font-family: 'Open Sanso';
            text-align: center;
        }
        .table-container {
            margin-bottom: 50px;
            width: 100%; /* Added to make the table responsive */
            overflow-x: auto;
            display: flex;
            justify-content: center; /* Added to enable horizontal scrolling if needed */
        }
    </style>
</head>
<body class="bg-white">
<nav class="bg-gray-700 text-white flex justify-between">
    <span class="ml-4 text-xl flex items-center max-3 ">AR Agencies</span>
    <ul class="px-20 py-4 flex space-x-11 justify-end">
        <li class="cursor-pointer"><a href="index.php" class="block py-2 px-3 text-white bg-white rounded md:bg-transparent md:text-white md:p-0 md:dark:text-white dark:bg-white md:dark:bg-transparent" aria-current="page">Home</a></li>
        <li class="cursor-pointer">Services</li>
        <li class="cursor-pointer"><a href="register.php" class="block py-2 px-3 text-white bg-white rounded md:bg-transparent md:text-white md:p-0 md:dark:text-white dark:bg-white md:dark:bg-transparent" aria-current="page2">Register</a></li>
        <li class="cursor-pointer"><a href="adminindex.php" class="block py-2 px-3 text-white bg-white rounded md:bg-transparent md:text-white md:p-0 md:dark:text-white dark:bg-white md:dark:bg-transparent" aria-current="page">Logout</a></li>
    </ul>
</nav><br><br>
<!-- <div class="flex-center">-->
        <h1 class="text-cyan-900 heading">Paperboy Profile</h1>
        <div class="table-container ">
        
<?php
// Assuming you have already established a database connection
$con=mysqli_connect("localhost","root","","newspaper");
// Query to select all items from the paperboy table
$sql = "SELECT * FROM paperboy";
$result = mysqli_query($con,$sql);

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    // Start building the HTML table
    echo '<table class="shadow-2xl font-[poppins] border-2 border-cyan-200 w-10/12  overflow-hidden">';
    echo '<thead class="text-white">';
    echo '<tr>';
    echo '<th class="py-3 bg-cyan-800">SL No</th>';
    echo '<th class="py-3 bg-cyan-800">Name</th>';
    echo '<th class="py-3 bg-cyan-800">EMAIL</th>';
    echo '<th class="py-3 bg-cyan-800">PHONE_NO</th>';
    echo '<th class="py-3 bg-cyan-800">ADDRESS</th>';
    echo '<th class="py-3 bg-cyan-800">LICENSE</th>';
    echo '<th class="py-3 bg-cyan-800">UPDATE</th>';
    echo '<th class="py-3 bg-cyan-800">DELETE</th>';
    // Add more table headers as needed
    echo '</tr>';
    echo '</thead>';
    echo '<tbody class="text-cyan-900 text-center">';
    $counter = 1;
    // Loop through each row and display the data
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr  class=" hover:bg-cyan-100 hover:scale-105 bg-cyan-200 cursor-pointer duration-300">';
        echo '<td class="py-3 px-6">' . $counter . '</td>';
        echo '<td class="py-3 px-6 ">' . $row['firstname'] . '</td>';
        echo '<td class="py-3 px-6 ">' . $row['email'] . '</td>';
        echo '<td class="py-3 px-6 ">' . $row['phoneno'] . '</td>';
        echo '<td class="py-3 px-6 ">' . $row['address'] . '</td>';
        echo '<td class="py-3 px-6"><img src="uploads/' . $row['license_image'] . '" alt="License Image" style="max-width: 100px;"></td>';
        echo '<td class="py-3 px-6"><button class="bg-cyan-800 hover:bg-cyan-500 text-white font-bold py-2 px-4 rounded"><a href="boy_edit.php?id='. $row['id'] .'">Edit</a></button></td>';
        
        echo '<td class="py-3 px-6">';
        echo '<form id="deleteForm'.$row['id'].'" method="POST" action="boy_delete.php">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo '<button type="button" onclick="confirmDelete('.$row['id'].')" class="bg-cyan-800 hover:bg-cyan-500 text-white font-bold py-2 px-4 rounded">Delete</button>';
        echo '</form>';
        echo '</td>';
        // Add more table data cells as needed
        echo '</tr>';
        $counter++;
    }
    
    echo '</tbody>';
    echo '</table>';
} else {
    echo "No items found in the paperboy table.";
}

// Close the database connection
mysqli_close($con);
?>

<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this user?")) {
            document.getElementById("deleteForm" + id).submit();
        }
    }
</script>
</div>
</div>
</body>
</html>