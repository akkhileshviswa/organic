<!DOCTYPE html>
<html>
    <head>
        <title>Customers</title>
        <link rel="stylesheet" href="<?= Utility::getAssests() ?>/assests/css/customers.css">
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
                    <table id="productstable">
                        <caption id="heading"><h3>CUSTOMER DETAILS</h3></caption>
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
                                <td>User Id</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Created Date</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $showCustomers = $result-> showCustomers();
                                while( $results = $showCustomers->fetch_assoc()): 
                            ?>
                            <tr>
                                <td colspan="5"><hr></td>
                            </tr>
                            <tr>
                                <td><?php echo $results['user_id']; ?></td>
                                <td><?php echo $results['username']; ?></td>
                                <td><?php echo $results['email']; ?></td>
                                <td><?php 
                                        $a = $results['created_date'];
                                        $date = DateTime::createFromFormat("Y-m-d H:i:s",$a);
                                        echo $date->format("M d, Y");
                                    ?>
                                </td>
                                <td><form method="POST" action="updatescustomer">
                                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $results['user_id'];?>" >
                                    <button id = "updatebutton">Edit </button>
                                </form>
                                </td>
                            </tr>
                            <?php endwhile;  ?>     
                        </tbody>
                    </table> <br><br>
                </div> 
            </div>
        </div>
    </body>
</html>
