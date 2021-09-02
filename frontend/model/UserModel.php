<?php 
	error_reporting(0);
	/**
	 * This class insert, fetches, delete, update the values in database upon calling the specified function.
	 */
	class UserModel 
	{
		private $instance;
        
        /**
         * This method is used to create a object for Database class.
         */
        public function __construct()
        {
            $this->instance = Database::getInstance();
        }

		/**
         * This method is used to register the user based on the details provided,
		 * @return boolean of the result.
         */
		public function createUser() 
		{
			if($_SERVER['REQUEST_METHOD'] == "POST") {	
				$connection = $this->instance->getConnection();
				$name = trim($_POST['name']);
				$email = trim($_POST['email']);
				$password = trim($_POST['password']);
				$mdpassword = md5($password);
				if(!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($mdpassword)) {
					try {
							$statement =  $connection->prepare("INSERT INTO users (username,email,password) 
														VALUES (:name, :email, :mdpassword)");
							$statement->bindParam(':name', $name);
							$statement->bindParam(':email', $email);
							$statement->bindParam(':mdpassword', $mdpassword);
							$result = $statement->execute();
							if(!$result) {
								throw new Exception("Error in inserting user");
							} else {
								return true;    
							}
					} catch(Exception $e) {
						throw "Message: " .$e->getMessage();
					}	
				} else {
					return false;
				}
			} 
		}
		
		/**
         * This method is used to sign in the user based on the details provided,
		 * @return boolean of the result.
         */
		public function signIn()
		{
			if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['loginname'] != "" && $_POST['loginpassword'] != "" ) {
				$connection = $this->instance->getConnection();
				$name = trim($_POST['loginname']);
				$password = trim($_POST['loginpassword']);
				$mdpassword = md5($password);
				try {
						$result = $connection->query("SELECT * FROM users WHERE username = '$name' AND password = '$mdpassword';");
						if(!$result) {
							throw new Exception("Error in Selecting the user.");
						}
				} catch(Exception $e) {
					throw "Message: " .$e->getMessage();
				}
				$row = $result->fetch();
				if($row['username'] == $name && $row['password'] === $mdpassword) {
					$_SESSION['user_id'] = $row['user_id'];
					return true;
				} else {
					return false;
				}	
            }
        }
		
		/**
         * This method is used to get the password of the current user,
		 * @return object of the result.
         */
		public function getPassword()
		{
			$connection = $this->instance->getConnection();
			$user_id = $_SESSION['user_id'];
			try {
					$result = $connection->query("SELECT password FROM users WHERE user_id = $user_id;");
					if(!$result) {
						throw new Exception("Error in Selecting the password");
					} else {
						return $result;
					}
			} catch(Exception $e) {
				throw "Message: " .$e->getMessage();
			}
		}
		
		/**
         * This method is used to update the password of the current user.
         */
		public function updatePassword()
		{
			$connection = $this->instance->getConnection();
			$user_id = $_SESSION['user_id'];
			$password = trim($_POST['password']);
			$mdpassword = md5($password);
			try {
					$statement = $connection->prepare("UPDATE users SET password = :mdpassword WHERE user_id = $user_id;");
					$statement->bindParam(':mdpassword', $mdpassword);
					$result = $statement->execute();
					if(!$result) {
						throw new Exception("Error in updating the user details");
					}
			} catch(Exception $e) {
				throw "Message: " .$e->getMessage();
			}
		}
		
		/**
         * This method is used to update the address of the current user.
         */
		public function updateAddress()
		{
			$connection = $this->instance->getConnection();
			$userId = $_SESSION['user_id'];
			$address = trim($_POST['address']);
			try {
					$statement = $connection->prepare("UPDATE checkout SET address = :address WHERE user_id = $userId;");
					$statement->bindParam(':address', $address);
					$result = $statement->execute();
					if(!$result) {
						throw new Exception("Error in updating the user details");
					}
			} catch(Exception $e) {
				throw "Message: " .$e->getMessage();
			}
		}
	}
	