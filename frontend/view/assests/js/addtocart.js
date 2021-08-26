function insertData(user_id, product_id) {   
    var http = new XMLHttpRequest();
    var params = 'user_id=' + user_id + '&product_id=' +product_id;
    http.open('POST', '../model/AddToCart.class.php', true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.send(params);
}

function changeQuantity(quantity, product_id, price){
    var http = new XMLHttpRequest();
    var total_amount = (price * quantity).toFixed(2);
    document.getElementById(product_id).innerHTML = total_amount;
    var params = 'quantity=' + quantity  + '&product_id=' +product_id + '&total_amount=' + total_amount;
    http.open('POST', '../model/ChangeQuantity.php', true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.send(params);
    //calculateTotalPrice(price,quantity)
    // total = total + (price*quantity);

    // document.getElementById("grandtotal").innerHTML = total;
    // document.getElementById("totalamount").innerHTML = total;
    //   var http = new XMLHttpRequest();
    //   http.open('POST', '../model/CalculateCartTotal.php', true);
    //   http.send();
}

function removeFromCart(cart_id){
    var http = new XMLHttpRequest();
    var params = 'cart_id=' +cart_id;
    http.open('POST', '../model/DeleteCartProduct.php', true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.send(params);
    location.reload();
}


// function calculateTotalPrice(price,quantity){
//     var total =0;
//     var product_price = price;
//     var product_quantity = quantity;
   
//     total = (total + (product_price)*(product_quantity)).toFixed(2);
    
//     document.getElementById("grandtotal").innerHTML = total;
//     document.getElementById("totalamount").innerHTML = total;
//     // var http = new XMLHttpRequest();
//     // http.open('POST', '../model/CalculateCartTotal.php', true);
//     // http.send();
// }