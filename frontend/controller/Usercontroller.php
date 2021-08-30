<?php  
    /**
     * This class creates a object for UserModel class and calls the specified function of the UserModel class.
     */
    class Usercontroller 
    {
        private $user;
        /**
         * This method loads home page on get request.
         */
        public function loadHome() 
        {
            View::load("home");
        }
        /**
         * This method loads user page on get request.
         */
        public function loadUser()
        {
            View::load("user");
        }
        /**
         * This method calls loginUser method in UserModel class
         * based on the result it loads the desired
         * view page.
         */
        public function loginUser()
        {
            $this->user = new UserModel();
            $result = $this->user -> signIn();
            if($result) {
                $_SESSION['loggedin']=1;
                $this -> user = new CartController;
                $createCart = $this-> user-> registerCart();
                if($createCart) {
                    View::load("home");
                }
            } else {
                $_SESSION['message'] = "Register/Login to continue";
                View::load("user");
            }
        }
        /**
         * This method calls createUser method in UserModel class
         * based on the result it loads the desired
         * view page and session message.
         */
        public function registerUser() 
        {
            $this->user = new UserModel();
            $result = $this->user -> createUser();
            if($result) {
                $_SESSION['message'] = "Registration Successfull! Login to continue!";
                View::load("user");
            } else {
                $_SESSION['message'] = "Enter Valid Details for Registration";
                View::load("user");
            }
        }
        /**
         * This method calls loginCheck method in UserModel class
         * based on the result it loads the desired
         * view page and session message.
         */
        public function loginCheck() 
        {
            if(!isset($_SESSION['loggedin'])) {
                $this->user = new UserModel();
                $result = $this->user -> signIn();
                if($result) {
                    $_SESSION['loggedin']=1;
                    $this -> user = new CartController;
                    $createCart = $this-> user-> registerCart();
                    if($createCart) {
                        View::load("home");
                    }
                } else { 
                    $_SESSION['message'] = "Username or Password is incorrect";
                    View::load("user");
                }
            } else {
                $this -> user = new CartController;
                $addToCart = $this-> user-> addToCart();
                if($addToCart) {
                    $_SESSION['message'] = "Product added to cart";
                    View::load("home");
                }
            }
        }
        /**
         * This method calls showUserDetails method in UserModel class
         * based on the result it loads the desired
         * view page and session message.
         */
        public function showUserDetails() 
        {
            if(isset($_SESSION['loggedin'])) {
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
            $this->user = new UserModel();
            $updatePassword = $this->user -> updatePassword();
            return $updatePassword;
        }
        /**
         * This method calls updateAddress method in UserModel class
         *@return boolean type of the result.
         */
        public function updateAddress()
        {
            $this->user = new UserModel();
            $updateAddress = $this->user -> updateAddress();
            return $updateAddress;
        }
        /**
         * This method calls userLogout method in UserModel class
         * based on the result it loads the desired
         * view page and session message.
         */
        public function userLogout() 
        {
            if(isset($_SESSION['loggedin'])&&(isset($_SESSION['cart_id']))) {
                unset($_SESSION['loggedin']);
                $this->user = new UserModel();
                $logout = $this->user -> logout();                
                View::load("home");
            } else if(isset($_SESSION['loggedin'])) {
                unset($_SESSION['loggedin']);
                View::load("home");
            } else { 
                $_SESSION['message'] = "Register/Login to continue";
                View::load("user");
            }       
        }
    }
    