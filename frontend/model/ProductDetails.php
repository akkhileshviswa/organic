<?php  
    /**
     * This class is used to fetch the product details to be shown to the user.
     */
    abstract class ProductDetail
    {
        abstract protected function getProductDetails();
    }

    /**
     * {@inheritdoc} Here is where the method is defined.
     */
    class ProductDetails extends ProductDetail
    {
        private $instance;
        
        /**
         * This method is used to create a object for Database class.
         */
        public function __construct()
        {
            $this->instance = Database::getInstance();
        }
        
        /**
         * This method is used to fetch the product details from the database, 
         * @return  object of product details.
         */
        public function getProductDetails()
        {
            $connection = $this->instance->getConnection();
            $isActive = intval(1);
            $result = $connection->prepare("SELECT product_id, product_name, price, image FROM product WHERE is_active = :isActive ;");
            $result->bindParam(':isActive', $isActive);
            $result->execute();
            return $result; 
        }
    }
     