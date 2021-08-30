<?php 
	error_reporting(0);
	/**
	 * This class insert, fetches, delete, update the values in database upon calling the specified function.
	 */
	class UserModel 
	{
		private $connect;
		/**
         * This method is used to create a object for Database class.
         */
        public function __construct()
		{
            $this->connect = new Database;
        }
		/**
         * This method is used to register the user based on the details provided,
		 * @return boolean of the result.
         */
		public function createUser() 
		{
			if($_SERVER['REQUEST_METHOD'] == "POST") {	
				$connection = $this->connect->getConnection();
				$name = trim($_POST['name']);
				$email = trim($_POST['email']);
				$password = trim($_POST['password']);
				if(!empty($name) && !empty($email) && !empty($password)) {
					try {
						$result =  $connection->query("INSERT INTO users (username,email,password) 
													   VALUES ('$name','$email','$password')");
						if(!$result) {
							return false;
							throw new Exception("Error in inserting user");
						} else {
							return true;    
						}
					} catch(Exception $e) {
						echo "Message: " .$e->getMessage();
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
			if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['loginname']!="" && $_POST['loginpassword']!="" ) {
				$connection = $this->connect->getConnection();
				$name = trim($_POST['loginname']);
				$password = trim($_POST['loginpassword']);
				try {
					$result = $connection->query("SELECT * FROM users WHERE username = '$name' AND password = '$password'");
					if(!$result) {
						throw new Exception("Error in Selecting the user.");
					}
				} catch(Exception $e) {
					echo "Message: " .$e->getMessage();
				}
				$row = $result->fetch();
				if($row['username']==$name && $row['password']==$password) {
					$_SESSION['user_id']=$row['user_id'];
					return true;
				} else {
					return false;
				}	
            }
        }
		/**
         * This method is used to get the password of the current user,
		 * @return string of the result.
         */
		public function getPassword()
		{
			$connection = $this->connect->getConnection();
			$user_id = $_SESSION['user_id'];
			try {
				$result = $connection->query("SELECT password FROM users WHERE user_id = $user_id;");
				if(!$result) {
					throw new Exception("Error in Selecting the password");
				} else {
					return $result;
				}
			} catch(Exception $e) {
				echo "Message: " .$e->getMessage();
			}
		}
		/**
         * This method is used to update the password of the current user.
         */
		public function updatePassword()
		{
			$connection = $this->connect->getConnection();
			$user_id = $_SESSION['user_id'];
			$password = trim($_POST['password']);
			try {
				$result = $connection->query("UPDATE users SET password = '$password' WHERE user_id = $user_id;");
				if(!$result) {
					throw new Exception("Error in updating the user details");
				}
			} catch(Exception $e) {
				echo "Message: " .$e->getMessage();
			}
		}
		/**
         * This method is used to update the address of the current user.
         */
		public function updateAddress()
		{
			$connection = $this->connect->getConnection();
			$user_id = $_SESSION['user_id'];
			$address = trim($_POST['address']);
			try {
				$result = $connection->query("UPDATE checkout SET address = '$address' WHERE user_id = $user_id;");
				if(!$result) {
					throw new Exception("Error in updating the user details");
				}
			} catch(Exception $e) {
				echo "Message: " .$e->getMessage();
			}
		}
		/**
         * This method is used to logout the current user.
         */
		public function logout()
		{
			$connection = $this->connect->getConnection();
			$is_active = intval(0);
			$cart_id = $_SESSION['cart_id'];
			try {
				$result =  $connection->query("UPDATE cart SET is_active = $is_active WHERE cart_id = $cart_id;");
				if(!$result) {
					throw new Exception("Error in updating the user details");
				}
			} catch(Exception $e) {
				echo "Message: " .$e->getMessage();
			}	
		}
	}
	