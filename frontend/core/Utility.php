<?php
    
    /**
     * This class stores the base url for the css and javascript files to be included
     */
    class Utility
    {
        const url = "https://localhost/project/organic/frontend";
        
        /**
         * This method returns the base url for the files to be included externally
         * @return string of url.
         */
        public static function getAssests()
        {
            return self::url; 
        }
    }
    
    