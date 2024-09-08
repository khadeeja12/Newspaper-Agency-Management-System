<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adminhome</title>
  <script src="https://cdn.tailwindcss.com"></script>
  
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;800&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<body class="bg-white font-[Poppins]">
  <span class="absolute text-white text-4xl top-5 left-4 cursor-pointer" onclick="Openbar()">
    <i class="bi bi-filter-left px-2 bg-gray-900 rounded-md"></i>
  </span>
  <div class="sidebar fixed top-0 bottom-0 lg:left-0 left-[-300px] duration-1000
    p-2 w-[300px] overflow-y-auto text-center bg-gray-900 shadow h-screen">
    <div class="text-gray-100 text-xl">
      <div class="p-2.5 mt-1 flex items-center rounded-md ">
        <i class="bi bi-app-indicator px-2 py-1 bg-black-600 rounded-md"></i>
        <h1 class="text-[15px] ml-3 text-xl text-gray-200 font-bold">AdminHome</h1>
        <i class="bi bi-x ml-20 cursor-pointer lg:hidden" onclick="Openbar()"></i>
      </div>
      <hr class="my-2 text-gray-600">

      <div>
        <div class="p-2.5 mt-3 flex items-center rounded-md 
        px-4 duration-300 cursor-pointer bg-gray-700">
          <i class="bi bi-search text-sm"></i>
          <input class="text-[15px] ml-4 w-full bg-transparent focus:outline-none" placeholder="Serach" />
        </div>

        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-gray-600">
          <i class="bi bi-house-door-fill"></i>
          <span class="text-[15px] ml-4 text-gray-200">Home</span>
        </div>
        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-gray-600">
          <i class="bi bi-person-fill"></i>
          <div class="flex justify-between w-full items-center" onclick="dropDown2()">
          <span class="text-[15px] ml-4 text-gray-200">Manage Profile</span>
          <span class="text-sm rotate-180" id="arrow2">
              <i class="bi bi-chevron-down"></i>
            </span>
          </div>
        </div>
        <div class=" leading-7 text-left text-sm font-thin mt-2 w-4/5 mx-auto" id="submenu2">
          <h1 class="cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1"><a href="boy_profile.php" class="href">Paperboy</a></h1>
          <h1 class="cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1"><a href="user_profile.php" class="href">User</a></h1>
        </div>
        <hr class="my-4 text-gray-600">
        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-gray-600">
          <i class="bi bi-file-earmark-text-fill "></i>
          <span class="text-[15px] ml-4 text-gray-200">View Orders</span>
        </div>
        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-gray-600">
          <i class="bi bi-file-earmark-text-fill "></i>
          <span class="text-[15px] ml-4 text-gray-200"><a href="admin_addnewspaper.php">Add Newspapers</a></span>
        </div>
        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-gray-600">
          <i class="bi bi-person-circle"></i>
          <span class="text-[15px] ml-4 text-gray-200"><a href="admin_assignnewspaper.php">Assign Paperboy</a></span>
        </div>

        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-gray-600">
          <i class="bi bi-chat-left-text-fill"></i>
          <div class="flex justify-between w-full items-center" onclick="dropDown()">
            <span class="text-[15px] ml-4 text-gray-200">Feedback</span>
            <span class="text-sm rotate-180" id="arrow">
              <i class="bi bi-chevron-down"></i>
            </span>
          </div>
        </div>
        <div class=" leading-7 text-left text-sm font-thin mt-2 w-4/5 mx-auto" id="submenu">
          <h1 class="cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">Paperboy</h1>
          <h1 class="cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">User</h1>
        </div>

        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-gray-600">
          <i class="bi bi-chat-left-text-fill"></i>
          <div class="flex justify-between w-full items-center" onclick="dropDown3()">
            <span class="text-[15px] ml-4 text-gray-200">Reports</span>
            <span class="text-sm rotate-180" id="arrow3">
              <i class="bi bi-chevron-down"></i>
            </span>
          </div>
        </div>
        <div class=" leading-7 text-left text-sm font-thin mt-2 w-4/5 mx-auto" id="submenu3">
          <h1 class="cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">Paperboy</h1>
          <h1 class="cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">User</h1>
        </div>

        <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-gray-600">
          <i class="bi bi-box-arrow-in-right"></i>
          <span class="text-[15px] ml-4 text-gray-200"><a href="logout.php" class="href">Logout</a></span>
        </div>

      </div>
    </div>
  </div>
  <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center">
    <h1 class="text-4xl text-cyan-900 font-serif font-semibold">WELCOME  ADMIN ....</h1>
  </div>
  <script>
    function dropDown() {
      document.querySelector('#submenu').classList.toggle('hidden')
      document.querySelector('#arrow').classList.toggle('rotate-0')
      
    }
    dropDown()

    function dropDown2() {
      document.querySelector('#submenu2').classList.toggle('hidden')
      document.querySelector('#arrow2').classList.toggle('rotate-0')
    }
    dropDown2()

    function dropDown3() {
      document.querySelector('#submenu3').classList.toggle('hidden')
      document.querySelector('#arrow3').classList.toggle('rotate-0')
    }
    dropDown3()

    function Openbar() {
      document.querySelector('.sidebar').classList.toggle('left-[-300px]')
    }
  </script>


</body>

</html>