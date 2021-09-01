<?php
	/**
	 * This class insert, fetches, delete, update the values in database upon calling the specified function.
	 */
    class CartModel 
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
		 * This method creates the cart for the logged in  user.
		 * @return boolean based on the result.
		 */
        public function createCart()
		{
		    if($_SERVER['REQUEST_METHOD'] == "POST" ){
                $connection = $this->instance->getConnection();
                $userId = $_SESSION['user_id'];
					try {
							$statement =  $connection->prepare("INSERT INTO cart (user_id) VALUES (:userId);");
							$statement->bindParam(':userId', $userId);
							$result = $statement->execute();
							if(!$result) {
								return false;
								throw new Exception("Error in inserting the user id in the cart");
							} else {
								return true;    
							}
					} catch(Exception $e) {
						throw "Message: " .$e->getMessage();
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
                $connection = $this->instance->getConnection();
                $userId = $_SESSION['user_id'];
				$productId = intval($_POST['product_id']);
				$itemName = trim($_POST['product_name']); 
				$itemPrice = floatval($_POST['price']);
				try {
					$cartIdResult =  $connection->query("SELECT cart_id FROM cart 
															WHERE user_id = $userId AND is_active = 1;");
					$cartIdArray = $cartIdResult ->fetch(PDO::FETCH_ASSOC); 
					$cartId = $cartIdArray['cart_id'];
					$_SESSION['cart_id'] = $cartId;
					$productIdResult = $connection->query("SELECT product_id, item_quantity, item_price FROM item 
																WHERE cart_id = $cartId AND product_id = $productId;");
					$productIdArray = $productIdResult ->fetch(PDO::FETCH_ASSOC); 
					$productIdCheck = $productIdArray['product_id'];
					$quantityCheck = $productIdArray['item_quantity'];
					$itemPriceCheck = $productIdArray['item_price'];
					if($productIdCheck == $productId) {
						$addQuantity = $quantityCheck + 1;
						$totalRowPrice = number_format(($addQuantity * $itemPriceCheck), 2);
						$statement = $connection->query("UPDATE item SET item_quantity = :addQuantity, row_total = :totalRowPrice 
														WHERE cart_id = $cartId AND product_id = $productIdCheck ");
						$statement->bindParam(':addQuantity', $addQuantity);
						$statement->bindParam(':totalRowPrice', $totalRowPrice);
						$result = $statement->execute();
						return true;	
					} else {
						$statement =  $connection->prepare("INSERT INTO item (cart_id,product_id,item_name,item_price, row_total) 
														VALUES (:cartId, :productId, :itemName, :itemPrice, :rowTotal);");
						$statement->bindParam(':cartId', $cartId);
						$statement->bindParam(':productId', $productId);
						$statement->bindParam(':itemName', $itemName);
						$statement->bindParam(':itemPrice', $itemPrice);
						$statement->bindParam(':rowTotal', $itemPrice);
						$result = $statement->execute();
						if(!$result) {
							return false;
							throw new Exception("Error in inserting the products in cart");
						} else {
							return true;    
						}
					}
				} catch(Exception $e) {
					throw "Message: " .$e->getMessage();
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
				$connection = $this->instance->getConnection();
                $itemQuantity = intval($_POST['item_quantity']);
                $rowTotal = floatval($_POST['row_total']); 
                $itemId = intval($_POST['item_id']);
                try{
                    $statement =  $connection->prepare("UPDATE item SET item_quantity = :itemQuantity, row_total = :rowTotal 
													WHERE item_id = $itemId;");
					$statement->bindParam(':itemQuantity', $itemQuantity);
					$statement->bindParam(':rowTotal', $rowTotal);
					$result = $statement->execute();
                    if(!$result){
                        throw new Exception("Error in updating the details");
                    }
                }catch(Exception $e){
                    throw "Message: " .$e->getMessage();
                }	   
            }
        }
		
		/**
		 * This method removes the product from cart upon deleting the product from the cart.
		 */
		public function removeCartItem() 
		{
            if(isset($_POST['item_id'])) {
                $connection = $this->instance->getConnection();
                $itemId = intval($_POST['item_id']);
                try {
                    $result = $connection->query("DELETE FROM item WHERE item_id= $itemId;");
                    if(!$result) {
                        throw new Exception("Error in deleting the details");
                    }
                } catch(Exception $e) {
                    throw "Message: " .$e->getMessage();
                }	   
            }
        }
		
		/**
		 * This method updates the total amount in the cart page for the products selected.
		 * @return float of total.
		 */
		public function updateCart() 
		{
			$connection = $this->instance->getConnection();
			$cartId = $_SESSION['cart_id'];
			try {
				$result = $connection->query("SELECT sum(row_total) FROM item WHERE cart_id = $cartId ;");
				if(!$result) {
					throw new Exception("Error in selecting the details");
				} else {
					$array = $result ->fetch(PDO::FETCH_ASSOC); 
					$grandTotal = $array['sum(row_total)'];
					return round($grandTotal,2);
				}
			} catch(Exception $e) {
				throw "Message: " .$e->getMessage();
			}	
		}
		
		/**
		 * This method shows the cart details of the current user.
		 * @return object of the cart details.
		 */
		public function showCartDetails() 
		{
			$connection = $this->instance->getConnection();
			$cartId = $_SESSION['cart_id'];
			try {
				$result = $connection->query("SELECT item_name, item_quantity, row_total  FROM item WHERE cart_id = $cartId ;");
				if(!$result) {
					throw new Exception("Error in selecting the details");
				} else {
					return $result;
				}
			} catch(Exception $e) {
				throw "Message: " .$e->getMessage();
			}	
		}
		
		/**
		 * This method updates and inserts the checkout details for the user in cart and checkout table.
		 * @return boolean of the results.
		 */
		public function checkoutDetails()
		{
			$connection = $this->instance->getConnection();
			$cartId = $_SESSION['cart_id'];
			$userId = $_SESSION['user_id'];
			$firstName = trim($_POST['first_name']);
			$lastName = trim($_POST['last_name']);
			$country = trim($_POST['country']);
			$town = trim($_POST['town']);
			$state = trim($_POST['state']);
			$postalCode = intval($_POST['postal_code']);
			$phone = intval($_POST['phone']);
			$email = trim($_POST['email']);
			$address = trim($_POST['address']);
			date_default_timezone_set('Asia/Calcutta');
            $checkoutDate = date('M d, Y');  
			$isActive = intval(0);
			$paymentMethod = trim($_POST['payment_method']);
			$shippingFee = intval($_POST['shipping_method']);
			if($shippingFee == 2) {
				$shippingMethod = "Flat rate";
			} else if($shippingFee == 1) {
				$shippingMethod = "Free shipping";
			} else {
				$shippingMethod = "Local pickup";
			}
			try {
				$cart = $connection->query("UPDATE cart SET is_active = $isActive, payment_method = '$paymentMethod', shipping_method = '$shippingMethod'
											WHERE cart_id = $cartId;");				
				$statement = $connection->prepare("INSERT INTO checkout (cart_id, user_id, first_name, last_name, country, town, state, 
												postal_code, phone, email, address , checkout_date) 
												VALUES(:cartId, :userId, :firstName, :lastName, :country, :town, 
												:state, :postalCode, :phone, :email, :address, :checkoutDate);");
				$statement->bindParam(':cartId', $cartId);
				$statement->bindParam(':userId', $userId);
				$statement->bindParam(':firstName', $firstName );
				$statement->bindParam(':lastName', $lastName);
				$statement->bindParam(':country', $country);
				$statement->bindParam(':town', $town);
				$statement->bindParam(':state', $state);
				$statement->bindParam(':postalCode', $postalCode);
				$statement->bindParam(':phone', $phone);
				$statement->bindParam(':email', $email);
				$statement->bindParam(':address', $address);
				$statement->bindParam(':checkoutDate', $checkoutDate);
				$result = $statement->execute();
				if(!($result && $cart)) {
					throw new Exception("Error in inserting and updating the details");
				} else {
					return $result;
				}
			} catch(Exception $e) {
				throw "Message: " .$e->getMessage();
			}
		}
		
		/**
		 * This method updates total upon selecting the shipping type.
		 * @return boolean of the results.
		 */
		public function checkoutTotal()
		{
			$connection = $this->instance->getConnection();
			$shippingFee = floatval($_POST['shipping_fee']);
			$grandTotal = floatval($_POST['grand_total']); 
			$subTotal = floatval($_POST['sub_total']);
			$cartId = $_SESSION['cart_id'];
			try {
				$statement =  $connection->prepare("UPDATE cart SET sub_total = :subTotal, shipping_fee = :shippingFee, 
												grand_total = $grandTotal WHERE cart_id = $cartId;");
				$statement->bindParam(':subTotal', $subTotal);
				$statement->bindParam(':shippingFee', $shippingFee);
				$result = $statement->execute();
				if(!$result) {
					throw new Exception("Error in updating the details");
				}
			} catch(Exception $e) {
				throw "Message: " .$e->getMessage();
			}	  
		}
		
		/**
		 * This method gets the order details for the user upon completing the checkout.
		 * @return object of the results.
		 */
		public function orderDetails()
		{
			$connection = $this->instance->getConnection();
			$cartId = $_SESSION['cart_id'];
			$userId = $_SESSION['user_id'];
			try {
				$result = $connection->query("SELECT grand_total, shipping_method, payment_method  FROM cart 
												WHERE cart_id = $cartId AND user_id = $userId ;");
				if(!$result) {
					throw new Exception("Error in selecting the details");
				} else {
					return $result;
				}
			} catch(Exception $e) {
				throw "Message: " .$e->getMessage();
			}	
		}
		
		/**
		 * This method gets the details of the customer who is checked out
		 * @return object of customer details. 
		 */
		public function customerDetails()
		{
			$connection = $this->instance->getConnection();
			$cartId = $_SESSION['cart_id'];
			$userId = $_SESSION['user_id'];
			try {
				$result = $connection->query("SELECT phone, email, address, checkout_date  FROM checkout 
												WHERE cart_id = $cartId AND user_id = $userId ;");
				if(!$result) {
					throw new Exception("Error in selecting the details");
				} else {
					return $result;
				}
			} catch(Exception $e) {
				throw "Message: " .$e->getMessage();
			}	
		}
		
		/**
		 * This method gets the address of the customer who is checked out
		 * @return object of address. 
		 */
		public function getAddress() 
		{
			$connection = $this->instance->getConnection();
			$userId = $_SESSION['user_id'];
			try {
				$result = $connection->query("SELECT address FROM checkout WHERE user_id = $userId;");
				if(!$result) {
					throw new Exception("Error in selecting the details");
				} else {
					return $result;
				}
			} catch(Exception $e) {
				throw "Message: " .$e->getMessage();
			}
		}
		
		/**
		 * This method gets cart details of the customer who is checked out
		 * @return object of account details. 
		 */
		public function getMyAcccountCartDetails()
		{
			$connection = $this->instance->getConnection();
			$userId = $_SESSION['user_id'];
			try {
				$result = $connection->query("SELECT cart.cart_id, checkout.checkout_date, cart.grand_total, cart.order_status
											  FROM cart JOIN checkout ON cart.cart_id = checkout.cart_id
											  WHERE cart.user_id = $userId;");
				if(!$result) {
					throw new Exception("Error in selecting the details");
				} else {
					return $result;
				}
			} catch(Exception $e) {
				throw "Message: " .$e->getMessage();
			}
		}
		
		/**
		 * This method gets cart product details of the customer who is checked out
		 * @return object of account cart products. 
		 */
		public function getMyAcccountCartProducts($cartId)
		{
			$connection = $this->instance->getConnection();
			$userId = $_SESSION['user_id'];
			try{
				$result = $connection->query("SELECT item.item_name, item.item_quantity FROM item 
											  JOIN cart ON item.cart_id = cart.cart_id
											  WHERE cart.user_id = $userId AND item.cart_id = $cartId;");
				if(!$result) {
					throw new Exception("Error in selecting the details");
				} else {
					return $result;
				}
			} catch(Exception $e) {
				throw "Message: " .$e->getMessage();
			}
		}
	} 
    