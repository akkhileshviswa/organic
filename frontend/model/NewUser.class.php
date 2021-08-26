<?php 
	class NewUser {
		private $connect;
        public function __construct(){
            $this->connect = new connection;
        }
		public function createUser() 
		{
			if($_SERVER['REQUEST_METHOD'] == "POST")
			{	
				$connection = $this->connect->getConnection();
				$name = trim($_POST['name']);
				$email = trim($_POST['email']);
				$password = trim($_POST['password']);
				if(!empty($name) && !empty($email) && !empty($password))
				{
					try{
						$result =  $connection->query("INSERT INTO users (username,email,password) VALUES ('$name','$email','$password')");
						if(!$result){
							return false;
							throw new Exception("Error in inserting user");
						}else {
							return true;    
						}
					}catch(Exception $e){
						echo "Message: " .$e->getMessage();
					}	
				}
				else
				{
					return false;
				}
			} 
		}
	}
	