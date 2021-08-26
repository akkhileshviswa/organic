<?php
    spl_autoload_register('myTotalPrice');
    function myTotalPrice($className){
        $path = "../model/";
        $extension = ".class.php";
        $fullPath = $path.$className.$extension;
        include_once $fullPath;
    }
    $calculatetotalprice = new CalculateCartTotalPrice;
    $cart = $calculatetotalprice -> calculateCartTotalPrice(); 
    