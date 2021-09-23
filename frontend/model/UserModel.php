<?php 
	
	/**
	 * This class insert, fetches, delete, update the values in database upon calling the specified function.
	 */
	class UserModel 
	{
		private $instance;
        private $session;

        /**
         * This method is used to create a object for Database class.
         */
        public function __construct()
        {
            $this->instance = Database::getInstance();
			$this->session = SessionId::session();
        }

		/**
         * This method is used to register the user based on the details provided,
		 * @return integer of the result.
         */
		public function createUser() 
		{
			if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) {	
				$connection = $this->instance->getConnection();
				$name = trim($_POST['name']);
				$email = trim($_POST['email']);
				$password = trim($_POST['password']);
				$mdPassword = md5($password);
				if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($mdPassword)) {	
					$result = $connection->prepare("SELECT * FROM users WHERE username = :name ;");
					$result->bindParam(':name', $name);
					$result->execute();
					$row = $result->fetch();
					if ($row['username'] == $name) {
						return 3;
					}
					$statement =  $connection->prepare("INSERT INTO users (username,email,password) 
														VALUES (:name, :email, :mdPassword)");
					$statement->bindParam(':name', $name);
					$statement->bindParam(':email', $email);
					$statement->bindParam(':mdPassword', $mdPassword);
					try {
						$statement->execute();
						//$to = $email;
						$to = "akkhilesh24@gmail.com";
						$subject = "Registration In Organici - Reg";
						$body = "You have successfully registered in Organici!! Happy Shopping!!";
						$headers = "From: \Organici";
						mail($to, $subject, $body, $headers);
						return 1;
					} catch (PDOException $e) {
						if ($e->errorInfo[1] == 1062) {
							return 2;
						}
					}
				} else {
					return 0;
				}
			} else {
				return false;
			}	
		}
		
		/**
         * This method is used to sign in the user based on the details provided,
		 * @return boolean of the result.
         */
		public function signIn()
		{
			if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['loginname']) && !empty($_POST['loginpassword'])) {
				$connection = $this->instance->getConnection();
				$name = trim($_POST['loginname']);
				$password = trim($_POST['loginpassword']);
				$mdPassword = md5($password);
				try {
					$result = $connection->prepare("SELECT * FROM users WHERE username = :name AND password = :mdPassword;");
					$result->bindParam(':name', $name);
					$result->bindParam(':mdPassword', $mdPassword);
					$result->execute();
					if (!$result) {
						throw new Exception("Error in Selecting the user.");
					}
				} catch(Exception $e) {
					throw "Message: " .$e->getMessage();
				}
				$row = $result->fetch();
				if ($row['username'] == $name && $row['password'] == $mdPassword) {
					$_SESSION['user_id'] = $row['user_id'];
					return true;
				} else {
					return false;
				}	
            } else {
				return false;
			}	
        }

		/**
         * This method is used to check if the user has already has a cart,
		 * @return object of the result.
         */
		public function isActiveCheck()
		{
			if (isset($_SESSION['user_id'])) {
				$connection = $this->instance->getConnection();
				$userId = $_SESSION['user_id'];
				$isActive = intval(1);
				try {
					$result = $connection->prepare("SELECT cart_id FROM cart WHERE user_id = :userId AND is_active = :isActive;");
					$result->bindParam(':userId', $userId);
					$result->bindParam(':isActive', $isActive);
					$result->execute();
					if (!$result) {
						throw new Exception("Error in Selecting the password");
					} else {
						return $result;
					}
				} catch(Exception $e) {
					throw "Message: " .$e->getMessage();
				}
			} else {
				return false;
			}
		}
		
		/**
         * This method is used to get the password of the current user,
		 * @return object of the result.
         */
		public function getPassword()
		{
			if (isset($_SESSION['user_id'])) {
				$connection = $this->instance->getConnection();
				$userId = $this->session['userId'];
				try {
					$result = $connection->prepare("SELECT password FROM users WHERE user_id = :userId;");
					$result->bindParam(':userId', $userId);
					$result->execute();
					if (!$result) {
						throw new Exception("Error in Selecting the password");
					} else {
						return $result;
					}
				} catch(Exception $e) {
					throw "Message: " .$e->getMessage();
				}
			} else {
				return false;
			}
		}
		
		/**
         * This method is used to update the password of the current user.
		 * @return null
         */
		public function updatePassword()
		{
			if (isset($_SESSION['user_id']) && !empty($_POST['password'])) {
				$connection = $this->instance->getConnection();
				$userId = $this->session['userId'];
				$password = trim($_POST['password']);
				$mdPassword = md5($password);
				try {
					$statement = $connection->prepare("UPDATE users SET password = :mdPassword WHERE user_id = :userId;");
					$statement->bindParam(':mdPassword', $mdPassword);
					$statement->bindParam(':userId', $userId);
					$result = $statement->execute();
					if (!$result) {
						throw new Exception("Error in updating the user details");
					}
				} catch(Exception $e) {
					throw "Message: " .$e->getMessage();
				}
			} else {
				return false;
			}
		}
		
		/**
         * This method is used to update the address of the current user.
		 * @return null
         */
		public function updateAddress()
		{
			if (isset($_SESSION['user_id']) && !empty($_POST['address'])) {
				$connection = $this->instance->getConnection();
				$userId = $this->session['userId'];
				$address = trim($_POST['address']);
				try {
					$statement = $connection->prepare("UPDATE checkout SET address = :address WHERE user_id = :userId;");
					$statement->bindParam(':address', $address);
					$statement->bindParam(':userId', $userId);
					$result = $statement->execute();
					if (!$result) {
						throw new Exception("Error in updating the user details");
					}
				} catch(Exception $e) {
					throw "Message: " .$e->getMessage();
				}
			} else {
				return false;
			}
		}
	}
	