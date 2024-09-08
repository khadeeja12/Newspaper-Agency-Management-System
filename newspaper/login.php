<?php
session_start();
Include("db_conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<body>
    <nav class="bg-gray-700 text-white flex justify-between">
        <span class="ml-4 text-xl flex items-center max-3 ">AR Agencies</span>
        <ul class="px-20 py-4 flex space-x-11 justify-end">
            <li class="cursor-pointer"><a href="index.php" class="block py-2 px-3 text-white bg-white rounded md:bg-transparent md:text-white md:p-0 md:dark:text-white dark:bg-white md:dark:bg-transparent" aria-current="page">Home</a> </li>
            <li class="cursor-pointer">Contact Us</li>
            
     </ul>
    </nav>
    

    <form class="max-w-md mx-auto mt-40 border-2 bg-gray-200 rounded-lg p-10" method="POST" action="">
        <h1 class="text-4xl font-serif mb-5 ml-20">Login</h1>
        <div class="mb-5">
          <label for="email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-600">Username</label>
          <input type="text" name="username" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-400 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="username" required />
        </div>
        <div class="mb-5">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-600">Password</label>
          <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-400 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
        </div>
        
        <button type="submit" name="login" class="text-white mb-5 bg-gray-800 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Login</button>
      <div>Don't have an Account ? <a href="register.php"><u>Register here</u></a>
</div>
      </form>

     

</body>
</html>


<?php
 if(isset($_POST['login']))
 {
   $uname=$_POST['username'];
   $pass=$_POST['password'];
   $sql="select * from login where username='$uname' and password='$pass'";
   $data=mysqli_query($con,$sql);
   if($data)
   {
    if(mysqli_num_rows($data)==1)
    {
      $row=mysqli_fetch_array($data);
      if($row['username']===$uname&&$row['password']===$pass)
      {
        $_SESSION['username']=$row['username'];
        $_SESSION['password']=$row['password'];
        $_SESSION['id']=$row['id'];
        if($row['usertype']=='admin')
        {
          Header("location:adminindex.php");
          exit();
        }
        if($row['usertype']=='paperboy')
        {
          Header("location:index.php");
          exit();
        }
        if($row['usertype']=='user')
        {
          header("location:userindex.php");
        }
        else
        {
          Header("location:login.php?incorrect username or password");
          Exit();
        }
      }
    }
   }
 } 
?>