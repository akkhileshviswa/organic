<?php 
	session_start();
	class Userlogin {
		private $connect;
        public function __construct(){
            $this->connect = new connection;
        }
		public function signIn()
		{
			if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['loginname']!="" && $_POST['loginpassword']!="" )
			{
				$connection = $this->connect->getConnection();
				$name = trim($_POST['loginname']);
				$password = trim($_POST['loginpassword']);
				
				try{
					$result = $connection->query("SELECT * FROM users WHERE username = '$name' AND password = '$password'");
					if(!$result){
						throw new Exception("Error in Selecting");
					}
				}catch(Exception $e){
					echo "Message: " .$e->getMessage();
				}
				$row = $result->fetch();
				if($row['username']==$name && $row['password']==$password){
					$_SESSION['user_id']=$row['user_id'];
					return true;
				}
				else {
					return false;
				}	
            }
        }
	}
	