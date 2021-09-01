<?php
    /**
     * This class stores the base url for the css and javascript files to be included
     */
    class Utility
    {
        const url = "https://localhost/project/organic/backend";
        
        /**
         * This method returns the base url for the files to be included externally
         * @return string of url.
         */
        public static function getAssests()
        {
            // $baseurl = $_SERVER['SERVER_PORT'] == 443? 'https://': 'http://'.$_SERVER['HTTP_HOST'];
            // $requsetedurl = $baseurl.$_SERVER['REQUEST_URI'];
            // $asessturl =str_replace(substr($url, strpos($url, 'index.php')), "", $url);
            return self::url; 
        }
    }
      