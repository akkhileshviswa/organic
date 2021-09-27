<!DOCTYPE html>
<html>
<head>
    <link href="assests/css/addproduct.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div id="session">
        <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            } 
        ?>
    </div>
    <form method="POST" action="productimage.php" enctype="multipart/form-data">
        <table id="product" align=center>
            <h2 align=center>Register Product</h2>
            <tr>
                <td>Product Name</td>
                <td>Product Code</td>
                <td>Upload Product Image</td>
            </tr>
            <tr>
            <td class="right"><input type="text" name="name" placeholder="Enter Product Name"></td>
                <td class="right"><input type="text" name="code" placeholder="Enter Product Code"></td>
                <td class="right"><input type="file" name="fileUpload[]" multiple></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit_row" value="SUBMIT"></td>
            </tr>
        </table>
    </form>
</body>
</html>