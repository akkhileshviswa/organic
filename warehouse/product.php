<?php
session_start();
include "model/Database.php";
include "View.php";
if(isset($_POST['submit_row']))
{
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
    for($i=0;$i<count($name);$i++)
    {
        if($name[$i]!="" && $quantity[$i]!="" && $code[$i]!="") {   
            if($checkQuantity == 1 ) {
                if($checkCode == 1) {
                    $result = mysqli_query($connectWarehouse,"INSERT INTO products (product_name, quantity, product_code) 
                                            VALUES('$name[$i]', $quantity[$i], $code[$i]);");
                    if($result) {
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
        View::load("addproduct");
    }    
} 