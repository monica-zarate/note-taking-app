<?php

// This iteration of the project, includes this new Session class, because we learned to implement the session_start() php built-in method, which is a way we use to store data on the server in form of key value pairs. Sessions are more secure than cookies, but they will expire once the browser is closed and we need to initialize them before any content is returned (we're doing that on the init.php file by creating a new instance of this class). All that because we are now implementing a login functionality and we want to be able to keep the user logged in as they navigate the site, without having to enter their credentials to view every one of the pages.
class Session
{
    // Properties
    // Public
    public $user_id;
    public $errors = [];

    // The constructor for this class will call the session_start() method and assign the user id making use of the $_SESSION super global, in case we don't have one, the user_id will be defined as null, and the user won't be able to access the application
    public function __construct()
    {
        session_start();
        $this->user_id = $_SESSION['user_id'] ?? null;
    }

    // Login function that receives an id, calls on the session_regenerate_id() built in method to update the current session for the correct user as we receive their id 
    public function log_in($id)
    {
        session_regenerate_id();
        $this->user_id = $id;
        $_SESSION['user_id'] = $this->user_id;

        return true;
    }

    // Logout function will call the unset() method that destroys the variable it's receiving as an argument, in this case the user id for the class and the session

    public function log_out()
    {
        unset($this->user_id);
        unset($_SESSION['user_id']);

        return true;
    }

    // get_user_id will let us know the current user id the object we've initiate from this class currently value is

    public function get_user_id()
    {
        return $this->user_id;
    }

    // is_logged_in will call the get_user_id previous function, if the value is null, meaning there is not currently a user id defined, the app will navigate to the login page.

    public function is_logged_in() 
    {
        if (is_null($this->get_user_id())) {
            redirect('/users/login.php');
        } else {
            return true;
        }
    }

}
