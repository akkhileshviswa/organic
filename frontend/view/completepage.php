<html>
    <head>
        <title>Confirmation</title>
        <link rel="stylesheet" href="assests/css/completepage.css">
    </head>
    <body>
        <div id="head"><?php include "header.html" ?>
        </div>
        <div id="title">
            <img src="assests/images/cart.png">
            <h3>THANK YOU FOR SHOPPING WITH US</h3>
        </div>
        <div id="orders">
            <p>Thank you. Your order has been received.</p>
            <table id="ordertable" rules="none">
                <thead id="ordertablehead">
                    <td>ORDER </td>
                    <td>DATE </td>
                    <td>TOTAL </td>
                    <td> PAYMENT METHOD </td>
                </thead>
                <tbody id="ordertablebody">
                    <tr>
                        <td>#8304</td>
                        <td>August 15, 2021</td>
                        <td>$150</td>
                        <td>Cash On Delivery</td>
                    </tr>
                </tbody>
            </table>
            <h4>ORDER DETAILS</h4>
            <table id="orderstable" rules="none">
                <thead id="orderstablehead">
                    <td>PRODUCT </td><td></td>
                    <td>TOTAL </td>
                </thead>
                <tbody id="orderstablebody">
                    <tr>
                        <td>Apple</td><td></td>
                        <td>$2,880.00</td>
                    </tr>
                    <tr>
                        <td>Shipping</td><td></td>
                        <td>Free Shipping</td>
                    </tr>
                    <tr>
                        <td>Total</td><td></td>
                        <td>$2,880.00</td>
                    </tr>
                </tbody>
            </table>
            <h4>CUSTOMER DETAILS</h4>
            <table id="customertable" rules="none">
                <tbody id="customertablebody">
                    <tr>
                        <td>Email : </td><td></td>
                        <td>akkil@gmail.com</td>
                    </tr>
                    <tr>
                        <td id="detail">Telephone :</td><td></td>
                        <td id="detail">+91 9922993366</td>
                    </tr>
                    <tr>
                        <td id="detail">Address :</td><td></td>
                        <td id="detail">23, Ragavendra Nagar, Gobi</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php include "footer.html" ?>
    </body>
</html>
