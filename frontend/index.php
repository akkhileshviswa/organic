<?php
    session_start();
    spl_autoload_register('autoload');
    const path_model = "model/";
    const extension_model = ".php";
    
    const path_controller = "controller/";
    const extension_controller = ".php";

    const path_view = "view/";
    const extension_view = ".php";

    const path_core = "core/";
    const extension_core = ".php";

    function autoload($className){
        $fullPath_model = path_model.$className.extension_model;
        if (file_exists("model/$className.php")) {
            include_once $fullPath_model;
        }

        $fullPath_controller = path_controller.$className.extension_controller;
        if (file_exists("controller/$className.php")) {
            include_once $fullPath_controller;
        }

        $fullPath_view = path_view.$className.extension_view;
        if (file_exists("view/$className.php")) {
            include_once $fullPath_view;
        }
        
        $fullPath_core = path_core.$className.extension_core;
        if (file_exists("core/$className.php")) {    
            include_once $fullPath_core;
        }
    }
    
    $method = $_SERVER['REQUEST_METHOD'];
    $request = pathinfo($_SERVER['REQUEST_URI'], PATHINFO_FILENAME);
    const get = "GET";
    const post = "POST";

    require_once "core/Layout.php";
   
    routes($method,$request); 
    
    function routes($method,$request){
        if($method == get) {
            $routes = Routes::getRoutes(get);
        } else {
            $routes = Routes::getRoutes(post);
        }
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
    