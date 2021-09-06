
        <link rel="stylesheet" type="text/css" href="<?= Utility::getAssests() ?>/assests/css/header.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@100&display=swap" rel="stylesheet">
        <div class="top"></div>
        <table id="header">
            <tr>
                <td class="phone">
                    CALL US NOW<br>
                    <a href="#">0123-88-89-0999</a>
                </td>
                <td id="phonesymbol">&#128222</td>
                <td id="cartsymbol"><a href="cart">&#128722</a></td>
                <td class="cart">
                    <?php 
                        $cart = new CartController;
                        $grand_total = $cart -> updateCart();
                    ?>
                    <a href="cart">MY CART</a><br>
                    $<?php echo number_format((float)$grand_total, 2, '.', ''); ?><br>
                </td>
            </tr>
            <tr>
                <td class="logo"><a href="home"><img src="<?= Utility::getAssests() ?>/assests/images/header/logo.png"></a></td>
            </tr>    
        </table>
        <div class="down"></div>
        <div class="menu">
            <nav>
            <?php
                if( isset($_SESSION['loggedin'])){ ?>
                <ul>
                    <li><a href="home">HOME</a></li>
                    <li>OUR STORY</li>
                    <li>SHOP</li>
                    <li><a href="myaccount">MY ACCOUNT</a></li>
                    <li><a href="logout">LOGOUT</a></li>
                </ul>
                <?php }else { ?>
                <ul>
                    <li><a href="home">HOME</a></li>
                    <li>OUR STORY</li>
                    <li>SHOP</li>
                    <li><a href="user">REGISTER</a></li>
                    <li><a href="user">LOGIN</a></li>
                </ul>
                <?php } ?>             
            </nav>
        </div>
