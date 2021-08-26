<?php  
    class CartDetails{
        private $connect;
        public function __construct(){
            $this->connect = new connection;
        }
        public function getCartDetails(){
            $user_id = $_SESSION['user_id'];
            $connection = $this->connect->getConnection();
            $result = $connection->query("SELECT cart.cart_id,product.product_id,product.product_name, product.price, product.image FROM product
                                            JOIN cart ON product.product_id = cart.product_id
                                            JOIN users ON users.user_id = cart.user_id 
                                            WHERE users.user_id = $user_id and cart.cart_date BETWEEN SUBTIME(CURRENT_TIME, '0:30:00') and CURRENT_TIME ;");
            return $result; 
        }
    }
