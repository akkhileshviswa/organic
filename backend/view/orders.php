<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Orders</title>
        <link rel="stylesheet" href="<?= Utility::getAssests() ?>/assests/css/orders.css">
        <script src="<?= Utility::getAssests() ?>/assests/js/customers.js"></script>
    </head>
    <body>
        <div id="dash_body">
            <div id="left">
                <div id="user">
                    <br>
                    <img alt="Logo" src="<?= Utility::getAssests() ?>/assests/images/login/logo.jpg" height="39px" width="190px">
                    <br><hr>
                    <br>
                    <img id="userimage" alt="Profile Photo" src="<?= Utility::getAssests() ?>/assests/images/login/man.jpg" 
                        height="70px" width="70px">
                    <?php 
                        $result = new Controller;
                        $showAdmin = $result->showAdmin();
                        $admin = $showAdmin->fetch_assoc();
                    ?>                    
                    <h5 id="username"><?php echo $admin['username']; ?></h5>
                    <p><?php echo $admin['designation']; ?></p>
                    <br><hr>
                </div>
                <div id="options">
                    <ul>
                        <li><a href="dashboard">&#9750;<span>Dashboard</span></a></li>   
                         <br><br>
                        <li><a href="orders">&dollar;<span>Orders</span></a></li>
                        <br><br>
                        <li><a href="products">&#8719;<span>Products</span></a></li>
                        <br><br>
                        <li><a href="customers">&#128100;<span>Customers</span></a></li>   
                        <br><br><br>
                        <li><a id="logout" href="home"><span>Logout</span></a></li>
                    </ul>
                </div>
            </div>
            <div id="right">
                <h3 id="name">ORDERS</h3>
                <div id="sessionmessage">
                    <?php 
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        } 
                    ?>
                </div>
                <div id="tablediv">
                    <table id="productstable">
                            <caption id="heading">Manage Order</caption> 
                        <thead>
                            <tr>
                                <td colspan="7"><hr></td>
                            </tr>
                            <tr>
                                <td>Order Id</td>
                                <td>Products</td>
                                <td>Customer Name</td>
                                <td>Date</td>
                                <td>Order Total</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $adminModel = new AdminModel;
                                $orderDetails = $adminModel->orderDetails();
                                while ($results = $orderDetails->fetch_assoc()): 
                            ?>
                            <tr>
                                <td colspan="7"><hr></td>
                            </tr>
                            <tr>
                                <td><?php echo $results['cart_id']; ?></td>
                                <td>
                                    <ol class="productslist">
                                        <?php 
                                            $getCustomerCartProducts = $adminModel->getCustomerCartProducts($results['cart_id']);
                                            while ($i = $getCustomerCartProducts->fetch_assoc()): 
                                        ?>
                                        <li><?php echo $i['item_name']; ?></li>
                                        <?php endwhile; ?>
                                    </ol>
                                </td>
                                <?php 
                                        $customerDetails = $adminModel->customerDetails($results['cart_id']);
                                        while ($j = $customerDetails->fetch_assoc()):
                                ?>
                                <td><?php echo $j['first_name']; ?></td>
                                <td><?php echo $j['checkout_date']; ?></td>
                                <?php endwhile; ?>
                                <td><?php echo $results['grand_total']; ?></td>
                                <td>
                                    <select onchange="changeOrderStatus(<?php echo $results['cart_id'];?>,this.value);">
                                    <option id = "status" value="<?php echo $results['order_status']; ?>"><?php echo $results['order_status']; ?></option>
                                        <?php if ($results['order_status'] == "Processing") { ?>
                                            <option value="Dispatched">Dispatched</option>
                                            <option value="Delivered">Delivered</option>
                                        <?php } elseif ($results['order_status'] == "Dispatched") { ?>
                                            <option value="Processing">Processing</option>
                                            <option value="Delivered">Delivered</option>
                                        <?php  } else { ?>
                                            <option value="Processing">Processing</option>
                                            <option value="Dispatched">Dispatched</option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="button" id="delete" value='&#128465;' onclick = "removeOrder(<?php echo $results['cart_id'];?>);" ></input>
                                </td>
                            </tr>
                            <?php
                                endwhile;
                            ?>
                        </tbody>
                    </table> <br><br>
                </div> 
            </div>
        </div>  
    </body>
</html>
