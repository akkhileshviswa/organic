<?php
    spl_autoload_register('myAutoload');
    function myAutoload($className){
        $path = "../model/";
        $extension = ".class.php";
        $fullPath = $path.$className.$extension;
        include_once $fullPath;
    }
    $productDetails = new ProductDetails;
    $products = $productDetails->getproductDetails();
    $count=$products->rowCount();
    $results= $products->fetchAll();