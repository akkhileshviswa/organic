<?php
    /**
     * This class loads the required file present in view folder when called. 
     */
    class View
    {
        /**
         * This method includes the specified file when called. 
         */
        public static function load($file)
        {
            include_once "$file.php";
        }
    }