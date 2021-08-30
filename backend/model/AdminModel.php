<?php   
	error_reporting(0);
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
         * This method is used to sign in the user based on the details provided,
		 * @return boolean of the result.
         */
        public function signIn()
		{
			if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['name']!="" && $_POST['password']!="" ) {
				$connection = $this->connect->getConnection();
				$name = trim($_POST['name']);
				$password = trim($_POST['password']);
				try {
					$result = mysqli_query($connection,"SELECT * FROM admin WHERE username = '$name' AND password = '$password';");
					if(!$result) {
						throw new Exception("Error in Selecting");
					}
				}catch(Exception $e) {
					echo "Message: " .$e->getMessage();
				}
				$row = mysqli_fetch_array($result);
				if($row['username']==$name && $row['password']==$password) {
					$_SESSION['user_id']=$row['user_id'];
					return true;
				} else {
					return false;
				}	
            }
        }
		/**
         * This method is used to display the admin details upon logging in,
		 * @return object of the result.
         */
        public function showAdmin()
		{
            $connection = $this->connect->getConnection();
            $user_id = $_SESSION['user_id'];
            $result = mysqli_query($connection,"SELECT * FROM admin WHERE user_id = $user_id ;");
            return $result; 
        }
		/**
         * This method is used to display the existing products from the database,
		 * @return object of the result.
         */
		public function showProducts()
		{
            $connection = $this->connect->getConnection();
            $result = mysqli_query($connection,"SELECT * FROM product ;");
            return $result; 
        }
		/**
         * This method is used to show the existing product details in the product editing form,
		 * @return object of the result.
         */
		public function editProduct()
		{
			$connection = $this->connect->getConnection();
			$product_id = intval($_POST['product_id']);
			$result = mysqli_query($connection,"SELECT product_id, product_name, price FROM product 
									WHERE product_id = $product_id ;");
            return $result; 
		}
		/**
         * This method is used to update product details in the database,
		 * @return object of the result.
         */
		public function updateEditedProduct(){
			$connection = $this->connect->getConnection();
			$product_id = intval($_POST['product_id']);
			$product_name = trim($_POST['product_name']);
			$price = floatval($_POST['price']);
			$result = mysqli_query($connection,"UPDATE product 
									SET product_name = '$product_name', price = $price, updated_date = CURRENT_TIME  
									WHERE product_id = $product_id ;");
            return $result; 
		}
		/**
         * This method is used to create a new product and insert it into the database,
		 * @return object of the result.
         */
		public function createProduct() 
		{	
			$connection = $this->connect->getConnection();
			$product_name = trim($_POST['product_name']);
			$price = floatval($_POST['price']);
			$image = $_FILES['file']['name'];
			$result = mysqli_query($connection,"INSERT INTO product (product_name, price, image) 
									VALUES ('$product_name', $price, '$image');");
			return $result;			
		} 
		/**
         * This method is used to display the existing customers from the database,
		 * @return object of the result.
         */
		public function showCustomers()
		{
            $connection = $this->connect->getConnection();
            $result = mysqli_query($connection,"SELECT * FROM users ;");
            return $result; 
        }
		/**
         * This method is used to show the existing customer details in the customer editing form,
		 * @return object of the result.
         */
		public function editCustomer()
		{
			$connection = $this->connect->getConnection();
			$user_id = intval($_POST['user_id']);
			$result = mysqli_query($connection,"SELECT user_id, username, email FROM users WHERE user_id = $user_id ;");
            return $result; 
		}
		/**
         * This method is used to update customer details in the database,
		 * @return object of the result.
         */
		public function updateEditedCustomer()
		{
			$connection = $this->connect->getConnection();
			$user_id = intval($_POST['user_id']);
			$username = trim($_POST['username']);
			$email = trim($_POST['email']);
			$result = mysqli_query($connection,"UPDATE users 
									SET username = '$username', email = '$email', updated_date = CURRENT_TIME  
									WHERE user_id = $user_id ;");
            return $result; 
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
		/**
         * This method is used to update order status in the database,
		 * @return object of the result.
         */
		public function changeOrderStatus()
		{
			$connection = $this->connect->getConnection();
			$cart_id = intval($_POST['cart_id']);
			$order_status = trim($_POST['order_status']);
			$result = mysqli_query($connection,"UPDATE cart
									SET order_status = '$order_status', updated_date = CURRENT_TIME 
									WHERE cart_id = $cart_id ;");
            return $result; 
		}
		/**
         * This method is used to delete the corresponding order details, checkout details and cart details 
		 * for the corresponding customer in the database,
		 * @return object of the result.
         */
		public function removeOrder()
		{
			$connection = $this->connect->getConnection();
			$cart_id = intval($_POST['cart_id']);
			$deleteCheckout = mysqli_query($connection,"DELETE FROM checkout WHERE cart_id = $cart_id;");
			$deleteItem = mysqli_query($connection,"DELETE FROM item WHERE cart_id = $cart_id;");
			$deleteCart = mysqli_query($connection,"DELETE FROM cart WHERE cart_id = $cart_id;");
            return $deleteCart; 
		}
    }

	