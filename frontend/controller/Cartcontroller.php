<?php
 error_reporting(0);
    /**
     * This class creates a object for CartModel class and calls the specified function of the CartModel class.
     */
    class CartController 
    {
        private $cart;
        
        /**
         * This method is used to create a object for CartModel class.
         * @return null
         */
        public function __construct()
        {
            $this->cart = new CartModel();
        }

        /**
         * This method loads cart page on get request.
         * @return null
         */
        public function loadCart()
        {
            if ($_SESSION['loggedin'] > 0) {
                View::load("cart");
            } else {
                $_SESSION['message'] = "Register/Login to continue!!"; 
                View::load("user");
            }
        }
        
        /**
         * This method loads checkout page on get request.
         * @return null
         */
        public function loadCheckout()
        {
            if ($_SESSION['loggedin'] > 0) {
                if ($_SESSION['itemCount'] > 0) {
                    View::load("checkout");
                } else {
                    $_SESSION['message'] = "Cart is Empty!! Add Products To Continue!!";
                    View::load("home");
                }
            } else {
                $_SESSION['message'] = "Register/Login to continue!!"; 
                View::load("user");
            }
        }
        
        /**
         * This method calls createCart method in CartModel class
         * @return boolean type of the result.
         */
        public function registerCart() 
        {
            $createCart = $this->cart -> createCart();
            return $createCart;
        }
        
        /**
         * This method calls addToCart method in CartModel class
         * @return boolean type of the result.
         */
        public function addToCart() 
        {
            $addToCart = $this->cart->addToCart();
            return $addToCart;
        }
        
        /**
         * This method calls updateQuantity method in CartModel class
         * @return boolean type of the result.
         */
        public function updateQuantity() 
        {
            $updateQuantity = $this->cart->updateQuantity();
            return $updateQuantity;
        }
        
        /**
         * This method calls removeCartItem method in CartModel class
         * @return boolean type of the result.
         */
        public function removeCartItem() 
        {
            $removeCartItem = $this->cart->removeCartItem();
            return $removeCartItem;
        }
        
        /**
         * This method calls updateCart method in CartModel class
         * @return boolean type of the result.
         */
        public function updateCart() 
        {
            $updateCart = $this->cart->updateCart();
            return $updateCart;
        }
        
        /**
         * This method calls showCartDetails method in CartModel class
         * @return object type of the result.
         */
        public function showCartDetails()
        {
            $showCartDetails = $this->cart->showCartDetails();
            return $showCartDetails;
        }
        
        /**
         * This method calls checkoutDetails method in CartModel class
         * @return boolean type of the result.
         */
        public function checkoutDetails()
        {
            $checkoutDetails = $this->cart->checkoutDetails();
            if ($checkoutDetails) {
                View::load('orderdetails');
            } else {
                $_SESSION['message'] = "Fill all the fields!";
                View::load('checkout');
            }
        }
        
        /**
         * This method calls checkoutTotal method in CartModel class
         * @return boolean type of the result.
         */
        public function checkoutTotal()
        {
            $checkoutTotal = $this->cart->checkoutTotal();
            return $checkoutTotal;
        }
        
        /**
         * This method calls orderDetails method in CartModel class
         * @return object type of the result.
         */
        public function orderDetails()
        {
            $orderDetails = $this->cart->orderDetails();
            return $orderDetails;            
        }
        
        /**
         * This method calls customerDetails method in CartModel class
         * @return object type of the result.
         */
        public function customerDetails()
        {
            $customerDetails = $this-> cart->customerDetails();
            return $customerDetails;
        }
	}
    