<?php
    spl_autoload_register('myAutoload');
        function myAutoload($className){
            $path = "../controller/";
            $extension = ".php";
            $fullPath = $path.$className.$extension;
            include_once $fullPath;
        }
        $user = new LoginCheck;
        $user -> loginCheck();