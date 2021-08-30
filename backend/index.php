<?php
    session_start();
    spl_autoload_register('autoload');
    function autoload($className){
        $path_model = "model/";
        $extension_model = ".php";
        $fullPath_model = $path_model.$className.$extension_model;
        if (file_exists("model/$className.php")) {
            include_once $fullPath_model;
        }

        $path_controller = "controller/";
        $extension_controller = ".php";
        $fullPath_controller = $path_controller.$className.$extension_controller;
        if (file_exists("controller/$className.php")) {
            include_once $fullPath_controller;
        }

        $path_view = "view/";
        $extension_view = ".php";
        $fullPath_view = $path_view.$className.$extension_view;
        if (file_exists("view/$className.php")) {
            include_once $fullPath_view;
        }
        
        $path_core = "core/";
        $extension_core = ".php";
        $fullPath_core = $path_core.$className.$extension_core;
        if (file_exists("core/$className.php")) {    
            include_once $fullPath_core;
        }
    }
    
    $method = $_SERVER['REQUEST_METHOD'];
    $request = pathinfo($_SERVER['REQUEST_URI'], PATHINFO_FILENAME);
    
    require_once "core/Layout.php";
    if($method=="GET") {
        $routes = Routes::getRoutes("GET");
        if(!empty($routes)) {
            foreach($routes as $route) {
                if(strstr($request,$route['url'])) {
                    $controller = $route['controller'];
                    $method = $route['method'];
                    $obj = new $controller();
                    $obj -> $method();
                }
            }
        } 
    }
        
    if($method=="POST") {
        $routes = Routes::getRoutes("POST");
        if(!empty($routes)) {
            foreach($routes as $route) {
                if(strstr($request,$route['url'])) {
                    $controller = $route['controller'];
                    $method = $route['method'];
                    $obj = new $controller();
                    $obj -> $method();
                }
            }
        }
    }
