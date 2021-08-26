<html>
    <head>
        <title>Checkout</title>
        <link rel="stylesheet" href="assests/css/checkout.css">
        <script src="assests/js/checkout.js"></script>
    </head>
    <body>
        <div id="head"><?php include "header.html" ?>
        </div>
        <div id="title">
            <h2>Checkout</h2>
        </div>
        <form name="order" onsubmit="event.preventDefault(); validate();" autocomplete="off">
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
                            <td><input type="text" class="tableelements" id="firstname"></td>
                            <td id="leftspace"><input type="text" class="tableelements" id="lastname"></td>
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
                    <select id="country">
                        <option value="select">Select an option...</option>
                        <option value="India">India</option>
                        <option value="America">America</option>
                    </select>
                    <span id="countryerr"></span>
                    <br><br>
                    <label id="required">Street Address</label><br><br>
                    <input type="text" id="address" placeholder="House Number and street name"><br>
                    <span id="addresserr"></span>
                    <br><br>
                    <input type="text" name="apartment" placeholder="Apartment, Suite, unit, etc.,(optional)">
                    <br><br>
                    <label id="required">Town / Country</label><br><br>
                    <input type="text" id="town"><br>
                    <span id="townerr"></span>
                    <br><br>
                    <label id="required">State / Country</label><br><br>
                    <select id="state">
                        <option value="select">Select an option...</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                        <option value="Andhra Pradhesh">Andhra Pradhesh</option>
                    </select><br>
                    <span id="stateerr"></span>
                    <br><br>
                    <label id="required">PostalCode / Zip</label><br><br>
                    <input type="text" id="postalcode"><br>
                    <span id="postalerr"></span>
                    <br><br>
                    <label id="required">Phone</label><br><br>
                    <input type="text" id="phone"><br>
                    <span id="phoneerr"></span>
                    <br><br>
                    <label id="required">Email address</label><br><br>
                    <input type="text" id="email"><br>
                    <span id="emailerr"></span>
                    <br><br>
                </div>
            </div><br><br><br><br><br><br>
            <div id="right">
                <h3>YOUR ORDER</h3>
                <hr>
                <table id="productstable">
                    <tr id="heading">
                        <td>PRODUCT</td>
                        <td>SUBTOTAL</td>
                    </tr>
                    <tr>
                        <td>Apple Golden Local  × 1</td>
                        <td>$80.00</td>
                    </tr>
                    <tr id="heading">
                        <td>SUBTOTAL</td>
                        <td>$180.00</td>
                    </tr>
                    <tr>
                        <td id="heading">SHIPPING</td>
                        <td>
                            <input type="radio" id="shipping" >
                            <label>Flat rate: <b>$2.00</b></label><br><br>
                            <input type="radio" id="free" >
                            <label>Free shipping</label><br><br>
                            <input type="radio" id="local" >
                            <label>Local pickup</label><br><br>
                            <span id="shippingerr"></span><br><br>
                        </td>
                    </tr>
                    <tr>
                        <td id="total">TOTAL</td>
                        <td id="totalamount">$182.00</td>
                    </tr>
                </table>
                <br>
                <input type="radio" id="cash" name="cash" value="cash">
                <label for="cash">Cash on delivery</label><br><br>
                <span id="casherr"></span><br><br>
                <input type="checkbox" id="terms" name="terms" value="terms">
                <label for="terms">
                    <label id="required">I have read and agree to the website terms and conditions</label>
                </label><br><br>
                <span id="termserr"></span><br><br><br>
                <input type="submit" id="submit" value="Place Order">
            </div>
        </form>
        <div id="footer">
        <?php include "footer.html" ?>   
        </div>
    </body>
</html>
