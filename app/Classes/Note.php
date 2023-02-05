<?php

    // The Note-taking app is making use of this Note Class to create a Note every time the user fills out a form. The Class also contains static methods and has the ability to define the database we'll use for the CRUD functionality.

    // The constructor method helps us assign the correct arguments received as the object's properties. If a property is not received, the constructor will set its value as null using the null coalescing operator.

    class Note {

        // Properties
        //Static properties can only be accessed inside of the class. They're accessed using the scope resolution operator "::" instead of the object operator "->" as public properties do.
        static protected $db;

        // Public
        public $id;
        public $name;
        public $body;
        public $course_number;
        public $user_id;


        // Static Methods: Since these methods can be called directly without necessarily initiating an instance of the class, the use of the "self" keyword is replacing "this".

        // Set the database
        static public function set_db($db) {
            self::$db = $db;
        }

        // Most of the CRUD functions bellow, (except for find_all), are creating a $sql variable, (with local scope inside of the function), to declare the sql query we want to send to the database to complete the functionality each function is trying to achieve.

        // For the find_all() and the find_by_id() functions, the queries "Select *" is referring to selecting all data and "FROM notes" is asking for a specific database table called "notes". We're also passing the note's id as part of the query if needed. We are calling the prepare() method that belongs to the mysqli Class, which is initiating a sql query. By making use of the bind_params() method, we're letting the query know the type of variable each value will be, and the actual values as parameters. This has been implemented as a security measure to prevent against any undesired sql injections to our database. The execute function will run the query and the function returns the result of the note creation which in this case it's the id of the note.

        // Find All Notes (Read)
        static public function find_all($user_id) {

            $sql = "SELECT * FROM notes WHERE user_id=?";

            $stmt = self::$db->prepare($sql);
            $stmt->bind_param('i', $user_id);

            $stmt->execute();

            $result = $stmt->get_result();

            return $result;

        }

        // Find entry by id
        static public function find_by_id($id, $user_id) {

            $sql = "SELECT * FROM notes WHERE id='{$id}' AND user_id='{$user_id}'";

            $result = self::$db->query($sql);

            // fetch_assoc() is a mysqli class method returns each row of the results set as an associative array. This is helpful because we are building our Note objects the same way. 
            return $result->fetch_assoc();

        }

        // Methods
        //Constructor: this method will allow us to create instances of the class, and it's expecting to receive an associative array as arguments. The constructor assign the received properties accordingly. In case of them is not present, the constructor will give it a null value using the null coalescing operator. 
         
        public function __construct($args) {
            $this->id = $args['id'] ?? null;
            $this->name = $args['name'] ?? null;
            $this->body = $args['body'] ?? null;
            $this->course_number = $args['course_number'] ?? null;
            $this->user_id = $args['user_id'] ?? '';
        }

        // In order to create or edit a database entry, we must include the new or updated properties for each note. In the case of the Note-taking app we're passing the name, body and course_number of each note, it's important to do so in the order the properties were declared, to prevent any data mix-up.
        // Create Note
        public function create() {
            $sql = "INSERT INTO notes (name, body, course_number, user_id) VALUES";
            $sql .= "('{$this->name}', '{$this->body}', '{$this->course_number}', '{$this->user_id}')";

            $result = self::$db->query($sql);

            return $result;
        }

        // Edit Note
        public function update() {
            // "LIMIT 1" is also used here to make sure we're only affecting one entry.
            $sql = "UPDATE notes SET name='{$this->name}', body='{$this->body}', course_number='{$this->course_number}' WHERE id='{$this->id}' AND user_id='{$this->user_id}' LIMIT 1";

            $result = self::$db->query($sql);

            return $result;
        }

        // Delete Note
        public function delete() {
            // The use of "DELETE" on the sql query will remove all records and data associated with the entry's id we are including. The use of "LIMIT 1" is a way we protect the data by asking the database to only delete one entry. In case the deletion was a mistake or the wrong arguments were passed, we'd only be missing one record, and we'd prevent more records or in extreme cases, the whole database to be deleted.
            $sql = "DELETE FROM notes WHERE id='{$this->id}' AND user_id='{$this->user_id}' LIMIT 1";

            $result = self::$db->query($sql);

            return $result;
        }

    }