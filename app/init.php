<?php 

    // The constants and files placed on this init file will be accessed throughout the application.
    // It's important to define the database constants, so the db_connect() and set_db() methods can be called. This last one we're able to access because we have included the Note, User and Session Classes by making use of the require() built-in function.

    // For this iteration of the project, I am creating a variable called $session, which gets initialized by creating a new instance of the Session Class.

    // After the experience I had during the final exam, I decided not to change the db's username or password, I know it was part of the feedback I'd received previously but I didn't wanted to risk it =( I'm planning to practice during the break so that I'm able to do it with confidence.
    
    // Constants
    define('WWW_ROOT', 'http://localhost');
    define('PROJECT_ROOT', dirname(__DIR__, 1));

    // Database Constants
    define('DB_HOST',  'localhost');
    define('DB_USER',  'root');
    define('DB_PASS',  'root');
    define('DB_NAME',  'notes_app');

    // Functions
    require('functions.php');

    // Classes
    require(get_path('/app/classes/Note.php'));
    require(get_path('/app/classes/User.php'));
    require(get_path('/app/classes/Session.php'));

    // Database connection
    $db = db_connect();

    // Setting the database for the Note and User Class
    Note::set_db($db);
    User::set_db($db);

    // Init Session
    $session = new Session(); 