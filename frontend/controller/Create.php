<?php 
    include "../autoload/autoload.php";
    session_start();
    class Create {
        public $create;
        public function __construct() {
            $this->create = new NewUser();
        }
        public function user() {
            $result = $this->create -> createUser();
            if($result) {
                $_SESSION['message'] = "Registration Successfull! Login to continue!";
                header("Location: ../view/user.php");
            }
            else {
                $_SESSION['message'] = "Enter Valid Details for Registration";
                header("Location: ../view/user.php");
            }
        }
    }
    