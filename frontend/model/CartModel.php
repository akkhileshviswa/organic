<?php
	error_reporting(0);
	/**
	 * This class insert, fetches, delete, update the values in database upon calling the specified function.
	 */
    class CartModel 
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
		 * This method creates the cart for the logged in  user.
		 * @return boolean based on the result.
		 */
        public function createCart()
		{
		    if($_SERVER['REQUEST_METHOD'] == "POST" ){
                $connection = $this->connect->getConnection();
                $user_id = $_SESSION['user_id'];
					try {
						$result =  $connection->query("INSERT INTO cart (user_id) VALUES ($user_id);");
						if(!$result) {
							return false;
							throw new Exception("Error in inserting the user id in the cart");
						} else {
							return true;    
						}
					} catch(Exception $e) {
						echo "Message: " .$e->getMessage();
					}	
			} else {
				return false;
			}
		} 
		/**
		 * This method inserts the products into the cart for the logged in  user.
		 * @return boolean based on the result.
		 */
		public function addToCart()
		{
		    if($_SERVER['REQUEST_METHOD'] == "POST" )
			{
                $connection = $this->connect->getConnection();
                $user_id = $_SESSION['user_id'];
				$product_id = intval($_POST['product_id']);
				$item_name = trim($_POST['product_name']); 
				$item_price = floatval($_POST['price']);
					try {
						$cart_id_result =  $connection->query("SELECT cart_id FROM cart 
															   WHERE user_id = $user_id AND is_active = 1;");
						$cart_id_array = $cart_id_result ->fetch(PDO::FETCH_ASSOC); 
						$cart_id = $cart_id_array['cart_id'];
						$_SESSION['cart_id'] = $cart_id;
						$product_id_result = $connection->query("SELECT product_id, item_quantity, item_price FROM item 
																 WHERE cart_id = $cart_id AND product_id = $product_id;");
						$product_id_array = $product_id_result ->fetch(PDO::FETCH_ASSOC); 
						$product_id_check = $product_id_array['product_id'];
						$quantity_check = $product_id_array['item_quantity'];
						$item_price_check = $product_id_array['item_price'];
						if($product_id_check == $product_id) {
							$addQuantity = $quantity_check +1;
							$total_row_price = number_format(($addQuantity * $item_price_check), 2);
							$quantity = $connection->query("UPDATE item SET item_quantity = $addQuantity, row_total = $total_row_price 
															WHERE cart_id = $cart_id AND product_id = $product_id_check ");
							return true;	
						} else {
							$result =  $connection->query("INSERT INTO item (cart_id,product_id,item_name,item_price, row_total) 
														   VALUES ($cart_id,$product_id,'$item_name',$item_price,$item_price);");
							if(!$result) {
								return false;
								throw new Exception("Error in inserting the products in cart");
							} else {
								return true;    
							}
						}
					} catch(Exception $e) {
						echo "Message: " .$e->getMessage();
					}	
			} else {
				return false;
			}
		}
		/**
		 * This method updates the quantity and total price of the product upon updating the quantity into the item table.
		 */
		public function updateQuantity() 
		{
            if(isset($_POST['item_quantity']))
            {
                $connection = $this->connect->getConnection();
                $item_quantity = intval($_POST['item_quantity']);
                $row_total = floatval($_POST['row_total']); 
                $item_id = intval($_POST['item_id']);
                try{
                    $result =  $connection->query("UPDATE item SET item_quantity = $item_quantity, row_total = $row_total 
													WHERE item_id = $item_id;");
                    if(!$result){
                        throw new Exception("Error in updating the details");
                    }
                }catch(Exception $e){
                    echo "Message: " .$e->getMessage();
                }	   
            }
        }
		/**
		 * This method removes the product from cart upon deleting the product from the cart.
		 */
		public function removeCartItem() 
		{
            if(isset($_POST['item_id'])) {
                $connection = $this->connect->getConnection();
                $item_id = intval($_POST['item_id']);
                try {
                    $result = $connection->query("DELETE FROM item WHERE item_id= $item_id;");
                    if(!$result) {
                        throw new Exception("Error in deleting the details");
                    }
                } catch(Exception $e) {
                    echo "Message: " .$e->getMessage();
                }	   
            }
        }
		/**
		 * This method updates the total amount in the cart page for the products selected.
		 * @return float of total.
		 */
		public function updateCart() 
		{
			$connection = $this->connect->getConnection();
			$cart_id = $_SESSION['cart_id'];
			try {
				$result = $connection->query("SELECT sum(row_total) FROM item WHERE cart_id = $cart_id ;");
				if(!$result) {
					throw new Exception("Error in selecting the details");
				} else {
					$array = $result ->fetch(PDO::FETCH_ASSOC); 
					$grand_total = $array['sum(row_total)'];
					return round($grand_total,2);
				}
			} catch(Exception $e) {
				echo "Message: " .$e->getMessage();
			}	
		}
		/**
		 * This method shows the cart details of the current user.
		 * @return object of the cart details.
		 */
		public function showCartDetails() 
		{
			$connection = $this->connect->getConnection();
			$cart_id = $_SESSION['cart_id'];
			try {
				$result = $connection->query("SELECT item_name, item_quantity, row_total  FROM item WHERE cart_id = $cart_id ;");
				if(!$result) {
					throw new Exception("Error in selecting the details");
				} else {
					return $result;
				}
			} catch(Exception $e) {
				echo "Message: " .$e->getMessage();
			}	
		}
		/**
		 * This method updates and inserts the checkout details for the user in cart and checkout table.
		 * @return boolean of the results.
		 */
		public function checkoutDetails()
		{
			$connection = $this->connect->getConnection();
			$cart_id = $_SESSION['cart_id'];
			$user_id = $_SESSION['user_id'];
			$first_name = trim($_POST['first_name']);
			$last_name = trim($_POST['last_name']);
			$country = trim($_POST['country']);
			$town = trim($_POST['town']);
			$state = trim($_POST['state']);
			$postal_code = intval($_POST['postal_code']);
			$phone = intval($_POST['phone']);
			$email = trim($_POST['email']);
			$address = trim($_POST['address']);
			date_default_timezone_set('Asia/Calcutta');
            $checkout_date = date('M d, Y');  
			$payment_method = trim($_POST['payment_method']);
			$shipping_fee = intval($_POST['shipping_method']);
			if($shipping_fee==2) {
				$shipping_method = "Flat rate";
			} else if($shipping_fee==1) {
				$shipping_method = "Free shipping";
			} else {
				$shipping_method = "Local pickup";
			}
			try {
				$cart = $connection->query("UPDATE cart SET  payment_method = '$payment_method', shipping_method = '$shipping_method',
											updated_date = CURRENT_TIMESTAMP() WHERE cart_id = $cart_id;");				
				$result = $connection->query("INSERT INTO checkout (cart_id, user_id, first_name, last_name, country, town, state, 
												postal_code, phone, email, address , checkout_date) 
												VALUES($cart_id, $user_id, '$first_name', '$last_name', '$country', '$town', 
												'$state', $postal_code, $phone, '$email', '$address', '$checkout_date' );");
				
				if(!($result && $cart)) {
					throw new Exception("Error in inserting and updating the details");
				} else {
					return $result;
				}
			} catch(Exception $e) {
				echo "Message: " .$e->getMessage();
			}
		}
		/**
		 * This method updates total upon selecting the shipping type.
		 * @return boolean of the results.
		 */
		public function checkoutTotal()
		{
			$connection = $this->connect->getConnection();
                $shipping_fee = floatval($_POST['shipping_fee']);
                $grand_total = floatval($_POST['grand_total']); 
                $sub_total = floatval($_POST['sub_total']);
				$cart_id = $_SESSION['cart_id'];
                try {
                    $result =  $connection->query("UPDATE cart SET sub_total = $sub_total,shipping_fee = $shipping_fee, 
													grand_total = $grand_total WHERE cart_id = $cart_id;");
                    if(!$result) {
                        throw new Exception("Error in updating the details");
                    }
                } catch(Exception $e) {
                    echo "Message: " .$e->getMessage();
                }	  
		}
		/**
		 * This method gets the order details for the user upon completing the checkout.
		 * @return object of the results.
		 */
		public function orderDetails()
		{
			$connection = $this->connect->getConnection();
			$cart_id = $_SESSION['cart_id'];
			$user_id = $_SESSION['user_id'];
			try {
				$result = $connection->query("SELECT grand_total, shipping_method, payment_method  FROM cart 
												WHERE cart_id = $cart_id AND user_id = $user_id ;");
				if(!$result) {
					throw new Exception("Error in selecting the details");
				} else {
					return $result;
				}
			} catch(Exception $e) {
				echo "Message: " .$e->getMessage();
			}	
		}
		/**
		 * This method gets the details of the customer who is checked out
		 * @return object of customer details. 
		 */
		public function customerDetails()
		{
			$connection = $this->connect->getConnection();
			$cart_id = $_SESSION['cart_id'];
			$user_id = $_SESSION['user_id'];
			try {
				$result = $connection->query("SELECT phone, email, address, checkout_date  FROM checkout 
												WHERE cart_id = $cart_id AND user_id = $user_id ;");
				if(!$result) {
					throw new Exception("Error in selecting the details");
				} else {
					return $result;
				}
			} catch(Exception $e) {
				echo "Message: " .$e->getMessage();
			}	
		}
		/**
		 * This method gets the address of the customer who is checked out
		 * @return object of address. 
		 */
		public function getAddress() 
		{
			$connection = $this->connect->getConnection();
			$user_id = $_SESSION['user_id'];
			try {
				$result = $connection->query("SELECT address FROM checkout WHERE user_id = $user_id;");
				if(!$result) {
					throw new Exception("Error in selecting the details");
				} else {
					return $result;
				}
			} catch(Exception $e) {
				echo "Message: " .$e->getMessage();
			}
		}
		/**
		 * This method gets cart details of the customer who is checked out
		 * @return object of account details. 
		 */
		public function getMyAcccountCartDetails()
		{
			$connection = $this->connect->getConnection();
			$user_id = $_SESSION['user_id'];
			try {
				$result = $connection->query("SELECT cart.cart_id, checkout.checkout_date, cart.grand_total, cart.order_status
											  FROM cart JOIN checkout ON cart.cart_id = checkout.cart_id
											  WHERE cart.user_id = $user_id;");
				if(!$result) {
					throw new Exception("Error in selecting the details");
				} else {
					return $result;
				}
			} catch(Exception $e) {
				echo "Message: " .$e->getMessage();
			}
		}
		/**
		 * This method gets cart product details of the customer who is checked out
		 * @return object of account cart products. 
		 */
		public function getMyAcccountCartProducts( $cart_id)
		{
			$connection = $this->connect->getConnection();
			$user_id = $_SESSION['user_id'];
			try{
				$result = $connection->query("SELECT item.item_name FROM item 
											  JOIN cart ON item.cart_id = cart.cart_id
											  WHERE cart.user_id = $user_id AND item.cart_id = $cart_id;");
				if(!$result) {
					throw new Exception("Error in selecting the details");
				} else {
					return $result;
				}
			} catch(Exception $e) {
				echo "Message: " .$e->getMessage();
			}
		}
	} 
    