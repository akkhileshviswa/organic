<?php
    $connect = mysqli_connect("localhost","root","","organic");

    $request = $_SERVER['REQUEST_METHOD'];

    $order = array();
    if($request == 'GET') {
        response(getOrder());            
    }

    function getOrder()
    {
        global $connect;
        $result = mysqli_query($connect,"SELECT * FROM cart");
        while($row = mysqli_fetch_assoc($result)) {
            extract($row);
            $order[]=array(
                "order_id" => $cart_id,
                "order_total" => $grand_total,
                "order_status" => $order_status,
            );
        }
        return $order;
    }

    function response($order)
    {
        echo json_encode($order);
    }