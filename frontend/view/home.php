<!DOCTYPE html>
<html>
    <head>
        <title>Organic Store</title>
        <link rel="stylesheet" type="text/css" href="<?= Utility::getAssests() ?>/assests/css/index.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> 
        <script src="<?= Utility::getAssests() ?>/assests/js/addtocart.js"></script>      
    </head>
    <body>
        <div id="head"><?php include "header.php";  ?>
        </div>
        <div id="session" >
            <?php
                if(isset($_SESSION['message'])){
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                }
            ?>
        </div>         
        <div class="owl-carousel owl-theme">
        <div><img src="<?= Utility::getAssests() ?>/assests/images/index/slider_1.jpg"></div>
        <div><img src="<?= Utility::getAssests() ?>/assests/images/index/slider_2.jpg"></div>
        <div><img src="<?= Utility::getAssests() ?>/assests/images/index/slider_3.jpg"></div>
    </div>
        <div>
            <img class="fruit" src="<?= Utility::getAssests() ?>/assests/images/index/fruit_1.jpg">
            <img class="fruit" src="<?= Utility::getAssests() ?>/assests/images/index/fruit_2.jpg">
            <img class="fruit" src="<?= Utility::getAssests() ?>/assests/images/index/fruit_3.jpg">
            <img class="fruit" src="<?= Utility::getAssests() ?>/assests/images/index/fruit_4.jpg">
            <img class="fruit" src="<?= Utility::getAssests() ?>/assests/images/index/fruit_5.jpg">
        </div>
        <div id = "newproducts">
            <img width="40" height="39" src="<?= Utility::getAssests() ?>/assests/images/index/icon.png"> 
            <h2 id="heading">NEW PRODUCTS</h2>
            <p id="para"> There are many variations of passages of Lorem Ipsum available</p>
            <br>
            <ul>
                <li>ALL PRODUCTS</li>
                <li><img src="<?= Utility::getAssests() ?>/assests/images/index/doubleslash.png" height="15px" width="20px"></li>
                <li>FRUIT</li>
                <li><img src="<?= Utility::getAssests() ?>/assests/images/index/doubleslash.png" height="15px" width="20px"></li>
                <li>VEGETABLE</li>
                <li><img src="<?= Utility::getAssests() ?>/assests/images/index/doubleslash.png" height="15px" width="20px"></li>
                <li>BREAD</li>
                <li><img src="<?= Utility::getAssests() ?>/assests/images/index/doubleslash.png" height="15px" width="20px"></li>
                <li>OTHERS</li>
            </ul>
        </div>
        <div id="productlist">
            <table  id="products">      
                <?php
                    if( isset($_SESSION['loggedin'])){
                        $userId = $_SESSION['user_id'];
                        $action ="home";
                    }else {
                        $action ="user";
                        $onclick ="";
                    }
                ?>
                <tr>
                <?php 
                    $product = new ProductDetails;
                    $result = $product -> getProductDetails();
                    $tdlimit = 0;
                    foreach($result as $j) :
                        if($tdlimit%4 == 0) {
                            echo '</tr>';
                            echo '<tr>';
                        }
                        $tdlimit++;
                ?>
                    <td>
                        <form class="form-submit" action= "<?php echo $action; ?>" method="POST" >   
                        <div class="image">
                        <br>
                            <img width="250" height="300" src="<?= Utility::getAssests() ?>/assests/images/index/<?php echo $j['image']; ?>">
                        <br><br>
                        </div>
                        <h3><?php echo $j['product_name']; ?></h3>
                        <p class="amount"><?php echo $j['price']; ?></p>
                        <input type="hidden" id="product_name" name="product_name"  value=" <?php echo $j['product_name']; ?>">
                        <input type="hidden" id="price" name="price" value=" <?php echo $j['price']; ?>">
                        <input type="hidden" id="user_id" name="user_id" value=" <?php echo $user_id; ?>">
                        <input type="hidden" id="product_id" name="product_id"  value="<?php echo $j['product_id'];?>">
                        <button type="submit" > Add to Cart</button>
                        </form>
                    </td> 
                <?php 
                    endforeach;
                ?>
                </tr>         
            </table>
        </div> 
        <br>
        <div id="subscribe" style= "background-image: url(<?= Utility::getAssests() ?>/assests/images/index/newsletter.jpg); height:220px;">
            <div id="subscribe_left">
                <h3 id="text">Subscribe to us!</h3>
                <p id="email">Enter Your email address for our mailing list to keep yourself update.</p>
            </div>
            <div id="subscribe_right">
                <br><br><br><br>
                <form>
                    <input type="email" name="EMAIL" placeholder="Email address" size="56">
                    <input type="submit" id="submit"  value="SUBMIT">
                </form>
            </div> 
        </div>
        <script src="<?= Utility::getAssests() ?>/assests/js/index.js"></script> 
        <div>
        <?php include "footer.php" ?>   
        </div>
    </body>
</html>
