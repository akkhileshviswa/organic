<?php
/*
* Mysql database class - only one connection alowed
*/
    class connection {
        private $connection;
        private static $_instance;
        private $dbhost = "localhost";
        private $dbuser = "root";
        private $dbpass = ""; 
        private $dbname = "organic"; 

        public static function getInstance(){
            if(!self::$_instance) {
                    self::$_instance = new self();
                }
                return self::$_instance;
        }

        function __construct() {
            try{
                $this->connection = new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname, $this->dbuser, $this->dbpass);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                die("Failed to connect to database: ". $e->getMessage());
            }
        }

        private function __clone(){} 
          
        public function getConnection(){
            return $this->connection;
        }
    }
