<?php 

    // The Note-taking app is making use of this User Class to create a User every time the user fills out a form on the signup page. The Class also contains static methods and has the ability to define the database we'll use for the CRUD functionality.

    // The constructor method helps us assign the correct arguments received as the object's properties. If a property is not received, the constructor will set its value as null using the null coalescing operator.

    class User {

        // Properties
        //Static properties can only be accessed inside of the class. They're accessed using the scope resolution operator "::" instead of the object operator "->" as public properties do.
        static protected $db;

        // Public
        public $id;
        public $username;
        public $email;
        public $password;
        public $first_name;
        public $last_name;
        public $dob;
        public $county;
        public $phone;
        public $interests;

        // Static Methods: Since these methods can be called directly without necessarily initiating an instance of the class, the use of the "self" keyword is replacing "this".

        // Set the database
        static public function set_db($db) {
            self::$db = $db;
        }

        // The create() function is making use of the prepare() method that belongs to the mysqli Class, which I understood as an initiator for a sql query that we will create. We're then making use of the password_hash php built-in method, that accepts the password string and the algorithm we want to use to hash the password, in this case PASSWORD_DEFAULT. By making use of the bind_params() method, we're following up on the query we started to create earlier, and we're passing two params, one is the type of variable each value will be, and the actual values, here we're already passing a hashed password. This has been implemented as a security measure to prevent against any undesired sql injections to our database. The execute function will run the query and the function returns the result of the user creation which in this case it's their id.

        public function create() {
            $sql = "INSERT INTO users (username, email, password, first_name, last_name, dob, country, phone, interests) VALUES (?,?,?,?,?,?,?,?,?)";

            $stmt = self::$db->prepare($sql);

            $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
            $stmt->bind_param('sssssssss', $this->username, $this->email, $hashed_password, $this->first_name, $this->last_name, $this->dob, $this->country, $this->phone, $this->interests);

            $stmt->execute();

            $result = $stmt->insert_id;

            return $result;            
        }

        // For the find_user_by_email() the queries "Select *" is referring to selecting all data and "FROM users" is asking for a specific database table called "users". We're also passing the user's email as part of the query.

        static public function find_user_by_email($email) {
	 
            $sql = "SELECT * FROM users ";
            $sql .= "WHERE email='" . $email . "'";
 
            $result = self::$db->query($sql);
 
            return $result;
 
        }

        // The  validate_password() method receives the password the user's entered and then calls the password_verify() built in function a
        public function validate_password($provided_password) {
            return password_verify($provided_password, $this->password);
        }

        //Constructor: this method will allow us to create instances of the class, and it's expecting to receive an associative array as arguments. The constructor assign the received properties accordingly. In case of them is not present, the constructor will give it a null value using the null coalescing operator. 

        public function __construct($args = []) {
            $this->id = $args['id'] ?? null;
            $this->email = $args['email'] ?? null;
            $this->password = $args['password'] ?? null;
            $this->username = $args['username'] ?? null;
            $this->first_name = $args['first_name'] ?? null;
            $this->last_name = $args['last_name'] ?? null;
            $this->dob = $args['dob'] ?? null;
            $this->country = $args['country'] ?? null;
            $this->phone = $args['phone'] ?? null;
            $this->interests = $args['interests'] ?? null;
        }

    }

?>