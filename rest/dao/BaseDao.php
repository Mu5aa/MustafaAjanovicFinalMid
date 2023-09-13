<?php

class BaseDao {

    protected $conn;

    /**
    * constructor of dao class
    */
    public function __construct(){
        try {

        /** TODO
        * List parameters such as servername, username, password, schema. Make sure to use appropriate port
        */
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $schema = 'midterm_exam';
        $port = 3306;


        $this->conn = new PDO("mysql:host=$servername;dbname=$schema;port=$port" , $username, $password);


        /** TODO
        * Create new connection
        */

        // set the PDO error mode to exception
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          echo "Connected successfully";
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }
    }

}
?>
