<?php 

// Most of these functions were provided as part of the starter files and are very useful for the application, thank you. 

//The database connection has been included at the bottom of the file, which is connecting by calling the MySQLi Class and creating a new instance of it with the received access credentials. 

// User-Defined Functions
function get_public_url($path = "") {
    if($path[0] != '/') {
        $path = '/' . $path;
    }
    return WWW_ROOT . '/public' . $path;
}

function get_path($path = "") {
    if ($path != "") {
        if($path[0] != '/') {
        $path = '/' . $path;
    }
}
    return PROJECT_ROOT . $path;
}

function redirect($path) {
    header('Location: ' . get_public_url($path) );
}

function h($str) {
    return htmlspecialchars($str);
}

function u($string) {
    return urlencode($string);
}

// Prints out human readable data wrapped in <pre> tags, for debugging
function wrap_pre($data) {
    return '<pre>' . print_r($data,true) . '</pre>';
}

// Prints out human readable data, and prevents the script from continuing
function dd($data) {
    echo wrap_pre($data);
    die();
}

// Function that makes use of the $_SERVER superglobal, (an relational array with information about the application paths) to determine if the requested method was "POST" and returns true
function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] === "POST";
}

// Database Connection
function db_connect(){
    $host = DB_HOST;
    $username = DB_USER;
    $password = DB_PASS;
    $db_name =  DB_NAME;

    $db = new mysqli($host, $username, $password, $db_name);

    if($db->connect_errno) {
        echo "Failed to connect to MySQL: " . $db -> connect_error;
        exit();
    }

    return $db;
}
