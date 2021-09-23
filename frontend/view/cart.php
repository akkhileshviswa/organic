<!DOCTYPE html>
<html>
    <head>
        <title>Cart</title>
        <link rel="stylesheet" type="text/css" href="<?= Utility::getAssests() ?>/assests/css/cart.css">
        <script src="<?= Utility::getAssests() ?>/assests/js/addtocart.js"></script>     
    </head>
    <body>
        <div id="header">
            <?php include "header.php" ?>
        </div>
        <div id="title">
            <h2>Cart</h2>
        </div>
        <div>
            <table id="producttable" rules="none">
                <thead id="producttablehead">
                    <td>Image</td>
                    <td>Name</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                    <td></td>
                </thead>
                <tbody id="producttablebody">
                <?php 
                    $cart = new CartDetails;
                    $result = $cart->getCartDetails();
                    foreach ($result as $j ) : 
                ?>
                    <tr id="border">
                        <td><img id="tableimage" src="<?= Utility::getAssests() ?>/assests/images/index/<?php echo $j['image']; ?>"></td>
                        <td><?php echo $j['item_name']; ?></td>
                        <td>₹<?php echo $j['item_price']; ?></td>
                        <td><input type="number" min=1 placeholder="1" id="item_quantity" value="<?php echo $j['item_quantity']; ?>" 
                                onchange="changeQuantity(this.value, <?php echo $j['item_id']; ?>, 
                                <?php echo $j['item_price']; ?>); grandTotal();"></td>
                        <td id="<?php echo $j['item_id']; ?>" class="amount"><?php echo $j['row_total']; ?></td>
                        <td><input type="button" id="remove" value="X" onclick="removeFromCart(<?php echo $j['item_id']; ?>); " ></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="6"><hr></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td ><a id="continue" href="home" >CONTINUE SHOPPING</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="6"> <hr></td>
                    </tr> 
                </tbody>
            </table>
            <table id="right">
				<tr>
                    <td><h2>Cart Totals</h2></td>
                </tr>
                <tr>
                        <td class="space" colspan="3"><hr></td>
                </tr>
				<tr>
                    <?php 
                        $cart = new CartController;
                        $grand_total = $cart->updateCart();
                    ?>
					<td>SUBTOTAL</td>
					<td id="grandtotal" class="amount"><?php echo $grand_total; ?></td>
				</tr>
                <tr>
                    <td class="space" colspan="3"><hr></td>
                </tr>
				<tr>
					<td>SHIPPING</td>
					<td>
					<p>Shipping costs will be calculated once you have<br> provided your address.</p>
					</td>
				</tr>
                <tr>
                    <td class="space" colspan="3"><hr></td>
                </tr>
				<tr class="total">
					<td>TOTAL</td>
					<td id="grandtotal" class="amount"><strong><?php echo $grand_total; ?></strong></td>
				</tr>
                <tr><td colspan="3"><a href="checkout" >Proceed to Checkout</a></td></tr>
			</table>
        </div>
        <div id="imagebackground">
            <table>
                <tr>
                    <td>
                        <h2 id="quote">- Every day fresh -</h2>
                        <h1>ORGANIC FOOD</h1>
                    </td>
                    <td>  
                        <div id="fruitimage">
                            <img src="<?= Utility::getAssests() ?>/assests/images/user/loginfruit.png">
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div id="footer">
            <?php include "footer.php" ?>
        </div>   
    </body>
</html>
