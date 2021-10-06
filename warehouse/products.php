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
    function arrayHasOnlyInts($values)
    {
        $test = implode('',$values);
        return is_numeric($test);
    }
    $checkQuantity = arrayHasOnlyInts($quantity);
    $checkCode = arrayHasOnlyInts($code);
    for ($i=0; $i < count($name); $i++) 
    {
        if ($name[$i]!="" && $quantity[$i]!="" && $code[$i]!="") {   
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
                            $_SESSION['message'] = $name[$i]." Product code should be unique!!";
                            View::load("addproduct");
                        }
                    } 
                    $result = mysqli_query($connectWarehouse,"INSERT INTO products (product_name, quantity, product_code) 
                                            VALUES('$name[$i]', $quantity[$i], $code[$i]);");                     
                    if (!$result) {
                        $_SESSION['message'] = "Product could not be added!!";
                    } else {
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
    }    
    View::load("addproduct");
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