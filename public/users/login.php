<?php

require('../../app/init.php');

if (is_post_request()) {

  // Create a query to find a user on the db with the submitted email
  // If there's a match, we will retrieve the user's data information and will use the $user_record variable to create a new User object from the User Class.
  // We are then validating the user's password and if the validation is successful, the user will be redirected to the dashboard of the application. Otherwise, a message will be displayed for the user to try again. (We shouldn't let the user know if their email or password is the issue when something goes wrong, to prevent any attacks on the app =( we don't want trouble with hackers, but in this case we're doing it for illustrative purposes only)
  $user = User::find_user_by_email($_POST['email']);

  $record_count = $user->num_rows;

  if ($record_count == 1) {
    $user_record = $user->fetch_assoc();

    $user = new User($user_record);

    $valid_pass = $user->validate_password($_POST['password']);

    if ($valid_pass) {

      $session->log_in($user->id);
      redirect('/index.php');
    } else {

      echo 'Password failed, please try again';
      exit;
    }
  } else {

    echo 'We couldn\'t log you in, please try again';
    exit;
  }
}


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

  <!-- Page Content -->
  <div class="flex-grow container mx-auto">
    <div class="max-w-screen-2xl px-8 mx-auto py-20">

      <!-- Index Header -->
      <div class="grid grid-cols-12 pb-6">
        <div class="col-start-3 col-end-11 col-span-8 flex items-center">
          <h1 class="font-bold text-4xl flex-grow text-center text-emerald-500">Login</h1>
        </div>
      </div>
      <!-- End: Index Header -->

      <!-- Login: Form -->
      <div class="grid grid-cols-12 mt-10">
        <div class="col-start-3 col-end-11 col-span-8">

          <form action="<?php echo get_public_url('/users/login.php'); ?>" method="POST" class="shadow border rounded w-full py-2 px-3 text-gray-700">

            <div class="mb-4">
              <label class="block text-sm font-bold mb-2" for="email">Email</label>
              <input class="shadow border rounded w-full py-2 px-3 text-gray-700" id="email" type="email" name="email">
            </div>

            <div class="mb-4">
              <label class="block text-sm font-bold mb-2" for="password">Password</label>
              <input class="shadow border rounded w-full py-2 px-3 text-gray-700" id="password" type="password" name="password">
            </div>

            <button class="bg-emerald-500 rounded-full py-2 px-4 text-white font-bold" type="submit">Log In</button>

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