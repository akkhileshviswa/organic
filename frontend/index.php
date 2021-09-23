<?php
    session_start(); 
    spl_autoload_register('autoload');
    const path_model = "model/";   
    const path_controller = "controller/";
    const path_view = "view/";
    const path_core = "core/";
    const extension = ".php";

    function autoload($className) {
        $fullPath_model = path_model.$className.extension;
        if (file_exists($fullPath_model)) {
            include_once $fullPath_model;
        }

        $fullPath_controller = path_controller.$className.extension;
        if (file_exists($fullPath_controller)) {
            include_once $fullPath_controller;
        }

        $fullPath_view = path_view.$className.extension;
        if (file_exists($fullPath_view)) {
            include_once $fullPath_view;
        }
        
        $fullPath_core = path_core.$className.extension;
        if (file_exists($fullPath_core)) {    
            include_once $fullPath_core;
        }
    }
    
    $method = $_SERVER['REQUEST_METHOD'];
    $request = pathinfo($_SERVER['REQUEST_URI'], PATHINFO_FILENAME);
    const get = "GET";
    const post = "POST";
    require_once "core/Layout.php";
    routes($method, $request); 
    
    function routes($method, $request) {
        if ($method == get) {
            $routes = Routes::getRoutes(get);
        } elseif ($method == post) {
            $routes = Routes::getRoutes(post);
        }
        if (!empty($routes)) {
            foreach($routes as $route) {
                if (strstr($request,$route['url'])) {
                    $controller = $route['controller'];
                    $method = $route['method'];
                    $obj = new $controller();
                    $obj -> $method();
                }
            }
        }
    }