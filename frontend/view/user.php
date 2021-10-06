<!DOCTYPE html>
<html lang="en">
    <head>
        <title>User Page</title>
        <link rel="stylesheet" type="text/css" href="<?= Utility::getAssests() ?>/assests/css/user.css">
        <script src="<?= Utility::getAssests() ?>/assests/js/user.js"></script>
    </head>
    <body>
        <div id="head"><?php include "header.php";?>
        </div>
        <div id="table">
            <table id="main">
                <tr id="session">    
                    <td>
                        <?php  
                           if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        } 
                        ?>
                    </td>	
                </tr><br><br>
                <tr>
                    <td id="mainleft"><h2>Login</h2></td>
                    <td id="mainright"><h2>Register</h2></td>
                </tr>
            </table>
            <table id="left">
                <tr>
                    <td>
                        <form method="POST" action= "login" onsubmit="return loginvalidate()" autocomplete="off">
                            <label id="required">USERNAME</label><br>
                            <input id="loginname" type="text" name="loginname" size="42" 
                                value="<?php if (isset($_POST['loginname'])) echo $_POST['loginname']; ?>"><br>
                            <span id="loginnameerr"></span><br>
                            <br><label id="required">PASSWORD</label><br>
                            <input id="loginpassword" type="password" name="loginpassword" size="40"
                                value="<?php if (isset($_POST['loginpassword'])) echo $_POST['loginpassword']; ?>"><br>
                            <span id="loginpassworderr"></span><br>
                            <br><input id="button" type="submit" value="Login"><br><br>
                            <br>LOST YOUR PASSWORD?<br><br>
                        </form>
                    </td>
                </tr>
            </table>
            <table id="right">
                <tr>
                    <td>
                        <form method="POST" action="register" onsubmit="return validate()" autocomplete="off">
                            <label id="required">USERNAME</label><br>
                            <input id="name" type="text" name="name" size="42"
                                value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>"><br>
                            <span id="nameerr"></span><br>
                            <br><label id="required">EMAIL</label><br>
                            <input id="email" type="text" name="email" size="42"
                                value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"><br>
                            <span id="emailerr"></span><br>
                            <br><label id="required">PASSWORD</label><br>
                            <input id="password" type="password" name="password" size="40"
                                value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>"><br>
                            <span id="passworderr"></span><br>
                            <br><input id="button" type="submit" value="REGISTER"><br><br>	
                        </form>
                    </td>
                </tr>
            </table>
        </div>
        <div id="imagebackground">
            <table>
                <tr>
                    <td>
                        <h2 id="quote">- Every day fresh -</h2>
                        <h1>ORGANIC FOOD</h1>
                    </td>
                    <td>  
                        <div id="fruitimage">
                            <img src="<?= Utility::getAssests() ?>/assests/images/user/loginfruit.png">
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div id="footer">
        <?php include "footer.php" ?>
        </div>   
    </body>
</html>
