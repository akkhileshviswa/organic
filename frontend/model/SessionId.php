<?php
    /**
     * This class is used to fetch the current session details.
     */
    class SessionId
    {
        /**
         * This method is used to fetch the current session details 
         * @return array.
         */
        public static function session() {
            $data['userId'] = $_SESSION['user_id'];
            $data['cartId'] = $_SESSION['cart_id'];
            return $data;
        }
    }