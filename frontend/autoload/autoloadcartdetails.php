<?php
    spl_autoload_register('myAutoload');
    function myAutoload($className){
        $path = "../model/";
        $extension = ".class.php";
        $fullPath = $path.$className.$extension;
        include_once $fullPath;
    }
    $cartDetails = new CartDetails;
    $cart = $cartDetails->getCartDetails();
    $count=$cart->rowCount();
    $results= $cart->fetchAll();