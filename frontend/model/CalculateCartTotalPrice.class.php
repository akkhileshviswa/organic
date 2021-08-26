<?php
    
    include "../autoload/autoload.php";
    class CalculateCartTotalPrice{
        private $connect;
        public function __construct(){
            $this->connect = new connection;
        }
        public function calculateCartTotalPrice(){
            $user_id = $_SESSION['user_id'];
            $connection = $this->connect->getConnection();
            $result = $connection->query("SELECT sum(cart.total_amount) FROM cart
                                            JOIN users ON users.user_id = cart.user_id 
                                            WHERE users.user_id = $user_id and cart.cart_date BETWEEN SUBTIME(CURRENT_TIME, '0:30:00') and CURRENT_TIME ;");
            $max_row = $result->fetch(PDO::FETCH_ASSOC);
            return $max_row; 
        }
    }
    
   
    
