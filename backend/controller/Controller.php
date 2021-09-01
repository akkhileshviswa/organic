<?php
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
         */
        public function loadLogin()
        {
            View::load('login');
        }
        
        /**
         * This method loads dashboard page on get request.
         */
        public function loadDashboard()
        {
            View::load("dashboard");
        }
        
        /**
         * This method loads customers page on get request.
         */
        public function loadCustomers()
        {
            View::load("customers");
        }
        
        /**
         * This method loads orders page on get request.
         */
        public function loadOrders()
        {
            View::load("orders");
        }
        
        /**
         * This method loads products page on get request.
         */
        public function loadProducts()
        {
            View::load("products");
        }
        
        /**
         * This method loads new product page on get request.
         */
        public function newProduct()
        {
            View::load("newproduct");
        }
        
        /**
         * This method loads update product page on post request.
         */
        public function updateProduct()
        {
            View::load("updateproduct");
        }
        
        /**
         * This method loads update customer page on post request.
         */
        public function updateCustomer()
        {
            View::load("updatecustomer");
        }
        
        /**
         * This method calls signIn method in AdminModel class
         * based on the result it loads the desired
         * view page and session message.
         */
        public function loginUser() 
        {
            $result = $this->user -> signIn();
            if($result) {
                {
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
         * This method calls createProduct method in AdminModel class
         * based on the result it loads the desired
         * view page and session message.
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
         */
        public function updateEditedCustomer()
        {
            $result = $this->user -> updateEditedCustomer();
            if($result) {
                $_SESSION['message'] = "Customer Detail has been updated.";
            } else {
                $_SESSION['message'] = "Customer Detail has not been updated.";
            }
            View::load("customers");
        }
        
        /**
         * This method calls changeOrderStatus method in AdminModel class
         * based on the result it loads the desired
         * view page and session message.
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
