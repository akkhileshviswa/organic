function validate(){
    var name = validatename();
    var price = validateprice();
    var quantity = validatequantity();
    if(name && price && quantity ) {
        return true;
    }
        return false;

    function validatename(){
        var name = document.getElementById("product_name").value;
        var error = "";
        if(name == ""){
            error = "Please enter the product name.";
        }
        nameerr.innerHTML = error;
        return error == "" ? true : false;
    }

    function validateprice(){
        let price = document.getElementById("price").value;
        const nostring = /^[A-Za-z]+$/;
        var error = "";
        if(price == "") {
            error = "Please enter the price of the product.";
        } else if((nostring.test(price))) {
            error = "Please enter a valid price.";
        }
        priceerr.innerHTML = error;
        return error == "" ? true : false;
    }

    function validatequantity(){
        var quantity = document.getElementById("quantity").value;
        var error = "";
        if(quantity == ""){
            error = "Please enter the quantity.";
        }
        quantityerr.innerHTML = error;
        return error == "" ? true : false;
    }
}