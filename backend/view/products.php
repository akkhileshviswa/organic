<!DOCTYPE html>
<html>
    <head>
        <title>Products</title>
        <link rel="stylesheet" href="<?= Utility::getAssests() ?>/assests/css/products.css">
        <script src="<?= Utility::getAssests() ?>/assests/js/updateproduct.js"></script>
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
                        $showAdmin = $result-> showAdmin();
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
                <div id="tablediv">
                    <table id="productstable" >
                        <caption id="heading"><h3>PRODUCT DETAILS</h3></caption>
                        <div id="sessionmessage">
                            <?php 
                                if(isset($_SESSION['message'])){
                                    echo $_SESSION['message'];
                                    unset($_SESSION['message']);
                                } 
                            ?>
			            </div>
                        <thead>
                            <tr>
                                <td>Product Id</td>
                                <td>Image</td>
                                <td>Name</td>
                                <td>Price</td>
                                <td>Quantity</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $showProducts = $result-> showProducts();
                                while( $products = $showProducts->fetch_assoc()): ?>
                            <tr>
                                <td colspan="6"><hr></td>
                            </tr>
                            <tr>
                                <td><?php echo $products['product_id']; ?></td>
                                <td><img id="tableimage" src="<?= Utility::getAssests() ?>/assests/images/index/<?php echo $products['image']; ?>"></td>
                                <td><?php echo $products['product_name']; ?></td>
                                <td>₹<?php echo $products['price']; ?></td>
                                <td><?php echo $products['quantity']; ?></td>
                                <td><form method="POST" action="updateproduct">
                                    <input type="hidden" id="product_id" name="product_id" value="<?php echo $products['product_id'];?>" >
                                    <button id = "updatebutton">Edit </button>
                                </form>
                                <?php 
                                    if($products['is_active'] == 1){
                                        $isActive = "Disable";
                                        $isActiveId = "disable";
                                    } else if ($products['is_active'] == 0) {
                                        $isActive = "Enable";
                                        $isActiveId = "enable";
                                    }
                                ?><br>
                                <input type="button" value="<?php echo $isActive;?>" id = "<?php echo $isActiveId;?>" onclick="enableOrDisableProduct(<?php echo $products['product_id'];?>, <?php echo $products['is_active'];?>);">
                                </td>
                            </tr>
                            <?php endwhile;  ?>   
                            <tr>
                                <td colspan="6"><hr></td>
                            </tr>
                            <tr>
                                <td><a id="newproduct" href="newproduct">Add Product</a></td>
                            </tr>
                        </tbody> 
                    </table> <br><br>
                </div> 
            </div>
        </div>
    </body>
</html>
