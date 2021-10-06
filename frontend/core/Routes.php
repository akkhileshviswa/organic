<?php
    /**
     * This class stores and fetch all the registered routes on Layout.php
     */
    class Routes
    {
        private static $getMethodRoutes = [];
        private static $postMethodRoutes = [];
        
        /**
         * This method stores the get method routes on getMethodRoutes
         */
        public static function get($route)
        {
            if (
                !array_key_exists('url', $route)
                || !array_key_exists('controller', $route)
                || !array_key_exists('method', $route)
            ) {
                throw new Exception('Invalid route !');
            }
            self::$getMethodRoutes[] = $route;
        }
        
        /**
         * This method stores the post method routes on postMethodRoutes
         */
        public static function post($route)
        {
            if (
                !array_key_exists('url', $route)
                || !array_key_exists('controller', $route)
                || !array_key_exists('method', $route)
            ) {
                throw new Exception('Invalid route !');
            }
            self::$postMethodRoutes[] = $route;
        }
        
        /**
         * This method is used to get the registered routes
         * @return array of routes
         */
        public static function getRoutes($method)
        {
            return $method == 'GET'? self::$getMethodRoutes: self::$postMethodRoutes;
        }
    }