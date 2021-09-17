<?php
    error_reporting(0);
    /**
     * This class creates a object for AdminModel class and calls the specified function of the AdminModel class.
     */
    class Controller
    {
        private $user;
        
        /**
         * This method creates the object for AdminModel class.
         */
        public function __construct() 
        {
            $this->user = new AdminModel();
        }
        
        /**
         * This method loads login page on get request.
         * @return null
         */
        public function loadLogin()
        {
            $_SESSION['loggedin'] = 0;
            View::load('login');
        }
        
        /**
         * This method loads dashboard page on get request, if the user has logged in.
         * @return null
         */
        public function loadDashboard()
        {
            if($_SESSION['loggedin'] == 1) {
                View::load("dashboard");
            } else {
                $_SESSION['message'] = "Login To Continue";
                View::load('login');
            }
        }
        
        /**
         * This method loads customers page on get request, if the user has logged in.
         * @return null
         */
        public function loadCustomers()
        {
            if($_SESSION['loggedin'] == 1) {
                View::load("customers");
            } else {
                $_SESSION['message'] = "Login To Continue";
                View::load('login');
            }
        }
        
        /**
         * This method loads orders page on get request, if the user has logged in.
         * @return null
         */
        public function loadOrders()
        {
            if($_SESSION['loggedin'] == 1) {
                View::load("orders");
            } else {
                $_SESSION['message'] = "Login To Continue";
                View::load('login');
            }
        }
        
        /**
         * This method loads products page on get request, if the user has logged in.
         * @return null
         */
        public function loadProducts()
        {
            if($_SESSION['loggedin'] == 1) {
                View::load("products");
            } else {
                $_SESSION['message'] = "Login To Continue";
                View::load('login');
            }
        }
        
        /**
         * This method loads new product page on get request, if the user has logged in.
         * @return null
         */
        public function newProduct()
        {
            if($_SESSION['loggedin']==1) {
                View::load("newproduct");
            } else {
                $_SESSION['message'] = "Login To Continue";
                View::load('login');
            }
        }
        
        /**
         * This method loads update product page on post request, if the user has logged in.
         * @return null
         */
        public function updateProduct()
        {
            if($_SESSION['loggedin'] == 1) {
                View::load("updateproduct");
            } else {
                $_SESSION['message'] = "Login To Continue";
                View::load('login');
            }
        }
        
        /**
         * This method loads update customer page on post request, if the user has logged in.
         * @return null
         */
        public function updateCustomer()
        {
            if($_SESSION['loggedin'] == 1) {
                View::load("updatecustomer");
            } else {
                $_SESSION['message'] = "Login To Continue";
                View::load('login');
            }
        }
        
        /**
         * This method calls signIn method in AdminModel class
         * based on the result it loads the desired
         * view page and session message.
         * @return null
         */
        public function loginUser() 
        {
            $result = $this->user -> signIn();
            if($result) {
                {
                    $_SESSION['loggedin'] = 1;
                    View::load("dashboard");
                }
            } else {
                $_SESSION['message'] = "Username or Password is incorrect";
                View::load("login");
            }
        }
        
        /**
         * This method calls showAdmin method in AdminModel class
         * @return object of the result.
         */
        public function showAdmin()
        {
            $result = $this->user -> showAdmin();
            return $result;
        }
        
        /**
         * This method calls showProducts method in AdminModel class
         * @return object of the result.
         */
        public function showProducts()
        {
            $result = $this->user -> showProducts();
            return $result;
        }
        
        /**
         * This method calls editProduct method in AdminModel class
         * @return object of the result.
         */
        public function editProduct()
        {
            $result = $this->user -> editProduct();
            return $result;
        }
        
        /**
         * This method calls updateEditedProduct method in AdminModel class
         * based on the result it loads the desired
         * view page and session message.
         * @return null
         */
        public function updateEditedProduct()
        {
            $result = $this->user -> updateEditedProduct();
            if($result) {
                $_SESSION['message'] = "Product has been updated.";
            } else {
                $_SESSION['message'] = "Product has not been updated.";
            }
            View::load("products");
        }

         /**
         * This method calls enableOrDisableProduct method in AdminModel class
         * based on the result it loads the desired
         * view page and session message.
         * @return null
         */
        public function enableOrDisableProduct()
        {
            $result = $this->user -> enableOrDisableProduct();
            View::load("products");
            
        }
        
        /**
         * This method calls createProduct method in AdminModel class
         * based on the result it loads the desired
         * view page and session message.
         * @return null
         */
        public function createProduct() 
        {
            $result = $this->user -> createProduct();
            if($result) {
                $_SESSION['message'] = "Product is registered.";
                View::load("products");
            } else {
                $_SESSION['message'] = "Enter Valid Details for Registering the Product.";
                View::load("newproduct");
            }
        }

        /**
         * This method calls showCustomers method in AdminModel class
         * @return object of the result.
         */
        public function showCustomers()
        {
            $result = $this->user -> showCustomers();
            return $result;
        }
        
        /**
         * This method calls editCustomer method in AdminModel class
         * @return object of the result.
         */
        public function editCustomer()
        {
            $result = $this->user -> editCustomer();
            return $result;
        }
        
        /**
         * This method calls updateEditedCustomer method in AdminModel class
         * based on the result it loads the desired
         * view page and session message.
         * @return null
         */
        public function updateEditedCustomer()
        {
            $result = $this->user -> updateEditedCustomer();
            if($result == 1) {
                $_SESSION['message'] = "Customer Detail has been updated!!";
            } elseif($result == 2) {
                $_SESSION['message'] = "Username already exists!!";
            } elseif($result == 3) {
                $_SESSION['message'] = "Email already exists!!";
            } elseif($result == 4) {
                $_SESSION['message'] = "This Details Are Already Existing For The Sama Customer!!";
            } else {
                $_SESSION['message'] = "Customer Detail has not been updated!!";
            }
            View::load("customers");
        }
        
        /**
         * This method calls changeOrderStatus method in AdminModel class
         * based on the result it loads the desired
         * view page and session message.
         * @return null
         */
        public function changeOrderStatus()
        {
            $result = $this->user -> changeOrderStatus();
            if($result) {
                $_SESSION['message'] = "Order Status has been updated.";
            } else {
                $_SESSION['message'] = "Order Status has not been updated.";
            }
            View::load("orders");
        }
        
        /**
         * This method calls removeOrder method in AdminModel class
         * based on the result it loads the desired
         * view page and session message.
         * @return null
         */
        public function removeOrder()
        {
            $result = $this->user -> removeOrder();
            if($result) {
                $_SESSION['message'] = "Order has been deleted.";
            } else {
                $_SESSION['message'] = "Order has not been deleted.";
            }
            View::load("orders");
        }
    }
