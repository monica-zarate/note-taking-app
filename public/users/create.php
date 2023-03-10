<?php

// This page gets displayed when the user wants to register to make use of the note-taking app.
// The init file is being required in order to access the app's functions, constants and database connection.

// The Create part of the CRUD functionality is initiated on this page.

// We are creating a new user via the User Class, if the creation was successful, the user will be redirected to the login page. In case there's an error, we will echo "Fail" on the browser, to provide basic feedback to the user to let them know something went wrong

require('../../app/init.php');

if (is_post_request()) {

  $user = new User($_POST);
  $result = $user->create();

  if ($result) {
    redirect('/users/login.php');
  } else {
    echo 'Fail';
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
      <div class="grid grid-cols-12 pb-6">
        <div class="col-start-3 col-end-11 col-span-8 flex items-center">
          <h1 class="font-bold text-4xl flex-grow text-center text-emerald-500">Sign Up</h1>
        </div>
      </div>
      <!-- End: Index Header -->

      <!-- Create: Form -->
      <div class="grid grid-cols-12 mt-10">
        <div class="col-start-3 col-end-11 col-span-8 grid justify-items-center">

          <form action="<?php echo get_public_url('/users/create.php'); ?>" method="POST" class="shadow border rounded-3xl w-full max-w-2xl pt-20 pb-11 px-24 mb-44 text-gray-700">

            <div class="flex justify-between mb-9">
              <div>
                <label class="block text-sm font-bold mb-2" for="user_firstname">First Name<span class="text-red-500">*</span></label>
                <input class="border rounded w-full py-2 px-3 text-gray-700" id="user_firstname" type="text" name="first_name">
              </div>
              <div>
                <label class="block text-sm font-bold mb-2" for="user_lastname">Last Name<span class="text-red-500">*</span></label>
                <input class="border rounded w-full py-2 px-3 text-gray-700" id="user_lastname" type="text" name="last_name">
              </div>
            </div>

            <div class="flex justify-between mb-9">
              <div>
                <label class="block text-sm font-bold mb-2" for="user_name">User Name</label>
                <input class="border rounded w-full py-2 px-3 text-gray-700" id="user_name" type="text" name="username">
              </div>
              <div>
                <label class="block text-sm font-bold mb-2" for="user_dob">Date of Birth<span class="text-red-500">*</span></label>
                <input class="border rounded w-full py-2 px-3 text-gray-700" id="user_dob" type="text" name="dob" placeholder="YYYY,MM,DD">
              </div>
            </div>

            <div class="mb-9">
              <label class="block text-sm font-bold mb-2" for="user_email">Email<span class="text-red-500">*</span></label>
              <input class="border rounded w-full py-2 px-3 text-gray-700" id="user_email" type="email" name="email">
            </div>

            <div class="flex justify-between mb-9">
              <div>
                <label class="block text-sm font-bold mb-2" for="user_password">Password<span class="text-red-500">*</span></label>
                <input class="border rounded w-full py-2 px-3 text-gray-700" id="user_password" type="password" name="password">
              </div>
              <div>
                <label class="block text-sm font-bold mb-2" for="user_password2">Re-type Password<span class="text-red-500">*</span></label>
                <input class="border rounded w-full py-2 px-3 text-gray-700" id="user_password2" type="password" name="password2">
              </div>
            </div>

            <div class="flex justify-between mb-9">
              <div class="w-52">
                <label class="block text-sm font-bold mb-2" for="user_country">Country<span class="text-red-500">*</span></label>
                <select class="border rounded w-full py-2 px-3 text-gray-700" name="country" id="user_country">
                  <option value=""></option>
                  <option value="Mongolia">Mongolia</option>
                  <option value="India">India</option>
                  <option value="Canada">Canada</option>
                  <option value="USA">USA</option>
                  <option value="Mexico">Mexico</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-bold mb-2" for="user_phone">Phone<span class="text-red-500">*</span></label>
                <input class="border rounded w-full py-2 px-3 text-gray-700" id="user_phone" type="tel" name="phone">
              </div>
            </div>

            <div class="mb-9">
              <label class="block text-sm font-bold mb-2" for="user_interests">Interests</label>
              <input class="border rounded w-full py-2 px-3 text-gray-700" id="user_interests" type="text" name="interests">
            </div>

            <div class="flex flex-col items-center">
              <button class="bg-emerald-500 rounded-2xl py-3 px-5 mt-14 text-white font-bold" type="submit">Sign Up</button>

              <div class="mt-8">
                <span class="text-neutral-400">Already have an Account?</span>
                <a class="inline-block py-2 no-underline font-bold text-emerald-500 mr-5" href="<?php echo get_public_url('/users/login.php'); ?>">Log In</a>
              </div>
            </div>

          </form>

        </div>
      </div>

    </div>
  </div>
  <!-- End Create Form -->

  </div>
  </div>
  <!-- End: Page Content -->

  <!-- Global Footer -->
  <?php include(get_path('public/partials/footer.php')); ?>

</body>

</html>