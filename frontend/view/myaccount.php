<html>
    <head>
        <title>My Account</title>
        <link rel="stylesheet" type="text/css" href="assests/css/myaccount.css">
    </head>
    <body>
        <div id="head"><?php include "header.html" ?>
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
                        <td>Password</td>
                        <td><input type="text" value="asd"></td>
                        <td><input type="button" id="updatebutton" value="Update" ></td>
                    </tr>
                    <tr id="border">
                        <td>Address</td>
                        <td><textarea name="message" placeholder="Address" rows="5" cols="30"></textarea></td>
                        <td><input type="button" id="updatebutton" value="Update" ></td>
                    </tr>
            </table>
            <div id="tablediv">
                <table id="productstable" rules="none">
                    <caption id="heading">My Orders</caption> 
                    <thead>
                        <tr id="producttablehead">
                            <td>Order Id</td>
                            <td>Products</td>
                            <td>Order Date</td>
                            <td>Order Total</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6"><hr></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>
                                    <ol class="productslist">
                                        <li>Tomato</li>
                                        <li>Orange</li>
                                        <li>Carrot</li>
                                    </ol>
                            </td>
                            <td>August 15, 2021</td>
                            <td>$120.00</td>
                            <td>Processing</td>
                    </tbody>
                </table>
            </div>
        </div>
        <div>
        <?php include "footer.html" ?>   
        </div>
    </body>
</html>
