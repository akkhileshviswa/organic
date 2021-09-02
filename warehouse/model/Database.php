<?php
	/**
    * This class connects to the database and returns the object when called.
    */
	class Database
	{
		const dbhost = "localhost";
		const dbuser = "root";
		const dbpass = "";
		const databasename = "warehouse";

		/**
		 * This method connects to the warehouse database for the provided details.
		 */
		public function getConnectionToWarehouse() 
		{
			try {
				$connect = new mysqli(self::dbhost,self::dbuser,self::dbpass,self::databasename);
				if(!$connect) {
					throw new Exception("Error in Connecting to server");
				} else {
					return $connect;    
				}
			} catch(Exception $e) {
				throw "Message: " .$e->getMessage();
			}	
		}
	}