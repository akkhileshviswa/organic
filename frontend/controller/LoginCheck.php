<?php 
    include "../autoload/autoload.php";
    session_start();
    class LoginCheck {
        public $login;
        public function __construct() {
            $this->login = new Userlogin();
        } 
        public function loginCheck() {
            $result = $this->login -> signIn();
            if($result) {
                $_SESSION['loggedin']=1;
                header("Location: ../view/home.php");
            }
            else { 
                $_SESSION['message'] = "Register/Login to continue";
                header("Location: ../view/user.php");
            }
        }
    }
