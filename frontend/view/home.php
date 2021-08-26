<?php  
    session_start();
    include "../autoload/autoloadindex.php";
?>

<html>
    <head>
        <title>Organic Store</title>
        <link rel="stylesheet" type="text/css" href="assests/css/index.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> 
        <script src="assests/js/addtocart.js"></script>      
    </head>
    <body>
        <div id="head"><?php include "header.html";  ?>
        </div>
        <div class="owl-carousel owl-theme">
        <div><img src="assests/images/index/slider_1.jpg"></div>
        <div><img src="assests/images/index/slider_2.jpg"></div>
        <div><img src="assests/images/index/slider_3.jpg"></div>
    </div>
        <div>
            <img class="fruit" src="assests/images/index/fruit_1.jpg">
            <img class="fruit" src="assests/images/index/fruit_2.jpg">
            <img class="fruit" src="assests/images/index/fruit_3.jpg">
            <img class="fruit" src="assests/images/index/fruit_4.jpg">
            <img class="fruit" src="assests/images/index/fruit_5.jpg">
        </div>
        <div id = "newproducts">
            <img width="40" height="39" src="assests/images/index/icon.png"> 
            <h2 id="heading">NEW PRODUCTS</h2>
            <p id="para"> There are many variations of passages of Lorem Ipsum available</p>
            <br>
            <ul>
                <li>ALL PRODUCTS</li>
                <li><img src="assests/images/index/doubleslash.png" height="15px" width="20px"></li>
                <li>FRUIT</li>
                <li><img src="assests/images/index/doubleslash.png" height="15px" width="20px"></li>
                <li>VEGETABLE</li>
                <li><img src="assests/images/index/doubleslash.png" height="15px" width="20px"></li>
                <li>BREAD</li>
                <li><img src="assests/images/index/doubleslash.png" height="15px" width="20px"></li>
                <li>OTHERS</li>
            </ul>
        </div>
        <div id="productlist">
            <table  id="products">
                <?php
                if( isset($_SESSION['loggedin'])){
                    $user_id = $_SESSION['user_id'];
                    $onclick = "insertData(user_id.value,this.value);";
                }else {
                    $action ="../autoload/autoloadlogincheck.php";
                    $onclick ="";
                }
                $temp=0; ?>
                <tr>
                <?php foreach($results as $j ): ?>
                    <td>
                        <form class="form-submit" action= "<?php echo $action; ?>" method="post" >   
                            <div class="image">
                            <br>
                                <img width="250" height="300" src="assests/images/index/<?php echo $j['image']; ?>">
                            <br><br>
                            </div>
                            <h3><?php echo $j['product_name']; ?></h3>
                            <p class="amount"><?php echo $j['price']; ?></p>
                            <input type="hidden" id="user_id" value=" <?php echo $user_id ;?>">
                            <button type="submit" id="addproduct" value="<?php echo $j['product_id'];?>" onclick ="<?php echo $onclick; ?>"> Add to Cart</button>
                        </form> 
                    </td>
                    <?php $temp++; if($temp%4==0){
                        break; } 
                        endforeach; 
                    ?>
                </tr>         
            </table>
        </div> 
        <br>
        <div id="subscribe" style= "background-image: url(assests/images/index/newsletter.jpg); height:220px;">
            <div id="subscribe_left">
                <h3 id="text">Subscribe to us!</h3>
                <p id="email">Enter Your email address for our mailing list to keep yourself update.</p>
            </div>
            <div id="subscribe_right">
                <br><br><br><br>
                <form>
                    <input type="email" name="EMAIL" placeholder="Email address" size="56">
                    <input id="submit" type="submit" value="SUBMIT">
                </form>
            </div> 
        </div>
        <script src="assests/js/index.js"></script> 
        <div>
        <?php include "footer.html" ?>   
        </div>
    </body>
</html>
