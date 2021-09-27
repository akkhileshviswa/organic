<?php
    session_start();
    error_reporting(0);
    include "model/Database.php";
    include "View.php";
    if (isset($_POST['submit_row']) && $_POST['name'] !="" && $_POST['code'] !="" && $_FILES['fileUpload']['name'] != "") {
        $connection = new Database();
        $connectWarehouse = $connection->getConnectionToWarehouse();
        $name = $_POST['name'];
        $code = $_POST['code'];
        $uploadsDir = "uploads/";
        $checkCode = is_numeric($code); 
        if ($checkCode != 1) {
            $_SESSION['message'] = "Product Code should contain only numbers!!";
            View::load("addproductimage");
        }
        $allowedFileType = array('jpg','png','jpeg');
        foreach ($_FILES['fileUpload']['name'] as $id=>$val) {
            $fileName      = $_FILES['fileUpload']['name'][$id];
            $tempLocation    = $_FILES['fileUpload']['tmp_name'][$id];
            $targetFilePath  = $uploadsDir.$fileName;
            $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            if (in_array($fileType, $allowedFileType)) {
                if (move_uploaded_file($tempLocation, $targetFilePath)) {
                    $sqlVal = $fileName;
                } else {
                    $_SESSION['message'] = "File could not be uploaded!!!";
                    View::load("addproductimage");
                }
            } else {         
                $upload = 1;                    
            }
            if ($upload != 1) {
                $insert = mysqli_query($connectWarehouse, "INSERT INTO product_image (product_code, product_name, image) 
                                        VALUES ($code, '$name', '$sqlVal');");
            }
            if (!$insert) {
                if ($upload == 1) {
                    $_SESSION['message'] = "Only .jpg, .jpeg and .png file formats allowed!!";
                } else {
                    $_SESSION['message'] = "File could not be uploaded!!!";
                }
                View::load("addproductimage");
            } else {
                $_SESSION['message'] = "Product details has been added!!";
            }
        }
    } else {
        $_SESSION['message'] = "Fill all the details!!";
    }
    View::load("addproductimage");