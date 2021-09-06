<!DOCTYPE html>
<html>
    <head>
        <title>My Account</title>
        <link rel="stylesheet" type="text/css" href="<?= Utility::getAssests() ?>/assests/css/myaccount.css">
        <script src="<?= Utility::getAssests() ?>/assests/js/checkout.js"></script>
    </head>
    <body>
        <div id="head"><?php include "header.php" ?>
        </div>
        <div id="title">
            <h2>My Account</h2>
        </div>
        <div>
            <table id="producttable" rules="none">
                <thead id="producttablehead">
                    <td>My Profile</td>
                    <td></td>
                    <td></td>
                </thead>
                <tbody id="producttablebody">
                    
                    <tr id="border">
                        <?php 
                            $user = new UserModel;
                            $result = $user-> getPassword();
                            $getPassword = $result->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <td>Password</td>
                        <td><input type="password" id="password" name="password" value="<?php echo $getPassword['password']; ?>"></td>
                        <td><input type="button" id="updatebutton" value="Update" onclick = "updatePassword(password.value);" ></td>
                    </tr>
                    <tr id="border">
                        <?php 
                            $cart = new CartModel;
                            $result = $cart-> getAddress();
                            $getAddress = $result->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <td>Address</td>
                        <td><textarea name="message" id="message" placeholder="Address" rows="5" cols="30"><?php echo $getAddress['address']; ?></textarea></td>
                        <td><input type="button" id="updatebutton" value="Update" onclick = "updateAddress(message.value)" ></td>
                    </tr>
            </table>
            <div id="tablediv">
                <table id="productstable" rules="none">
                    <caption id="heading">My Orders</caption> 
                    <thead>
                        <tr id="producttablehead">
                            <td>Order Id</td>
                            <td>Products</td>
                            <td>Quantity</td>
                            <td>Order Date</td>
                            <td>Order Total</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $cartModel = new CartModel;
                            $getMyAcccountCartDetails = $cartModel-> getMyAcccountCartDetails();
                            foreach($getMyAcccountCartDetails as $i):
                        ?>
                        <tr>
                            <td colspan="6"><hr></td>
                        </tr>
                        <tr>
                            <td><?php echo $i['cart_id']; ?></td>
                            <td>
                                <ol>
                                    <?php 
                                        $getMyAcccountCartProducts = $cartModel-> getMyAcccountCartProducts( $i['cart_id']);
                                        foreach($getMyAcccountCartProducts as $j): 
                                    ?>
                                    <li><?php echo $j['item_name']; ?></li>
                                    <?php endforeach; ?>
                                </ol>
                            </td>
                            <td>
                                <ol class="productslist">
                                    <?php 
                                        $getMyAcccountCartProducts = $cartModel-> getMyAcccountCartProducts( $i['cart_id']);
                                        foreach($getMyAcccountCartProducts as $j): 
                                    ?>
                                    <li><?php echo $j['item_quantity']; ?></li>
                                    <?php endforeach; ?>
                                </ol>
                            </td>
                            <td><?php echo $i['checkout_date']; ?></td>
                            <td><?php echo $i['grand_total']; ?></td>
                            <td><?php echo $i['order_status']; ?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
        <div>
        <?php include "footer.php" ?>   
        </div>
    </body>
</html>
