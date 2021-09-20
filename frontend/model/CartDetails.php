<?php  
    /**
     * This class is used to fetch the cart details of the current user.
     */
    interface CartDetail
    {
        public function getCartDetails();
    }
    
    /**
     * {@inheritdoc} Here is where the method is defined.
     */
    class CartDetails implements CartDetail
    {
        private $instance;
        private $session;
        
        /**
         * This method is used to create a object for Database class.
         */
        public function __construct()
        {
            $this->instance = Database::getInstance();
            $this->session = SessionId::session();
        }

        /**
         * This method is used to fetch the details of the current user
         * @return object of cart details of current user.
         */
        public function getCartDetails()
        {
            $connection = $this->instance->getConnection();
            $cartId = $this->session['cartId'];
            $isActive = intval(1);
            $statement = $connection->prepare("SELECT product.image, item.item_id, item.item_name, item.item_price, 
                                                item.item_quantity, item.row_total  FROM item
                                                JOIN product ON product.product_id = item.product_id
                                                JOIN cart ON cart.cart_id = item.cart_id 
                                                WHERE item.cart_id = :cart_id AND cart.is_active = :isActive;");
            $statement->bindParam(':cart_id', $cartId);
            $statement->bindParam(':isActive', $isActive);
            $statement->execute();
            $count = $statement->rowCount();
            $_SESSION['itemCount'] = $count;
            return $statement; 
        }
    }
