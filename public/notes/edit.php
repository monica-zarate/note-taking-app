<?php

    // This page gets displayed when the user clicks on the Edit button on a specific note.
    // The init file is being required in order to access the app's functions, constants and database connection.
    // This page calls the session's class is_logged_in() function, to make sure a valid user is logged in.
    // The Update part of the CRUD functionality is initiated on this page.
    // We need to do is identify which note was selected and the user wants to make changes to. The $_GET super global variable is helping me to identify the id of the note by reaching to the URL parameters, and that value is being assigned to the $id variable.
    // I am making use of the $_SERVER super global variable, in order to check the form tag's method attribute value. An If() statement is used to check if the value of the method is equal to 'POST', this block will only run when the user clicks the "Save" button. The $_POST super global variable is being assigned to the $args variable, this variable is reaching to the form and retrieving the values of the inputs. We're also assigning the $id we got earlier thanks to the $_GET super global variable, and we are using it to assign it as the $args['id']. An instance of the Note Class will be created via the 'new' keyword passing the $args variable, which contains the selected updated note's information. This object is getting assigned to the $update_note variable. Then I'm calling the update() method that belongs to the Note class to update the note's properties on the database. This code block ends with the user being redirected to the app's Home Page.
    // An else block creates the $note variable's making use of the fnd_by_id() Note's Class method, we are passing the note's id and the user id as a parameter, to retrieve the note's information we are looking at on the page before we do anything else.

    // The Header and Footer sections are being included via partials.

    require('../../app/init.php');

    $session->is_logged_in();

    $id = $_GET['id'] ?? null;
    if(!$id) redirect('/');

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $args = $_POST;
        $args['id'] = $id;
        $args['user_id'] = $session->user_id;

        $update_note = new Note($args);

        $update_note->update();

        redirect('/');
    } else {
        $note = Note::find_by_id($id, $session->user_id);
    }

?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MDIA 3294 - Note Application - Edit Note</title>

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

                <!-- Edit Header -->
                <div class="grid grid-cols-12 border-b pb-6">
                    <div class="col-span-12 flex items-center">
                        <div class="flex-grow">
                            <p class="text-slate-400"><a class="text-purple-500" href="<?php echo get_public_url('/'); ?>">My Notes</a> / <span>Edit Note</span></p>
                            <h1 class="font-bold text-4xl mt-2">Edit: <?php echo h($note['name']); ?></h1>
                        </div>
                    </div>
                </div>
                <!-- End: Edit Header -->

                <!-- Edit Form -->
                <div class="grid grid-cols-12 mt-10">
                    <div class="col-span-12">

                        <form action="<?php echo get_public_url('/notes/edit.php?id=' . h($note['id'])); ?>" method="POST">

                            <!-- Sample tailwind text:input -->
                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="note_name">Name</label>
                                <input class="shadow border rounded w-full py-2 px-3 text-gray-700" id="note_name" type="text" name="name" value="<?php echo h($note['name']); ?>">
                            </div>
                            <!-- End Sample tailwind text:input -->

                            <!-- Sample tailwind textarea -->
                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="note_body">Body</label>
                                <textarea class="shadow border rounded w-full py-2 px-3 text-gray-700  h-28" id="note_body" name="body"><?php echo h($note['body']); ?></textarea>
                            </div>
                            <!-- End Sample tailwind textarea -->

                            <!-- Sample tailwind select -->
                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="note_course">Course Number</label>
                                <select class="shadow border rounded w-full py-2 px-3 text-gray-700 bg-white" id="note_course" name="course_number">
                                    <option <?php echo($note['course_number'] == 3075 ? 'selected' : ''); ?> value="3075">3075 - Portfolio 1</option>
                                    <option <?php echo($note['course_number'] == 3294 ? 'selected' : ''); ?> value="3294">3294 - Web Scripting 2</option>
                                </select>
                            </div>
                            <!-- End Sample tailwind select -->

                            <!-- Sample tailwind button -->
                            <button class="bg-emerald-500 rounded-full py-2 px-4 text-white font-bold">Save</button>
                            <!-- End Sample tailwind button -->

                        </form>

                    </div>
                </div>
                <!-- End: Edit Form -->

            </div>
        </div>
        <!-- End Page Content -->

        <!-- Global Footer -->
        <?php include(get_path('public/partials/footer.php')); ?>
        <!-- End: Global Footer -->

    </body>
</html>