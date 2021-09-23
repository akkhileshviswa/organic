<?php
	/**
	 * This class insert, fetches, delete, update the values in database upon calling the specified function.
	 */
    class CartModel 
	{
        private $instance;
        private $session;

        /**
         * This method is used to create a object for Database class.
         */
        public function __construct()
        {
            $this->instance = Database::getInstance();
			$this->session = SessionId::session();
        }
		
		/**
		 * This method creates the cart for the logged in user.
		 * @return boolean based on the result.
		 */
        public function createCart()
		{
		    if (isset($_SESSION['user_id'])) {
                $connection = $this->instance->getConnection();
                $userId = $this->session['userId'];
					try {
						$statement =  $connection->prepare("INSERT INTO cart (user_id) VALUES (:userId);");
						$statement->bindParam(':userId', $userId);
						$result = $statement->execute();
						if (!$result) {
							return false;
						} else {
							return true;    
						}
					} catch (Exception $e) {
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
		    if (!empty($_POST['product_id']) && !empty($_POST['product_name']) && !empty($_POST['price'])) {
                $connection = $this->instance->getConnection();
                $userId = $this->session['userId'];
				$productId = intval($_POST['product_id']);
				$itemName = trim($_POST['product_name']); 
				$itemPrice = floatval($_POST['price']);
				$isActive = intval(1);
				try {
					$cartIdResult =  $connection->prepare("SELECT cart_id FROM cart 
															WHERE user_id = :userId AND is_active = :isActive ;");
					$cartIdResult->bindParam(':userId', $userId);
					$cartIdResult->bindParam(':isActive', $isActive);
					$cartIdResult->execute();
					$cartIdArray = $cartIdResult ->fetch(PDO::FETCH_ASSOC); 
					$cartId = $cartIdArray['cart_id'];
					$_SESSION['cart_id'] = $cartId;
					$productIdResult = $connection->prepare("SELECT product_id, item_quantity, item_price FROM item 
																WHERE cart_id = :cartId AND product_id = :productId;");
					$productIdResult->bindParam(':cartId', $cartId);
					$productIdResult->bindParam(':productId', $productId);
					$productIdResult->execute();

					$productIdArray = $productIdResult ->fetch(PDO::FETCH_ASSOC); 
					$productIdCheck = $productIdArray['product_id'];
					$quantityCheck = $productIdArray['item_quantity'];
					$itemPriceCheck = $productIdArray['item_price'];
					if ($productIdCheck == $productId) {
						$addQuantity = $quantityCheck + 1;
						$totalRowPrice = number_format(($addQuantity * $itemPriceCheck), 2);
						$statement = $connection->prepare("UPDATE item SET item_quantity = :addQuantity, row_total = :totalRowPrice 
															WHERE cart_id = :cartId AND product_id = :productIdCheck ;");
						$statement->bindParam(':addQuantity', $addQuantity);
						$statement->bindParam(':totalRowPrice', $totalRowPrice);
						$statement->bindParam(':cartId', $cartId);
						$statement->bindParam(':productIdCheck', $productIdCheck);
						$result = $statement->execute();
						return true;	
					} else {
						$statement =  $connection->prepare("INSERT INTO item (cart_id,product_id,item_name,item_price, row_total) 
															VALUES (:cartId, :productId, :itemName, :itemPrice, :rowTotal);");
						$statement->bindParam(':cartId', $cartId);
						$statement->bindParam(':productId', $productId);
						$statement->bindParam(':itemName', $itemName);
						$statement->bindParam(':itemPrice', $itemPrice, PDO::PARAM_STR);
						$statement->bindParam(':rowTotal', $itemPrice, PDO::PARAM_STR);
						$result = $statement->execute();
						if (!$result) {
							return false;
						} else {
							return true;    
						}
					}
				} catch (Exception $e) {
					throw "Message: " .$e->getMessage();
				}	
			} else {
				return false;
			}
		}
		
		/**
		 * This method updates the quantity and total price of the product upon updating the quantity into the item table.
		 * @return null
		 */
		public function updateQuantity() 
		{
            if (!empty($_POST['item_quantity']) && !empty($_POST['row_total']) && !empty($_POST['item_id'])) {
				$connection = $this->instance->getConnection();
                $itemQuantity = intval($_POST['item_quantity']);
                $rowTotal = floatval($_POST['row_total']); 
                $itemId = intval($_POST['item_id']);
                try {
                    $statement =  $connection->prepare("UPDATE item SET item_quantity = :itemQuantity, row_total = :rowTotal 
														WHERE item_id = :itemId;");
					$statement->bindParam(':itemQuantity', $itemQuantity);
					$statement->bindParam(':rowTotal', $rowTotal);
					$statement->bindParam(':itemId', $itemId);
					$result = $statement->execute();
                    if (!$result){
                        throw new Exception("Error in updating the details");
                    }
                }catch (Exception $e){
                    throw "Message: " .$e->getMessage();
                }	   
            } else {
				return false;
			}
        }
		
		/**
		 * This method removes the product from cart upon deleting the product from the cart.
		 * @return null
		 */
		public function removeCartItem() 
		{
            if (!empty($_POST['item_id'])) {
                $connection = $this->instance->getConnection();
                $itemId = intval($_POST['item_id']);
                try {
                    $statement = $connection->prepare("DELETE FROM item WHERE item_id = :itemId;");
					$statement->bindParam(':itemId', $itemId);
					$result = $statement->execute();
                    if (!$result) {
                        throw new Exception("Error in deleting the details");
                    }
                } catch (Exception $e) {
                    throw "Message: " .$e->getMessage();
                }	   
            } else {
				return false;
			}
        }
		
		/**
		 * This method updates the total amount in the cart page for the products selected.
		 * @return float of total.
		 */
		public function updateCart() 
		{
			if (isset($_SESSION['cart_id'])) {
				$connection = $this->instance->getConnection();
				$cartId = $this->session['cartId'];
				try {
					$result = $connection->prepare("SELECT sum(row_total) FROM item WHERE cart_id = :cartId ;");
					$result->bindParam(':cartId', $cartId);
					$result->execute();
					if (!$result) {
						throw new Exception("Error in selecting the details");
					} else {
						$array = $result ->fetch(PDO::FETCH_ASSOC); 
						$grandTotal = $array['sum(row_total)'];
						return round($grandTotal,2);
					}
				} catch (Exception $e) {
					throw "Message: " .$e->getMessage();
				}	
			} else {
				return false;
			}
		}
		
		/**
		 * This method shows the cart details of the current user.
		 * @return object of the cart details.
		 */
		public function showCartDetails() 
		{
			if (isset($_SESSION['cart_id'])) {
				$connection = $this->instance->getConnection();
				$cartId = $this->session['cartId'];
				try {
					$result = $connection->prepare("SELECT item_name, item_quantity, row_total  FROM item WHERE cart_id = :cartId ;");
					$result->bindParam(':cartId', $cartId);
					$result->execute();
					if (!$result) {
						throw new Exception("Error in selecting the details");
					} else {
						return $result;
					}
				} catch (Exception $e) {
					throw "Message: " .$e->getMessage();
				}
			} else {
				return false;
			}	
		}
		
		/**
		 * This method updates and inserts the checkout details for the user in cart and checkout table.
		 * @return boolean of the results.
		 */
		public function checkoutDetails()
		{ 
			if (isset($_SESSION['cart_id']) && isset($_SESSION['user_id']) 
				&& !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['country']) && !empty($_POST['town'])
				&& !empty($_POST['state'])&& !empty($_POST['postal_code'])&& !empty($_POST['phone']) && !empty($_POST['email'])
				 && !empty($_POST['address'])  && !empty($_POST['payment_method']) && isset($_POST['shipping_method'])) {
				$connection = $this->instance->getConnection();
				$cartId = $this->session['cartId'];
				$userId = $this->session['userId'];
				$firstName = trim($_POST['first_name']);
				$lastName = trim($_POST['last_name']);
				$country = trim($_POST['country']);
				$town = trim($_POST['town']);
				$state = trim($_POST['state']);
				$postalCode = intval($_POST['postal_code']);
				$phone = intval($_POST['phone']);
				$email = trim($_POST['email']);
				$address = trim($_POST['address']);
				$company = trim($_POST['companyname']);
				date_default_timezone_set('Asia/Calcutta');
				$checkoutDate = date('M d, Y');  
				$isActive = intval(0);
				$paymentMethod = trim($_POST['payment_method']);
				$shippingFee = intval($_POST['shipping_method']);
				if ($shippingFee == 2) {
					$shippingMethod = "Flat rate";
				} elseif ($shippingFee == 1) {
					$shippingMethod = "Free shipping";
				} else {
					$shippingMethod = "Local pickup";
				}
				try {
					$cart = $connection->prepare("UPDATE cart SET is_active = :isActive, payment_method = :paymentMethod, 
												shipping_method = :shippingMethod WHERE cart_id = :cartId;");
					$cart->bindParam(':isActive', $isActive);
					$cart->bindParam(':paymentMethod', $paymentMethod);
					$cart->bindParam(':shippingMethod', $shippingMethod);
					$cart->bindParam(':cartId', $cartId);
					$cart->execute();				
					$statement = $connection->prepare("INSERT INTO checkout (cart_id, user_id, first_name, last_name, country, town, state, 
														postal_code, phone, email, address, company, checkout_date) 
														VALUES(:cartId, :userId, :firstName, :lastName, :country, :town, 
														:state, :postalCode, :phone, :email, :address, :company, :checkoutDate);");
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
					$statement->bindParam(':company', $company);
					$statement->bindParam(':checkoutDate', $checkoutDate);
					$result = $statement->execute();
					if (!($result && $cart)) {
						throw new Exception("Error in inserting and updating the details");
					} else {
						return $result;
					}
				} catch (Exception $e) {
					throw "Message: " .$e->getMessage();
				}
			} else {
				return false;
			}	
		}
		
		/**
		 * This method updates total upon selecting the shipping type.
		 * @return boolean of the results.
		 */
		public function checkoutTotal()
		{	
			if (isset($_SESSION['cart_id']) && isset($_POST['shipping_fee']) && !empty($_POST['grand_total']) 
				&& isset($_POST['sub_total'])) {
				$connection = $this->instance->getConnection();
				$shippingFee = floatval($_POST['shipping_fee']);
				$grandTotal = floatval($_POST['grand_total']); 
				$subTotal = floatval($_POST['sub_total']);
				$cartId = $this->session['cartId'];
				try {
					$statement =  $connection->prepare("UPDATE cart SET sub_total = :subTotal, shipping_fee = :shippingFee, 
														grand_total = :grandTotal WHERE cart_id = :cartId;");
					$statement->bindParam(':subTotal', $subTotal);
					$statement->bindParam(':shippingFee', $shippingFee);
					$statement->bindParam(':cartId', $cartId);
					$statement->bindParam(':grandTotal', $grandTotal);
					$result = $statement->execute();
					if (!$result) {
						throw new Exception("Error in updating the details");
					}
				} catch (Exception $e) {
					throw "Message: " .$e->getMessage();
				}
			} else {
				return false;
			}		  
		}
		
		/**
		 * This method gets the order details for the user upon completing the checkout.
		 * @return object of the results.
		 */
		public function orderDetails()
		{
			if (isset($_SESSION['cart_id']) && isset($_SESSION['user_id'])) {
				$connection = $this->instance->getConnection();
				$cartId = $this->session['cartId'];
				$userId = $this->session['userId'];
				try {
					$result = $connection->prepare("SELECT grand_total, shipping_method, payment_method  FROM cart 
													WHERE cart_id = :cartId AND user_id = :userId ;");
					$result->bindParam(':cartId', $cartId);
					$result->bindParam(':userId', $userId);
					$result->execute();
					if (!$result) {
						throw new Exception("Error in selecting the details");
					} else {
						return $result;
					}
				} catch (Exception $e) {
					throw "Message: " .$e->getMessage();
				}	
			} else {
				return false;
			}	
		}
		
		/**
		 * This method gets the details of the customer who is checked out
		 * @return object of customer details. 
		 */
		public function customerDetails()
		{
			if (isset($_SESSION['cart_id']) && isset($_SESSION['user_id'])) {
				$connection = $this->instance->getConnection();
				$cartId = $this->session['cartId'];
				$userId = $this->session['userId'];
				try {
					$result = $connection->prepare("SELECT phone, email, address, checkout_date  FROM checkout 
													WHERE cart_id = :cartId AND user_id = :userId ;");
					$result->bindParam(':cartId', $cartId);
					$result->bindParam(':userId', $userId);
					$result->execute();
					if (!$result) {
						throw new Exception("Error in selecting the details");
					} else {
						return $result;
					}
				} catch (Exception $e) {
					throw "Message: " .$e->getMessage();
				}	
			} else {
				return false;
			}	
		}
		
		/**
		 * This method gets the address of the customer who is checked out
		 * @return object of address. 
		 */
		public function getAddress() 
		{
			if (isset($_SESSION['user_id'])) {
				$connection = $this->instance->getConnection();
				$userId = $this->session['userId'];
				try {
					$result = $connection->prepare("SELECT address FROM checkout WHERE user_id = :userId;");
					$result->bindParam(':userId', $userId);
					$result->execute();
					if (!$result) {
						throw new Exception("Error in selecting the details");
					} else {
						return $result;
					}
				} catch (Exception $e) {
					throw "Message: " .$e->getMessage();
				}
			} else {
				return false;
			}	
		}
		
		/**
		 * This method gets cart details of the customer who is checked out
		 * @return object of account details. 
		 */
		public function getMyAcccountCartDetails()
		{
			if (isset($_SESSION['user_id'])) {
				$connection = $this->instance->getConnection();
				$userId = $this->session['userId'];
				try {
					$result = $connection->prepare("SELECT cart.cart_id, checkout.checkout_date, cart.grand_total, cart.order_status
													FROM cart JOIN checkout ON cart.cart_id = checkout.cart_id
													WHERE cart.user_id = :userId;");
					$result->bindParam(':userId', $userId);
					$result->execute();
					if (!$result) {
						throw new Exception("Error in selecting the details");
					} else {
						return $result;
					}
				} catch (Exception $e) {
					throw "Message: " .$e->getMessage();
				}
			} else {
				return false;
			}
		}
		
		/**
		 * This method gets cart product details of the customer who is checked out
		 * @return object of account cart products. 
		 */
		public function getMyAcccountCartProducts($cartId)
		{
			if (isset($_SESSION['user_id'])) {
				$connection = $this->instance->getConnection();
				$userId = $this->session['userId'];
				try {
					$result = $connection->prepare("SELECT item.item_name, item.item_quantity FROM item 
													JOIN cart ON item.cart_id = cart.cart_id
													WHERE cart.user_id = :userId AND item.cart_id = :cartId;");
					$result->bindParam(':cartId', $cartId);
					$result->bindParam(':userId', $userId);
					$result->execute();
					if (!$result) {
						throw new Exception("Error in selecting the details");
					} else {
						return $result;
					}
				} catch (Exception $e) {
					throw "Message: " .$e->getMessage();
				}
			} else {
				return false;
			}
		}
	} 
    