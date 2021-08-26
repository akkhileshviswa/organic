<?php 
    spl_autoload_register('autoload');
    function autoload($className){
        $path = "../model/";
        $extension = ".class.php";
        $fullPath = $path.$className.$extension;
        include_once $fullPath;
    }

