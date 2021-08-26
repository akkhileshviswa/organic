<?php
    include "../autoload/autoload.php";
    class DeleteCartProduct {
        private $connect;
        public function __construct(){
            $this->connect = new connection;
        }
        public function deleteCartProduct(){
            if (isset($_POST['cart_id'])){
                $connection = $this->connect->getConnection();
                $cart_id = intval($_POST['cart_id']);
                try{
                    $result = $connection->query("DELETE FROM cart WHERE cart_id= $cart_id;");
                    if(!$result){
                        throw new Exception("Error in inserting");
                    }
                }catch(Exception $e){
                    echo "Message: " .$e->getMessage();
                }	   
            }
        }
    }
    $deleteCartProduct = new DeleteCartProduct;
    $deleteCartProduct -> deleteCartProduct();

