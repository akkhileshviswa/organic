function validate()
{
    var name = validatename();
    var price= validateprice();
    var quantity = validatequantity();
    var file = validateFile();
    if (name && price && quantity && file ) {
        return true;
    }
        return false;

    function validatename()
    {
        var name = document.getElementById("product_name").value;
        var error = "";
        if (name == "") {
            error = "Please enter the product name.";
        }
        nameerr.innerHTML = error;
        return error == "" ? true : false;
    }

    function validateprice()
    {
        let price = document.getElementById("price").value;
        const nostring = /^[A-Za-z]+$/;
        var error = "";
        if (price == "") {
            error = "Please enter the price of the product.";
        }else if ((nostring.test(price))) {
            error = "Please enter a valid price.";
        }
        priceerr.innerHTML = error;
        return error == "" ? true : false;
    }

    function validatequantity()
    {
        var quantity = document.getElementById("quantity").value;
        var error = "";
        if (quantity == "") {
            error = "Please enter the quantity.";
        }
        quantityerr.innerHTML = error;
        return error == "" ? true : false;
    }

    function validateFile()
    {
        var files = document.getElementById("file");
        var file = files.value;
        var error = "";
        var ext = file.substring(file.lastIndexOf('.') + 1);
        if (ext == "") {
            error = "Please upload the image of the product."
        } else if (ext != "jpg") 
        {
            error = "Only image is allowed";
        }
        fileerr.innerHTML = error;
        return error == "" ? true : false;
    }
}