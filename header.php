<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Scheduling</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="w-full h-full bg-[#151515] text-white flex flex-col min-h-screen">

    <!-- Header -->
    <header class="flex h-[94px] w-full items-center justify-between bg-[#444444] px-6">
    <div class="flex items-center md:ml-[75px] my-[10px] md:h-[94px] text-[18px]" style="font-family: 'Poppins', sans-serif; font-weight: 600;">
        <!-- Home icon -->
        <img src="img/B.png" alt="Logo" class="md:w-[47px] md:h-[42px] w-[45px] h-[47px] mr-[10px]">
        <span>Delivery Scheduling</span>
    </div>
            <!-- Sign Up and Sign In buttons for mobile devices -->
            <div class="flex items-center space-x-2 md:hidden">
                <img src="img/profile.png" alt="Sign Up" class="w-[20px] h-[19px]">
                <a href="#" class="text-[#95D600]">Sign up</a>
                <span class="text-[#95D600]">|</span>
                <a href="#" class="text-[#95D600]">Sign In</a>
            </div>
            <!-- User menu -->
            <div class="relative hidden md:block">
                <button id="user-menu-button" class="flex items-center focus:outline-none">
                    <!-- Nurul Khairina image only on desktop -->
                    <img src="img/khairina.png" alt="User"
                        class="rounded-full w-[42px] h-[42px] ml-[30px] hidden md:block">
                    <span class="ml-2">Nurul Khairina</span>
                    <svg class="ml-2 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 011.06-.02L10 10.586l3.71-3.366a.75.75 0 111.02 1.098l-4 3.625a.75.75 0 01-1.02 0l-4-3.625a.75.75 0 01-.02-1.06z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <div id="user-menu" class="absolute right-0 mt-2 w-48 bg-white text-black rounded-md shadow-lg hidden">
                    <a href="#" class="block px-4 py-2 hover:bg-gray-200">Profile</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-200">Settings</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-200">Logout</a>
                </div>
            </div>
        </nav>
    </header>
</body>
</html>