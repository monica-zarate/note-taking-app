<?php

    // This page gets displayed when the user clicks on the Add New button on the site's Home page.
    // The init file is being required in order to access the app's functions, constants and database connection.

    // The Create part of the CRUD functionality is initiated on this page.
    // This page calls the session's class is_logged_in() function, to make sure a valid user is logged in.
    // I am making use of the $_SERVER super global variable, in order to check the form tag's method attribute value. I am also making use of an If() statement to check if the value of the method is equal to 'POST', an instance of the Note Class will be created via the 'new' keyword and passing the $_POST super global variable, which is collecting the form input's data. This object is getting assigned to the $note variable. Then I'm calling the create() method that belongs to the Note class to create a new note on the database. The If() statement ends with the user being redirected to the app's Home Page. 

    // The Header and Footer sections are being included via partials.

    require('../../app/init.php');

    $session->is_logged_in();

    if($_SERVER['REQUEST_METHOD']=== 'POST') {

        $args = $_POST;
        $args['user_id'] = $session->user_id;

        $note = new Note($args);
        $note->create();

        redirect('/');

    }

?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MDIA 3294 - Note Application - Create Note</title>

        <!-- tailwindcss -->
        <script src="https://cdn.tailwindcss.com"></script>

    </head>

    <body class="flex flex-col min-h-screen">

        <!-- Global Menu & Logo -->
        <?php include(get_path('public/partials/header.php')); ?>
        <!--  End: Global Menu & Logo -->

        <!-- Page Content -->
        <div class="flex-grow">
            <div class="container mx-auto py-20">

                <!-- Create Header -->
                <div class="grid grid-cols-12 border-b pb-6">
                    <div class="col-span-12 flex items-center">
                        <div class="flex-grow">
                            <p class="text-slate-400"><a class="text-purple-500" href="<?php echo get_public_url('/'); ?>">My Notes</a> / <span>Add New Note</span></p>
                            <h1 class="font-bold text-4xl mt-2">Add New Note</h1>
                        </div>
                    </div>
                </div>
                <!-- End: Create Header -->

                <!-- Create Form -->
                <div class="grid grid-cols-12 mt-10">
                    <div class="col-span-12">

                        <form id="create_note" action="<?php echo get_public_url('/notes/create.php'); ?>" method="POST">

                            <!-- Sample tailwind text:input -->
                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="note_name">Name</label>
                                <input class="shadow border rounded w-full py-2 px-3 text-gray-700" id="note_name" type="text" name="name">
                            </div>
                            <!-- End Sample tailwind text:input -->

                            <!-- Sample tailwind textarea -->
                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="note_body">Body</label>
                                <textarea class="shadow border rounded w-full py-2 px-3 text-gray-700  h-28" id="note_body" name="body"></textarea>
                            </div>
                            <!-- End Sample tailwind textarea -->

                            <!-- Sample tailwind select -->
                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="note_course">Course Number</label>
                                <select class="shadow border rounded w-full py-2 px-3 text-gray-700 bg-white" id="note_course" name="course_number">
                                    <option value="3075">3075 - Portfolio 1</option>
                                    <option value="3294">3294 - Web Scripting 2</option>
                                </select>
                            </div>
                            <!-- End Sample tailwind select -->


                            <!-- Sample tailwind button -->
                            <button class="bg-emerald-500 rounded-full py-2 px-4 text-white font-bold">Save</button>
                            <!-- End Sample tailwind button -->

                        </form>

                    </div>
                </div>
                <!-- End: Create Form -->

            </div>
        </div>
        <!-- End: Page Content -->

        <!-- Global Footer -->
        <?php include(get_path('public/partials/footer.php')); ?>
        <!-- End: Global Footer -->

    </body>
</html>