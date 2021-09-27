<?php
session_start();
error_reporting(0);
include "model/Database.php";
include "View.php";
if (isset($_POST['submit_row'])) {
    $connection = new Database();
    $connectWarehouse = $connection->getConnectionToWarehouse();
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $code = $_POST['code'];
    $uploadsDir = "uploads/";
    $allowedFileType = array('jpg','png','jpeg');
    function arrayHasOnlyInts($values)
    {
        $test = implode('',$values);
        return is_numeric($test);
    }
    $checkQuantity = arrayHasOnlyInts($quantity);
    $checkCode = arrayHasOnlyInts($code);
    for ($i=0; $i < count($name); $i++) 
    {
        if ($name[$i]!="" && $quantity[$i]!="" && $code[$i]!="" && !empty(array_filter($_FILES['fileUpload']['name']))) {   
            if ($checkQuantity == 1 ) {
                if ($checkCode == 1) {
                    $productCode = mysqli_query($connectWarehouse, "SELECT product_code FROM products;");
                    $rows = [];
                    while ($row = $productCode->fetch_row()) {
                        $rows[] = $row;
                    }
                    $n = count($rows);
                    for ($j=0; $j<$n ; $j++) {
                        if (in_array($code[$i], $rows[$j])) { 
                            $_SESSION['message'] = "Product code should be unique!!";
                            View::load("addproduct");
                        }
                    } 
                    $result = mysqli_query($connectWarehouse,"INSERT INTO products (product_name, quantity, product_code) 
                                            VALUES('$name[$i]', $quantity[$i], $code[$i]);");                     
                    if ($result) {
                        foreach ($_FILES['fileUpload']['name'] as $id=>$val) {
                            $fileName      = $_FILES['fileUpload']['name'][$id];
                            $tempLocation    = $_FILES['fileUpload']['tmp_name'][$id];
                            $targetFilePath  = $uploadsDir.$fileName;
                            $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                            if (in_array($fileType, $allowedFileType)) {
                                    if (move_uploaded_file($tempLocation, $targetFilePath)) {
                                        $sqlVal = $fileName;
                                    } else {      
                                        $sqlVal =  "fruit_1.jpg";
                                    }
                            } else {         
                                $upload = 1;                    
                            }
                            if ($upload != 1) {
                                $insert = mysqli_query($connectWarehouse, "INSERT INTO product_image (product_code, product_name, image) 
                                                        VALUES ($code[$i], '$name[$i]', '$sqlVal');");
                            }
                            if (!$insert || $upload == 1) {
                                $select = mysqli_query($connectWarehouse, "SELECT product_id FROM products 
                                                        WHERE product_code = $code[$i];");
                                $row = mysqli_fetch_array($select);
                                $product_id = $row['product_id'];
                                $delete = mysqli_query($connectWarehouse, "DELETE FROM products WHERE product_id = $product_id ;");
                                if ($upload == 1 ) {
                                    $_SESSION['message'] = "Only .jpg, .jpeg and .png file formats allowed.";
                                } else {
                                    $_SESSION['message'] = "File could not be uploaded!!!";
                                }
                                View::load("addproduct");
                            } 
                        }
                    } else {
                        $_SESSION['message'] = "Product could not be added!!";
                    }
                    if ($result && $insert) {
                        $_SESSION['message'] = "Product has been added!!";
                    }
                }  else {
                    $_SESSION['message'] = "Product Code should contain only numbers!!";
                }
            } else {
                $_SESSION['message'] = "Quantity should contain only numbers!!";
            }    
        } else {
            $_SESSION['message'] = "Fill all the details!!";
        }
    }    View::load("addproduct");
} 


class Products
{
    /**
     * This method is used to display the existing products from the database,
     * @return object of the result.
     */
    public function showProducts()
    {
        $connection = new Database();
        $connectWarehouse = $connection->getConnectionToWarehouse();
        $result = mysqli_query($connectWarehouse, "SELECT * FROM product_image ;");
        return $result; 
    }
}