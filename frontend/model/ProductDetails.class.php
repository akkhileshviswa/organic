<?php  
    class ProductDetails{
        private $connect;
        public function __construct(){
            $this->connect = new connection;
        }
        public function getProductDetails(){
            $connection = $this->connect->getConnection();
            $result = $connection->query("select product_id, product_name, price, image from product");
            return $result; 
        }
    }
