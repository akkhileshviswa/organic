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
			return new mysqli(self::dbhost,self::dbuser,self::dbpass,self::dbname);			
		}
	}