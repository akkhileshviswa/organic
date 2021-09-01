<?php   
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
			if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['name'] != "" && $_POST['password'] != "" ) {
				$connection = $this->connect->getConnection();
				$name = trim($_POST['name']);
				$password = trim($_POST['password']);
				try {
					$result = mysqli_query($connection,"SELECT * FROM admin WHERE username = '$name' AND password = '$password';");
					if(!$result) {
						throw new Exception("Error in Selecting");
					}
				} catch(Exception $e) {
					throw "Message: " .$e->getMessage();
				}
				$row = mysqli_fetch_array($result);
				if($row['username'] == $name && $row['password'] == $password) {
					$_SESSION['user_id'] = $row['user_id'];
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
            $userId = $_SESSION['user_id'];
            $result = mysqli_query($connection,"SELECT * FROM admin WHERE user_id = $userId ;");
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
			$productId = intval($_POST['product_id']);
			$result = mysqli_query($connection,"SELECT product_id, product_name, price, quantity FROM product 
									WHERE product_id = $productId ;");
            return $result; 
		}
		
		/**
         * This method is used to update product details in the database,
		 * @return object of the result.
         */
		public function updateEditedProduct(){
			$connection = $this->connect->getConnection();
			$productId = intval($_POST['product_id']);
			$productName = trim($_POST['product_name']);
			$price = floatval($_POST['price']);
			$quantity = intval($_POST['quantity']);
			$result = mysqli_query($connection,"UPDATE product 
									SET product_name = '$productName', price = $price, quantity = $quantity
									WHERE product_id = $productId ;");
            return $result; 
		}
		
		/**
         * This method is used to create a new product and insert it into the database,
		 * @return object of the result.
         */
		public function createProduct() 
		{	
			$connection = $this->connect->getConnection();
			$productName = trim($_POST['product_name']);
			$price = floatval($_POST['price']);
			$image = $_FILES['file']['name'];
			$result = mysqli_query($connection,"INSERT INTO product (product_name, price, image) 
									VALUES ('$productName', $price, '$image');");
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
			$userId = intval($_POST['user_id']);
			$result = mysqli_query($connection,"SELECT user_id, username, email FROM users WHERE user_id = $userId ;");
            return $result; 
		}
		
		/**
         * This method is used to update customer details in the database,
		 * @return object of the result.
         */
		public function updateEditedCustomer()
		{
			$connection = $this->connect->getConnection();
			$userId = intval($_POST['user_id']);
			$username = trim($_POST['username']);
			$email = trim($_POST['email']);
			$result = mysqli_query($connection,"UPDATE users 
									SET username = '$username', email = '$email'
									WHERE user_id = $userId ;");
            return $result; 
		}
		
		/**
         * This method is used to show the order details,
		 * @return object of the result.
         */
		public function orderDetails()
		{
			$connection = $this->connect->getConnection();
			$isActive = 0;
			$result = mysqli_query($connection, "SELECT cart_id, grand_total, order_status FROM cart 
									WHERE is_active = $isActive;");
			return $result;
		}
		
		/**
         * This method is used to show the customer checkout details,
		 * @return object of the result.
         */
		public function customerDetails($cartId)
		{
			$connection = $this->connect->getConnection();
			$result = mysqli_query($connection, "SELECT first_name, checkout_date FROM checkout WHERE cart_id = $cartId;");
			return $result;
		}
		
		/**
         * This method is used to show the customer product details,
		 * @return object of the result.
         */
		public function getCustomerCartProducts($cartId)
		{
			$connection = $this->connect->getConnection();
			$result = mysqli_query($connection, "SELECT item_name FROM item WHERE cart_id = $cartId;");
			return $result;
		}
		
		/**
         * This method is used to update order status in the database,
		 * @return object of the result.
         */
		public function changeOrderStatus()
		{
			$connection = $this->connect->getConnection();
			$cartId = intval($_POST['cart_id']);
			$orderStatus = trim($_POST['order_status']);
			$result = mysqli_query($connection,"UPDATE cart
									SET order_status = '$orderStatus'
									WHERE cart_id = $cartId ;");
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
			$cartId = intval($_POST['cart_id']);
			$deleteCheckout = mysqli_query($connection,"DELETE FROM checkout WHERE cart_id = $cartId;");
			$deleteItem = mysqli_query($connection,"DELETE FROM item WHERE cart_id = $cartId;");
			$deleteCart = mysqli_query($connection,"DELETE FROM cart WHERE cart_id = $cartId;");
            return $deleteCart; 
		}
    }

	