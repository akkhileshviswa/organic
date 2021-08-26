<?php
    include "../autoload/autoload.php";
    class ChangeQuantity {
        private $connect;
        public function __construct(){
            $this->connect = new connection;
        }
        public function changeQuantity(){
            if(isset($_POST['quantity']))
            {
                $connection = $this->connect->getConnection();
                $quantity = intval($_POST['quantity']);
                $total_amount = floatval($_POST['total_amount']); 
                $product_id = intval($_POST['product_id']);
                try{
                    $result =  $connection->query("UPDATE cart SET quantity = $quantity, total_amount = $total_amount WHERE product_id = $product_id;");
                    if(!$result){
                        throw new Exception("Error in inserting");
                    }
                }catch(Exception $e){
                    echo "Message: " .$e->getMessage();
                }	   
            }
        }
    }
    $quantity = new ChangeQuantity();
    $quantity -> changeQuantity();
    