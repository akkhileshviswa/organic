<?php

    /**
     * This class connects to the database and returns the object when called.
     */
    class Database {
        private $connection;
        private static $instance;
        const dbhost = "localhost";
        const dbuser = "root";
        const dbpass = "root"; 
        const dbname = "organic"; 
      
        /**
		 * This method connects to the database for the provided details.
		 */
        private function __construct() {
            try {
                $this->connection = new PDO('mysql:host='.self::dbhost.';dbname='.self::dbname, self::dbuser, self::dbpass);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                die("Failed to connect to database: ". $e->getMessage());
            }
        }
        
        /**
         * This method returns the instance of the current class.
         */
        public static function getInstance() {
            if (!self::$instance) {
                    self::$instance = new Database();
                }
            return self::$instance;
        }

        /**
         * This method returns the object of the connection.
         */
        public function getConnection() {
            return $this->connection;
        }
    }
