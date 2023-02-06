<?php

    require('../app/init.php');

    $session->is_logged_in();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MDIA 4590 - Notes Application</title>

        <!-- tailwindcss -->
        <script src="https://cdn.tailwindcss.com"></script>

    </head>

    <body class="flex flex-col min-h-screen">

        <!-- Global Menu & Logo -->
        <?php include(get_path('public/partials/header.php')); ?>
        <!--  End: Global Menu & Logo -->

        <!-- Page Content -->
        <div class="flex-grow">
            <div class="grid grid-cols-12 grid-rows-3">
                <div class="col-start-1 col-end-13 row-start-1 row-end-3 bg-emerald-500">
                </div>
                <div class="col-start-2 row-start-2 row-end-4 grid justify-items-center content-center bg-purple-200 w-[200px] h-[200px] rounded-[100px] border border-purple-500">
                    <span class="text-base text-emerald-500">User's avatar here!</span>
                </div>
            </div>
            <div class="grid grid-cols-12 pb-6">
                <div class="col-start-3 col-end-11 col-span-8 flex items-center container mx-auto py-20">
                    <h1 class="font-bold text-2xl flex-grow text-center text-emerald-500">Full name.</h1>
                </div>
                <!-- Profile Details Start -->
                <div class="col-start-3 col-end-11 col-span-8">

                    <form action="<?php echo get_public_url('/users/create.php'); ?>" method="POST" class="shadow border rounded w-full py-2 px-3 text-gray-700">

                        <div class="mb-4">
                            <input class="shadow border rounded w-full py-2 px-3 text-gray-700" id="user_name" type="text" name="username" placeholder="Username goes here!">
                        </div>

                        <div class="mb-4">
                            <input class="shadow border rounded w-full py-2 px-3 text-gray-700" id="user_dob" type="text" name="dob" placeholder="YYY,MM,DD">
                        </div>

                        <div class="mb-4">
                            <input class="shadow border rounded w-full py-2 px-3 text-gray-700" id="user_email" type="email" name="email" placeholder="User's email goes here!">
                        </div>

                        <div class="mb-4">
                            <input class="shadow border rounded w-full py-2 px-3 text-gray-700" id="user_password" type="password" name="password" placeholder="Password">
                        </div>

                        <div class="mb-4">
                            <select class="shadow border rounded w-full py-2 px-3 text-gray-700" name="country" id="user_country">
                                <option value="">Please choose one</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="India">India</option>
                                <option value="Canada">Canada</option>
                                <option value="USA">USA</option>
                                <option value="Mexico">Mexico</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <input class="shadow border rounded w-full py-2 px-3 text-gray-700" id="user_phone" type="tel" name="phone" placeholder="Phone number goes here!">
                        </div>

                        <div class="mb-4">
                            <input class="shadow border rounded w-full py-2 px-3 text-gray-700" id="user_interests" type="text" name="interests" placeholder="User's interests goes here!">
                        </div>

                        <div class="mb-4">
                            <button class="bg-emerald-500 rounded-full py-2 px-4 text-white font-bold" type="submit">
                                <a class="inline-block py-2 no-underline font-bold" href="<?php echo get_public_url('/users/logout.php'); ?>">Log Out</a>
                            </button>
                        </div>

                    </form>
                </div>
                <!-- Profile Details End -->
            </div>
        </div>
        <!-- End: Page Content -->

        <!-- Global Footer -->
        <?php include(get_path('public/partials/footer.php')); ?>
        <!-- End: Global Footer -->

    </body>
</html>