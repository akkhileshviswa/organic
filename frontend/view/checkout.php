<html>
    <head>
        <title>Checkout</title>
        <link rel="stylesheet" href="<?= Utility::getAssests() ?>/assests/css/checkout.css">
        <script src="<?= Utility::getAssests() ?>/assests/js/checkout.js"></script>
    </head>
    <body>
        <div id="head"><?php include "header.php" ?>
        </div>
        <div id="title">
            <h2>Checkout</h2>
        </div>
        <form name="order" action="orderdetails" method="POST" onsubmit="validate();" autocomplete="off">
            <div id="left">
                <h3>BILLING DETAILS</h3>
                <hr>
                <br>
                    <div id="subleft">
                    <table>
                        <tr>
                            <td><label id="required" class="worksans">First Name</label></td>
                            <td id="leftspace"><label id="required" class="worksans" >Last Name</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" class="tableelements" id="firstname" name="first_name" ></td>
                            <td id="leftspace"><input type="text" class="tableelements" id="lastname" name="last_name" ></td>
                        </tr>
                        <tr>
                            <td><span id="firstnameerr"></span></td>
                            <td id="leftspace"><span id="lastnameerr"></span></td>
                        </tr>
                    </table>
                    <br>
                    Company Name (optional)
                    <br><br>
                    <input type="text" name="companyname">
                    <br><br>
                    <label id="required">Country / Region</label><br><br>
                    <select id="country" name="country">
                        <option value="select">Select an option...</option>
                        <option value="India">India</option>
                        <option value="America">America</option>
                    </select>
                    <span id="countryerr"></span>
                    <br><br>
                    <label id="required">Street Address</label><br><br>
                    <input type="text" id="address" placeholder="House Number and street name" name="address" ><br>
                    <span id="addresserr"></span>
                    <br><br>
                    <input type="text" name="apartment" placeholder="Apartment, Suite, unit, etc.,(optional)">
                    <br><br>
                    <label id="required">Town / Country</label><br><br>
                    <input type="text" id="town" name="town"><br>
                    <span id="townerr"></span>
                    <br><br>
                    <label id="required">State / Country</label><br><br>
                    <select id="state" name="state">
                        <option value="select">Select an option...</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                        <option value="Andhra Pradhesh">Andhra Pradhesh</option>
                    </select><br>
                    <span id="stateerr"></span>
                    <br><br>
                    <label id="required">PostalCode / Zip</label><br><br>
                    <input type="text" id="postalcode" name="postal_code"><br>
                    <span id="postalerr"></span>
                    <br><br>
                    <label id="required">Phone</label><br><br>
                    <input type="text" id="phone" name="phone"><br>
                    <span id="phoneerr"></span>
                    <br><br>
                    <label id="required">Email address</label><br><br>
                    <input type="text" id="email" name="email"><br>
                    <span id="emailerr"></span>
                    <br><br>
                </div>
            </div><br><br><br><br><br><br>
            <div id="right">
                <table id="productstable">
                    <caption><h3>YOUR ORDER</h3><hr></caption>
                    <tr id="heading">
                        <td>PRODUCT</td>
                        <td>SUBTOTAL</td>
                    </tr>
                    <?php 
                            $showCartDetails = new CartController;
                            $cartDetails = $showCartDetails -> showCartDetails();
                            foreach($cartDetails as $j):
                    ?>
                    <tr>
                        <td><?php echo $j['item_name']; ?> × <?php echo $j['item_quantity']; ?></td>
                        <td><?php echo $j['row_total']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php 
                            $subTotal = $showCartDetails -> updateCart();
                    ?>
                    <tr id="heading">
                        <td>SUBTOTAL</td>
                        <td class="amount"><?php echo $subTotal; ?></td>
                    </tr>
                    <tr>
                        <td id="heading">SHIPPING</td>
                        <td>
                            <input type="radio" id="delivery" name="shipping_method" value=2  onchange="changeShippingMethod(<?php echo $subTotal; ?>,this.value);" >
                            <label>Flat rate: <b>$2.00</b></label><br><br>
                            <input type="radio" id="delivery" name="shipping_method" value=1 onchange="changeShippingMethod(<?php echo $subTotal; ?>,this.value);" >
                            <label>Free shipping</label><br><br>
                            <input type="radio" id="delivery" name="shipping_method" value=0 onchange="changeShippingMethod(<?php echo $subTotal; ?>,this.value);" >
                            <label>Local pickup</label><br><br>
                            <span id="shippingerr"></span><br><br>
                        </td>
                    </tr>
                    <tr>
                        <td id="total">TOTAL</td>
                        <td id="grand_total" class="amount"><?php echo $subTotal; ?></td>
                    </tr>
                    <tr id="trcash">
                        <td colspan="2" id="tdcash">
                        <input type="radio" id="payment_method" name="payment_method" value="Cash on delivery">
                        <label>Cash on delivery</label><br><br>
                        <span id="casherr"></span>
                        </td>    
                    </tr>
                    <tr id="trcash">
                        <td colspan="2" id="tdcash">
                        <input type="checkbox" id="terms" name="terms" value="terms">
                        <label id="required">I have read and agree to the website terms and conditions</label><br><br>
                        <span id="termserr"></span>
                        </td>    
                    </tr>
                    <tr id="trcash">
                        <td colspan="2" id="tdcash">
                            <input type="submit" id="submit" value="Place Order">     
                        </td>    
                    </tr>
                </table>
                   
            </div>
        </form>
        <div id="footer">
        <?php include "footer.php" ?>   
        </div>
    </body>
</html>
