<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Products</title>
    <link href="assests/css/addproduct.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="assests/js/jquery.js"></script>
    <script type="text/javascript" src="assests/js/addproduct.js"></script>
</head>
<body>
    <div id="session">
        <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            } 
        ?>
    </div>
    <form method="POST" action="products.php">
        <table id="product" align=center>
            <h2 align=center>Register Product</h2>
            <tr>
                <td>Product Name</td>
                <td>Quantity</td>
                <td>Product Code</td>
                <td>Upload Product Image</td>
            </tr>
            <tr id="row1">
                <td class="right"><input type="text" name="name[]" placeholder="Enter Product Name"></td>
                <td class="right"><input type="text" name="quantity[]" placeholder="Enter Quantity"></td>
                <td class="right"><input type="text" name="code[]" placeholder="Enter Product Code"></td>
                <td class="button"><input type="button" id="submit" onclick="add_row();" value="ADD ROW"></td>
            </tr>
        </table>
        <table align=center>
            <tr>
                <td><input type="submit" name="submit_row" value="SUBMIT"></td>
            </tr>
        </table>
    </form>
</body>
</html>