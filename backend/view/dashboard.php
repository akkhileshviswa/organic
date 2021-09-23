<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" href="<?= Utility::getAssests() ?>/assests/css/dashboard.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    </head>
    <body>
        <div id="dash_body">
            <div id="left">
                <div id="user">
                    <br>
                    <img src="<?= Utility::getAssests() ?>/assests/images/login/logo.jpg" height="39px" width="190px">
                    <br><hr>
                    <br>
                    <img id="userimage" src="<?= Utility::getAssests() ?>/assests/images/login/man.jpg" height="70px" width="70px">
                    <?php 
                        $result = new Controller;
                        $showAdmin = $result->showAdmin();
                        $admin = $showAdmin->fetch_assoc();
                    ?>                    
                    <h5 id="username"><?php echo $admin['username'];?></h5>
                    <p><?php echo $admin['designation'];?></p>
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
                <h3 id="name">DASHBOARD</h3>
                <br>
                <div id="one">
                    <div id="hole">
                        <img src="<?= Utility::getAssests() ?>/assests/images/index/eLetter.png" height="60px" width="60px">
                    </div>
                    <div id="info">
                        <p id="infotext">Earnings</p>
                        <p id="infotext">
                            <span id="amount">₹ 6659</span>This Month</p>   
                    </div>
                </div>
                <div id="two">
                    <div id="hole">
                        <img src="<?= Utility::getAssests() ?>/assests/images/index/pLetter.png" height="60px" width="60px">                        
                    </div>
                    <div id="info">
                        <p id="infotext">Products</p>
                        <p id="infotext">
                            <span id="amount">₹ 9856</span>This Month</p>   
                    </div>
                </div>
                <br>
                <br><br>
                <div id="tablediv">
                    <table id="productstable">
                        <caption id="heading">Latest Order</caption> 
                        <thead>
                            <tr>
                                <td>Order Id</td>
                                <td>Customer Name</td>
                                <td>Order Date</td>
                                <td>Order Total</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $adminModel = new AdminModel;
                                $orderDetails = $adminModel->orderDetails();
                                $temp = 1;
                                while ( $results = $orderDetails->fetch_assoc()): 
                            ?>
                            <tr>
                                <td colspan="5"><hr></td>
                            </tr>
                            <tr>
                                <td><?php echo $results['cart_id']; ?></td>
                                <?php 
                                        $customerDetails = $adminModel-> customerDetails($results['cart_id']);
                                        while ( $result = $customerDetails->fetch_assoc()):
                                ?>
                                <td><?php echo $result['first_name']; ?></td>
                                <td><?php echo $result['checkout_date']; ?></td>
                                <?php endwhile; ?>
                                <td><?php echo $results['grand_total']; ?></td>
                                <td><?php echo $results['order_status']; ?></td>
                            </tr>
                            <?php
                                $temp++;
                                if ($temp>5) {
                                    break;
                                }
                                endwhile;
                            ?>
                        </tbody>
                    </table> 
                    <br>
                    <a id="ordersbutton" href="orders"><span>VIEW ALL ORDERS</span></a>   
                </div> 
            </div>
        </div>
    </body>
</html>
