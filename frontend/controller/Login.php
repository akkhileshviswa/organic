<?php 
    //include "../autoload/autoload.php";
    session_start();
    class Login {
        public $login;
        public function __construct() {
            $this-> loginUser();
        } 
        public function loginUser() {
            $this->login = new Userlogin();
            $result = $this->login -> signIn();
            if($result) {
                $_SESSION['loggedin']=1;
                header("Location: ../view/");
            }
            else {
                $_SESSION['message'] = "Username or Password is incorrect";
                header("Location: ../view/user.php");
            }
        }
    }
    