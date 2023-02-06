<?php

// When the user clicks on the "Yes I am sure" button we, will call the log_out() function and re-direct the user to the login page.
  require('../../app/init.php');

  $session->is_logged_in();

  if($_SERVER['REQUEST_METHOD'] === "POST") {
		
		$session->log_out();
		redirect('/users/login.php');
	 
	}

?><!DOCTYPE html>
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

    <!-- Page Content -->
    <div class="flex-grow container mx-auto">
      <div class="max-w-screen-2xl px-8 mx-auto py-20">

        <!-- Index Header -->
        <div class="grid grid-cols-12 border-b pb-6">
          <div class="col-span-12 flex items-center">
            <h1 class="font-bold text-4xl flex-grow">Log Out</h1>
          </div>
        </div>
        <!-- End: Index Header -->

        <!-- Logout: Form -->
        <div class="grid grid-cols-12 mt-10">
            <div class="col-span-12">

                <form action="<?php get_public_url('/users/logout.php'); ?>" method="POST">
                    <p class="mb-4">Are you sure you want <strong>Log Out</strong>?</p>
                    <button class="bg-red-500 rounded-full py-2 px-4 text-white font-bold" type="submit">Yes, I'm sure!</button>                        
                </form>

            </div>
        </div>
        <!-- End Logout Form -->          
    
      </div>
    </div>
    <!-- End: Page Content -->

    <!-- Global Footer -->
    <?php include(get_path('public/partials/footer.php')); ?>

</body>

</html>