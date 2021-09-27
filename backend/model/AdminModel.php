<?php   
	trait Admin {
		/**
         * This method is used to show the customer checkout details,
		 * @return object of the result.
         */
		public function customerDetails($cartId)
		{
			$connection = $this->connect->getConnection();
			mysqli_autocommit($connection,FALSE);
			$result = mysqli_query($connection, "SELECT first_name, checkout_date FROM checkout WHERE cart_id = $cartId;");
			if ($cartId > 0) {
				mysqli_autocommit($connection,TRUE);
			} else {
				mysqli_rollback($connection);
			}
			return $result;
		}
	}

	/**
	 * This class insert, fetches, delete, update the values in database upon calling the specified function.
	 */
    class AdminModel 
	{
        private $connect;
		
		/**
		 * Using the trait named Model which has the function customer details defined in it.
		 */
		use Admin;

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
			if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['name'] != "" && $_POST['password'] != "" ) {
				$connection = $this->connect->getConnection();
				$name = trim($_POST['name']);
				$password = trim($_POST['password']);
				$mdPassword = md5($password);
				try {
					mysqli_autocommit($connection,FALSE);
					$result = mysqli_query($connection, "SELECT * FROM admin WHERE username = '$name' AND password = '$mdPassword';");
					if ($name != "") {
						mysqli_autocommit($connection,TRUE);
					} else {
						mysqli_rollback($connection);
					}
					if (!$result) {
						throw new Exception("Error in Selecting");
					}
				} catch (Exception $e) {
					throw "Message: " .$e->getMessage();
				}
				$row = mysqli_fetch_array($result);
				if ($row['username'] == $name && $row['password'] == $mdPassword) {
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
			mysqli_autocommit($connection,FALSE);
            $result = mysqli_query($connection, "SELECT * FROM admin WHERE user_id = $userId ;");
			if ($userId > 0) {
				mysqli_autocommit($connection,TRUE);
			} else {
				mysqli_rollback($connection);
			}
            return $result; 
        }
		
		/**
         * This method is used to display the existing products from the database,
		 * @return object of the result.
         */
		public function showProducts()
		{
            $connection = $this->connect->getConnection();
            $result = mysqli_query($connection, "SELECT * FROM product ;");
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
			mysqli_autocommit($connection,FALSE);
			$result = mysqli_query($connection, "SELECT product_id, product_name, price, quantity FROM product 
									WHERE product_id = $productId ;");
			if ($productId > 0) {
				mysqli_autocommit($connection,TRUE);
			} else {
				mysqli_rollback($connection);
			}
            return $result; 
		}
		
		/**
         * This method is used to update product details in the database,
		 * @return object of the result.
         */
		public function updateEditedProduct()
		{
			if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['product_id'] != "" && $_POST['product_name'] != "" 
				&& $_POST['price'] != "" && $_POST['quantity'] != "" ) {
				$connection = $this->connect->getConnection();
				$productId = intval($_POST['product_id']);
				$productName = trim($_POST['product_name']);
				$price = floatval($_POST['price']);
				$quantity = intval($_POST['quantity']);
				mysqli_autocommit($connection,FALSE);
				$result = mysqli_query($connection, "UPDATE product 
										SET product_name = '$productName', price = $price, quantity = $quantity
										WHERE product_id = $productId ;");
				if ($price > 0 && strlen($productName) > 5) {
					mysqli_autocommit($connection,TRUE);
				} elseif (strlen($productName) < 5) {
					mysqli_rollback($connection);
					return 3;
				} else {
					mysqli_rollback($connection);
					return 2;
				}
				return $result; 
			}
		}
		
		/**
         * This method is used to create a new product and insert it into the database,
		 * @return object of the result.
         */
		public function createProduct() 
		{	
			if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['product_name'] != "" && $_POST['price'] != "" && $_POST['price'] != 0
				&& $_POST['quantity'] != "" && $_FILES['file']['name'] != "" ) {
				$connection = $this->connect->getConnection();
				$productName = trim($_POST['product_name']);
				$price = floatval($_POST['price']);
				$quantity = intval($_POST['quantity']);
				$image = $_FILES['file']['name'];
				mysqli_autocommit($connection,FALSE);
				$result = mysqli_query($connection, "INSERT INTO product (product_name, price, quantity, image) 
										VALUES ('$productName', $price, $quantity, '$image');");
				if (strlen($productName) > 5 && $price > 0) {
					mysqli_autocommit($connection,TRUE);
				} elseif ($price == 0 ) {
					mysqli_rollback($connection);
					return 3;
				} else {
					mysqli_rollback($connection);
					return 2;
				}
				return $result;		
			}	
		}

		/**
         * This method is used to delete the corresponding order details, checkout details and cart details 
		 * for the corresponding customer in the database,
		 * @return string of the result.
         */
		public function enableOrDisableProduct()
		{
			$connection = $this->connect->getConnection();
			$productId = intval($_POST['product_id']);
			$isActive = intval($_POST['is_active']);
			mysqli_autocommit($connection,FALSE);
			$result = mysqli_query($connection, "UPDATE product
									SET is_active = $isActive
									WHERE product_id = $productId ;");
			if ($productId > 0) {
				mysqli_autocommit($connection,TRUE);
			} else {
				mysqli_rollback($connection);
			}
			return $result;
		}
		
		/**
         * This method is used to display the existing customers from the database,
		 * @return object of the result.
         */
		public function showCustomers()
		{
            $connection = $this->connect->getConnection();
            $result = mysqli_query($connection, "SELECT * FROM users ;");
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
			mysqli_autocommit($connection,FALSE);
			$result = mysqli_query($connection, "SELECT user_id, username, email FROM users WHERE user_id = $userId ;");
			if ($userId > 0) {
				mysqli_autocommit($connection,TRUE);
			} else {
				mysqli_rollback($connection);
			}
            return $result; 
		}
		
		/**
         * This method is used to update customer details in the database,
		 * @return object of the result.
         */
		public function updateEditedCustomer()
		{
			if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['username'] != "" && $_POST['email'] != "" && $_POST['user_id'] != "") {
				$connection = $this->connect->getConnection();
				$userId = intval($_POST['user_id']);
				$username = trim($_POST['username']);
				$email = trim($_POST['email']);
				mysqli_autocommit($connection,FALSE);
				$statement = mysqli_query($connection, "SELECT * FROM users WHERE username = '$username';");
				if ($username != "") {
					mysqli_autocommit($connection,TRUE);
				} else {
					mysqli_rollback($connection);
				}
				$row = $statement->fetch_assoc();
				mysqli_autocommit($connection,FALSE);
				$emailCheck = mysqli_query($connection, "SELECT * FROM users WHERE email = '$email';");
				if ($email != "") {
					mysqli_autocommit($connection,TRUE);
				} else {
					mysqli_rollback($connection);
				}
				$rowEmailCheck = $emailCheck->fetch_assoc();
				if ($row['username'] == $username) {
					if ($row['user_id'] == $userId) {
						if ($rowEmailCheck['email'] == $email) { 
							return 4;
						} else {
							mysqli_autocommit($connection,FALSE);
							$result = mysqli_query($connection, "UPDATE users 
													SET email = '$email'
													WHERE user_id = $userId ;");
							if ($userId > 0) {
								mysqli_autocommit($connection,TRUE);
							} else {
								mysqli_rollback($connection);
							}
							return $result; 
						}
					} else {
						return 2;
					}
				} elseif ($rowEmailCheck['email'] == $email) {
					if ($rowEmailCheck['user_id'] == $userId) {
						mysqli_autocommit($connection,FALSE);
						$result = mysqli_query($connection, "UPDATE users 
												SET username = '$username'
												WHERE user_id = $userId ;");
						if ($userId > 0) {
							mysqli_autocommit($connection,TRUE);
						} else {
							mysqli_rollback($connection);
						}
						return $result;
					} else {
						return 3;
					}
				} else {
					mysqli_autocommit($connection,FALSE);
					$result = mysqli_query($connection, "UPDATE users 
											SET username = '$username', email = '$email'
											WHERE user_id = $userId ;");
					if ($userId > 0) {
						mysqli_autocommit($connection,TRUE);
					} else {
						mysqli_rollback($connection);
					}
					return $result; 
				}
			}
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
									WHERE is_active = $isActive ORDER BY cart_id DESC ;");
			return $result;
		}
		
		/**
         * This method is used to show the customer product details,
		 * @return object of the result.
         */
		public function getCustomerCartProducts($cartId)
		{
			$connection = $this->connect->getConnection();
			mysqli_autocommit($connection,FALSE);
			$result = mysqli_query($connection, "SELECT item_name FROM item WHERE cart_id = $cartId;");
			if ($cartId > 0) {
				mysqli_autocommit($connection,TRUE);
			} else {
				mysqli_rollback($connection);
				return 2;
			}
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
			mysqli_autocommit($connection,FALSE);
			$result = mysqli_query($connection, "UPDATE cart
									SET order_status = '$orderStatus'
									WHERE cart_id = $cartId ;");
			if ($cartId > 0) {
				mysqli_autocommit($connection,TRUE);
			} else {
				mysqli_rollback($connection);
			}
            return $result; 
		}
		
		/**
         * This method is used to delete the corresponding order details, checkout details and cart details 
		 * for the corresponding customer in the database,
		 * @return boolean of the result.
         */
		public function removeOrder()
		{
			$connection = $this->connect->getConnection();
			$cartId = intval($_POST['cart_id']);
			mysqli_autocommit($connection,FALSE);
			$deleteCheckout = mysqli_query($connection, "DELETE FROM checkout WHERE cart_id = $cartId;");
			if ($deleteCheckout == 1) {
				$deleteItem = mysqli_query($connection, "DELETE FROM item WHERE cart_id = $cartId;");
				if ($deleteItem == 1) {
					$deleteCart = mysqli_query($connection, "DELETE FROM cart WHERE cart_id = $cartId;");
				}
			}
			if ($deleteCart == 1 && $cartId > 0) {
				mysqli_autocommit($connection,TRUE);
			} else {
				mysqli_rollback($connection);
				return 2;
			}
            return $deleteCart; 
		}
    }
