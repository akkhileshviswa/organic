<!DOCTYPE html>
<html>
    <head>
        <title>Confirmation</title>
        <link rel="stylesheet" href="<?= Utility::getAssests() ?>/assests/css/completepage.css">
    </head>
    <body>
        <div id="head"><?php include "header.php" ?>
        </div>
        <div id="title">
            <img src="<?= Utility::getAssests() ?>/assests/images/cart.png">
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
                    <?php 
                        $orders = new CartController;
                        $orderDetails = $orders-> orderDetails();
                        $array = $orders -> customerDetails();
                        $customerDetails = $array->fetch(PDO::FETCH_ASSOC);
                        foreach($orderDetails as $orderDetail):
                    ?>
                    <tr>
                        <td>#<?php echo $_SESSION['cart_id']; ?></td>
                        <td><?php echo $customerDetails['checkout_date']; ?></td>
                        <td>₹<?php echo $orderDetail['grand_total']; ?></td>
                        <td><?php echo $orderDetail['payment_method']; ?></td>
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
                <?php 
                        $itemDetails = $orders-> showCartDetails();
                        foreach($itemDetails as $itemDetail):
                    ?>
                    <tr>
                        <td><?php echo $itemDetail['item_name']; ?> x <?php echo $itemDetail['item_quantity']; ?></td><td></td>
                        <td class="amount"><?php echo $itemDetail['row_total']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td>Shipping</td><td></td>
                        <td><?php echo $orderDetail['shipping_method']; ?></td>
                    </tr>
                    <tr>
                        <td>Total</td><td></td>
                        <td class="amount"><?php echo $orderDetail['grand_total']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h4>CUSTOMER DETAILS</h4>
            <table id="customertable" rules="none">
                <tbody id="customertablebody">
                    <tr>
                        <td>Email : </td><td></td>
                        <td><?php echo $customerDetails['email']; ?></td>
                    </tr>
                    <tr>
                        <td id="detail">Telephone :</td><td></td>
                        <td id="detail">+91 <?php echo $customerDetails['phone']; ?></td>
                    </tr>
                    <tr>
                        <td id="detail">Address :</td><td></td>
                        <td id="detail"><?php echo $customerDetails['address']; ?></td>
                    </tr>
                </tbody>
            </table><?php  $_SESSION['cart_id'] =0;
                            unset($_SESSION['isActive']);?>
        </div>
        <?php include "footer.php" ?>
    </body>
</html>
