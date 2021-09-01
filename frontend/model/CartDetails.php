<?php  
    /**
     * This class is used to fetch the cart details of the current user.
     */
    class CartDetails
    {
        private $instance;
        
        /**
         * This method is used to create a object for Database class.
         */
        public function __construct()
        {
            $this->instance = Database::getInstance();
        }

        /**
         * This method is used to fetch the details of the current user
         * @return array of cart details of current user.
         */
        public function getCartDetails()
        {
            $connection = $this->instance->getConnection();
            $cartId = $_SESSION['cart_id'];
            $result = $connection->query("SELECT product.image, item.item_id, item.item_name, item.item_price, 
                                          item.item_quantity, item.row_total  FROM item
                                          JOIN product ON product.product_id = item.product_id
                                          JOIN cart ON cart.cart_id = item.cart_id 
                                          WHERE item.cart_id = $cartId ;");
            return $result; 
        }
    }
