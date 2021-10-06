<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="<?= Utility::getAssests() ?>/assests/css/login.css">
    </head>
    <body>
        <div id="table">
            <table id="main">
                <div id="leftcontent">
                    <table id="left">
                        <tr>
                            <td>
                                <img alt="Analysis" src="<?= Utility::getAssests() ?>/assests/images/login/analysis.png" 
                                    height="150px" width="151px">
                                <h3>Welcome to Organici</h3>
                                For the organic food,<br> the less it's designed,<br> the better it is.
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="rightcontent">
                    <table id="right">
                        <tr id="session">
                            <td><?php 
                                if (isset($_SESSION['message'])) {
                                    echo $_SESSION['message'];
                                    unset($_SESSION['message']);
                                } 
                            ?></td>
                        </tr>
                        <tr> 
                            <td id="mainright"><h2>Login</h2></td>	
                        </tr>
                        <tr>
                            <td>
                                <form method="POST" action="home" autocomplete="off">
                                    <label id="required">USERNAME</label><br>
                                    <input id="name" type="text" name="name" size="50" 
                                        value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>"><br>
                                    <br>
                                    <br><label id="required">PASSWORD</label><br>
                                    <input id="password" type="password" name="password" size="50" 
                                        value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>"><br>
                                    <br>
                                    <br><input id="button" type="submit" value="Login"><br>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
            </table>
        </div>
    </body>
</html>
