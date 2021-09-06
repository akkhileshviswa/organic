<?php
    $cURLConnection = curl_init();
    curl_setopt($cURLConnection, CURLOPT_URL, 'https://localhost/project/organic/warehouse/index.php');
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    curl_setopt( $cURLConnection, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYPEER, 0);
    $result = curl_exec($cURLConnection);
    curl_close($cURLConnection);
    if (curl_errno($cURLConnection)) { 
        print curl_error($cURLConnection); 
    } 
    $data = json_decode($result,true);
    
    include "../core/Database.php";
    $database = new Database;
    $connection = $database->getConnection();
    foreach($data as $row){
        $result = mysqli_query($connection,"UPDATE product SET quantity = '".$row["quantity"]."'
									WHERE product_code = '".$row["product_code"]."' ;");
    }
