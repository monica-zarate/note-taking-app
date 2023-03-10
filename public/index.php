<?php

    // To start running our app, I am importing the 'init' file from the app folder, that file is important to be accessible throughout the application, since it contains the site's constants, has access to the functions and classes files, as well as the database connection. 

    // I am calling the find_all() method from the Note Class, this time making use of the user id we retrieve from the session's Class is_logged_in() method, which returns all the notes from the database for each different user accordingly, and we are assigning that data to the $notes variable. We are making use of the loop partial, which is were we map out each of the notes and passing them through the fetch_assoc() method, to retrieve each note in a associative array form, to access their key and values information. This information gets rendered on the page with the help of the Card partial.

    require('../app/init.php');

    $session->is_logged_in();

    $notes = Note::find_all($session->user_id);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MDIA 3294 - Notes Application</title>

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

                <?php include(get_path('public/partials/notes/loop.php')); ?>

            </div>
        </div>
        <!-- End: Page Content -->

        <!-- Global Footer -->
        <?php include(get_path('public/partials/footer.php')); ?>
        <!-- End: Global Footer -->

    </body>
</html>