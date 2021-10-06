<?php
	/**
    * This class connects to the database and returns the object when called.
    */
	class Database
	{
		const dbhost = "localhost";
		const dbuser = "root";
		const dbpass = "root";
		const dbname = "organic";
		/**
		 * This method connects to the database for the provided details.
		 */
		public function getConnection() 
		{
			try {
				$connect = new mysqli(self::dbhost,self::dbuser,self::dbpass,self::dbname);
				if(!$connect) {
					return false;
					throw new Exception("Error in Connecting to server");
				} else {
					return $connect;    
				}
			} catch(Exception $e) {
				throw "Message: " .$e->getMessage();
			}	
		}
	}