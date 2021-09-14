<?php  
    error_reporting(0);
    /**
     * This class creates a object for UserModel class and calls the specified function of the UserModel class.
     */
    class Usercontroller 
    {
        private $user;
        
        /**
         * This method is used to create a object for UserModel class.
         */
        public function __construct()
        {
            $this->user = new UserModel();
        }

        /**
         * This method loads home page on get request.
         * @return null
         */
        public function loadHome() 
        {
            View::load("home");
        }
        
        /**
         * This method loads user page on get request.
         * @return null
         */
        public function loadUser()
        {
            $_SESSION['message'] = "Register/Login to continue!!"; 
            $_SESSION['loggedin'] = 0;
            View::load("user");
        }
        
        /**
         * This method calls loginUser method in UserModel class
         * based on the result it loads the desired
         * view page.
         * @return null
         */
        public function loginUser()
        {
            $result = $this->user -> signIn();
            if($result) {
                $_SESSION['loggedin'] = 1;
                $isActive = $this-> user ->isActiveCheck();
                $cartId = 0;
                foreach($isActive as $i ){
                    $cartId = $i['cart_id'];
                }
                if($cartId != 0) {     
                    $_SESSION['cart_id'] = $cartId ;                   
                    View::load("home");
                } else{
                    View::load("home");
                }
            } else {
                $_SESSION['message'] = "Username or Password is Incorrect!";
                View::load("user");
            }
        }
        
        /**
         * This method calls createUser method in UserModel class
         * based on the result it loads the desired
         * view page and session message.
         * @return null
         */
        public function registerUser() 
        {
            $result = $this->user -> createUser();
            if($result == 1) {
                $_SESSION['message'] = "Registration Successfull! Login to continue!";
            } else if($result == 2) {
                $_SESSION['message'] = "Email already exists!!";
            } else if($result == 3) {
                $_SESSION['message'] = "Username already exists!!";
            } else {
                $_SESSION['message'] = "Enter Valid Details for Registration!";
            }
            View::load("user");
        }
        
        /**
         * This method calls loginCheck method in UserModel class
         * based on the result it loads the desired
         * view page and session message.
         * @return null
         */
        public function loginCheck() 
        {
            if($_SESSION['loggedin']>0 && empty($_SESSION['cart_id']) ) {
            $this -> user = new CartController;
            $createCart = $this-> user-> registerCart();
                if($createCart) {
                    $this -> user = new CartController;
                    $addToCart = $this-> user-> addToCart();
                    if($addToCart) {
                        $_SESSION['message'] = "Product added to cart Successfully!!";
                        View::load("home");
                    }   
                }
            } else {
                $this -> user = new CartController;
                $addToCart = $this-> user-> addToCart();
                if($addToCart) {
                    $_SESSION['message'] = "Product added to cart Successfully!!";
                    View::load("home");
                }
            }
        }
        
        /**
         * This method calls showUserDetails method in UserModel class
         * based on the result it loads the desired
         * view page and session message.
         * @return null
         */
        public function showUserDetails() 
        {
            if($_SESSION['loggedin']>0) {
                View::load("myaccount");
            } else { 
                $_SESSION['message'] = "Register/Login to continue";
                View::load("user");
            }       
        }
        
        /**
         * This method calls updatePassword method in UserModel class
         *@return boolean type of the result.
         */
        public function updatePassword()
        {
            $updatePassword = $this->user -> updatePassword();
            return $updatePassword;
        }
        
        /**
         * This method calls updateAddress method in UserModel class
         *@return boolean type of the result.
         */
        public function updateAddress()
        {
            $updateAddress = $this->user -> updateAddress();
            return $updateAddress;
        }
        
        /**
         * This method calls userLogout method in UserModel class
         * based on the result it loads the desired
         * view page and session message.
         * @return null
         */
        public function userLogout() 
        {
            if($_SESSION['loggedin']>0) {
                unset($_SESSION['loggedin']);
                unset($_SESSION['cart_id']);
                unset($_SESSION['isActive']);
                unset($_SESSION['user_id']);
                View::load("home");
            } else { 
                $_SESSION['message'] = "Register/Login to continue";
                View::load("user");
            }       
        }
    }
    