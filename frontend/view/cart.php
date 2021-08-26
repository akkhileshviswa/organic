<?php  
    session_start();
    // include "../autoload/autoloadcartdetails.php";
    // include "../autoload/autoloadcalculatecarttotal.php";
?>

<html>
    <head>
        <title>Cart</title>
        <link rel="stylesheet" type="text/css" href="assests/css/cart.css">
        <script src="assests/js/addtocart.js"></script>     
    </head>
    <body>
        <div id="header">
            <?php include "header.html" ?>
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
                <?php foreach($results as $j ): ?>
                    <tr id="border">
                        <td><img id="tableimage" src="assests/images/index/<?php echo $j['image']; ?>"></td>
                        <td><?php echo $j['product_name']; ?></td>
                        <td>$<?php echo $j['price']; ?><input id="product_price" type="hidden" value="<?php echo $j['price']; ?>" ></input></td>
                        <td><input type="number" min=0 placeholder="0" id="product_quantity" onchange="changeQuantity(this.value, <?php echo $j['product_id']; ?>, <?php echo $j['price']; ?>);" ></td>
                        <td id="<?php echo $j['product_id']; ?>" class="amount">0</td>
                        <td><input type="button" id="remove" value="X" onclick="removeFromCart(<?php echo $j['cart_id']; ?>); " ></td>
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
                        <td><a href="index.php" >CONTINUE SHOPPING</a></td>
                        <td><input id="update" type="submit" value="Update Cart"></td>
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
					<td>SUBTOTAL</td>
					<td id="grandtotal" class="amount"><?php //echo $cart['sum(cart.total_amount)']; ?></td>
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
					<td id="totalamount" class="amount"><strong><?php //echo $cart['sum(cart.total_amount)']; ?></strong></td>
				</tr>
                <tr><td colspan="3"><a href="checkout.php" >Proceed to Checkout</a></td></tr>
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
                            <img src="assests/images/user/loginfruit.png">
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div id="footer">
            <?php include "footer.html" ?>
        </div>   
    </body>
</html>
