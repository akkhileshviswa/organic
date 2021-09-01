<?php   
	include "../config/Database.php";
	/**
	 * This class insert, fetches, delete, update the values in database upon calling the specified function.
	 */
    class AdminModel 
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
         * This method is used to show the order details,
		 * @return object of the result.
         */	
		public function orderDetails()
		{
			$connection = $this->connect->getConnection();
			$is_active = 0;
			$result = mysqli_query($connection, "SELECT cart_id, grand_total, order_status FROM cart 
									WHERE is_active = $is_active;");
			return $result;
		}
		/**
         * This method is used to show the customer checkout details,
		 * @return object of the result.
         */
		public function customerDetails($cart_id)
		{
			$connection = $this->connect->getConnection();
			$result = mysqli_query($connection, "SELECT first_name, checkout_date FROM checkout WHERE cart_id = $cart_id;");
			return $result;
		}
		/**
         * This method is used to show the customer product details,
		 * @return object of the result.
         */
		public function getCustomerCartProducts($cart_id)
		{
			$connection = $this->connect->getConnection();
			$result = mysqli_query($connection, "SELECT item_name FROM item WHERE cart_id = $cart_id;");
			return $result;
		}
    }

	