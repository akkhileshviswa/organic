<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type:application/json; charset=UTF-8");
    
    include "model/Database.php";
    function cron(){
        $connection = new Database();
        $connectWarehouse = $connection->getConnectionToWarehouse();
        $result = mysqli_query($connectWarehouse,"SELECT * FROM products;");
        while( $results = $result->fetch_assoc()) {
            $product[]=[
                "product_id" => $results['product_id'],
                "product_name" => $results['product_name'],
                "product_code" => $results['product_code'],
                "quantity" =>  $results['quantity'] 
            ];
        }
        echo json_encode($product);
    }
    cron();