<?php
    include "../autoload/autoload.php";
    class AddToCart {
        private $connect;
        public function __construct(){
            $this->connect = new connection;
        }
        public function addToCart(){
            if(isset($_POST['user_id']))
            {
                $connection = $this->connect->getConnection();
                $user_id = intval($_POST['user_id']);
                $product_id = intval($_POST['product_id']);
                try{
                    $result =  $connection->query("INSERT INTO cart (user_id,product_id) VALUES ($user_id,$product_id);");
                    if(!$result){
                        throw new Exception("Error in inserting");
                    }
                }catch(Exception $e){
                    echo "Message: " .$e->getMessage();
                }	   
            }
        }
    }
    $cart = new AddToCart();
    $cart -> addToCart();
    