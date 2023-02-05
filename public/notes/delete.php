<?php

    // This page gets displayed when the user clicks on the Delete button on a specific note.
    // The init file is being required in order to access the app's functions, constants and database connection.

    // The Delete part of the CRUD functionality is initiated on this page.
    // This page calls the session's class is_logged_in() function, to make sure a valid user is logged in.
    // The $_GET super global variable is helping me to identify the id of the note by reaching to the URL parameters, and that value is being assigned to the $id variable.
    // Then the $note variable's being created by making use of the fnd_by_id Note's Class method, we are passing the note's id as a parameter, to retrieve the note's information.
    // I am making use of the $_SERVER super global variable, in order to check the form tag's method attribute value. An If() statement is used to check if the value of the method is equal to 'POST', only when the user clicks the "Yes, I'm sure" button. An instance of the Note Class will be created via the 'new' keyword and passing the $note variable, which contains the selected note's information. This object is getting assigned to the $delete_note variable. Then I'm calling the delete() method that belongs to the Note class to delete the note from the database. The If() statement ends with the user being redirected to the app's Home Page.

    // The Header and Footer sections are being included via partials.

    require('../../app/init.php');

    $session->is_logged_in();

    $id = $_GET['id'] ?? null;
    if(!$id) redirect('/');

    $note = Note::find_by_id($id, $session->user_id);

    if($_SERVER['REQUEST_METHOD'] === "POST") {

        $args = $_POST;
        $args['user_id'] = $session->user_id;

        $delete_note = new Note($args);

        $delete_note->delete();

        redirect('/');

    };

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MDIA 3294 - Note Application - Delete Note</title>

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

            <!-- Delete Header -->
            <div class="grid grid-cols-12 border-b pb-6">
                <div class="col-span-12 flex items-center">
                    <div class="flex-grow">
                        <p class="text-slate-400"><a class="text-purple-500" href="<?php echo get_public_url('/'); ?>">My Notes</a > / <span>Delete Note</span></p>
                        <h1 class="font-bold text-4xl mt-2">Delete: <?php echo h($note['name'])?></h1>
                    </div>
                </div>
            </div>
            <!-- End: Delete Header -->

            <!-- Delete Form -->
            <div class="grid grid-cols-12 mt-10">
                <div class="col-span-12">
                    <form action="<?php echo get_public_url('/notes/delete.php?id=' . h($note['id'])); ?>" method="POST">
                        <p class="mb-4">Are you sure you want to delete <strong class="font-bold"><?php echo h($note['name'])?></strong>?</p>
                        <input type="hidden" name="id" value="<?php echo h($note['id']); ?>">
                        <button class="bg-red-500 rounded-full py-2 px-4 text-white font-bold">Yes, I'm sure</button>
                    </form>
                </div>
            </div>
            <!-- End: Delete Form -->

        </div>
    </div>
    <!-- End: Page Content -->

    <!-- Global Footer -->
    <?php include(get_path('public/partials/footer.php')); ?>
    <!-- End: Global Footer -->

    </body>
</html>