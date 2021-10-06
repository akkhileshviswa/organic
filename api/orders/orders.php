<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include "../model/AdminModel.php";
    $database = new Database();
    $db = $database->getConnection();
  

    $orders = new AdminModel();
    $orderDetails = $orders -> orderDetails();
    $rowCount = mysqli_num_rows($orderDetails);
    if($rowCount>0){
        while( $results = $orderDetails->fetch_assoc()){
            $customerDetails = $orders -> customerDetails($results['cart_id']);
            $getCustomerCartProducts = $orders -> getCustomerCartProducts($results['cart_id']);
            $i = $customerDetails->fetch_assoc();
            $j = $getCustomerCartProducts->fetch_assoc();
            $order[]=array(
                "order_id" => $results['cart_id'],
                "products" => $j['item_name'],
                "customer_name" => $i['first_name'],
                "order_total" => $results['grand_total'],
                "Date" => $i['checkout_date'],
                "order_status" => $results['order_status']
            );
        }
        echo json_encode($order);
    }
    else{
        http_response_code(404);
        echo json_encode(array("message" => "No products found."));
    }