<?php  
    /**
     * This class is used to fetch the product details to be shown to the user.
     */
    class ProductDetails
    {
        private $connect;
        /**
         * This method is used to create a object for Database class.
         */
        public function __construct()
        {
            $this->connect = new Database;
        }
        /**
         * This method is used to fetch the product details from the database 
         * @return array of product details.
         */
        public function getProductDetails()
        {
            $connection = $this->connect->getConnection();
            $result = $connection->query("SELECT product_id, product_name, price, image FROM product;");
            return $result; 
        }
    }
    