<!DOCTYPE html>
<html>
    <head>
        <title>Products</title>
        <link rel="stylesheet" href="assests/css/products.css">
    </head>
    <body>
        <div id="right">
            <div id="tablediv">
                <table id="productstable" >
                    <caption id="heading"><h3>PRODUCT DETAILS</h3></caption>
                    <thead>
                        <tr>
                            <td>Product Code</td>
                            <td>Product Name</td>
                            <td>Image</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include "products.php";
                            $result = new Products;
                            $showProducts = $result->showProducts();
                            while ( $products = $showProducts->fetch_assoc()): ?>
                        <tr>
                            <td colspan="3"><hr></td>
                        </tr>
                        <tr>
                            <td><?php echo $products['product_code']; ?></td>
                            <td><?php echo $products['product_name']; ?></td>
                            <td><img id="tableimage" src="uploads/<?php echo $products['image']; ?>"></td>
                        <?php endwhile; ?>   
                        <tr>
                            <td colspan="3"><hr></td>
                        </tr>
                    </tbody> 
                </table> <br><br>
            </div> 
        </div>
    </body>
</html>
