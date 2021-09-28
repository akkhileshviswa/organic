function changeQuantity(item_quantity, item_id, item_price)
{
    var http = new XMLHttpRequest();
    var row_total = (item_price * item_quantity).toFixed(2);
    document.getElementById(item_id).innerHTML = row_total;
    var params = 'item_quantity=' + item_quantity  + '&item_id=' +item_id + '&row_total=' + row_total;
    http.open('POST', 'updatequantity', true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.send(params);
}

function removeFromCart(item_id)
{
    var http = new XMLHttpRequest();
    var params = 'item_id=' +item_id;
    http.open('POST', 'removecartitem', true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.send(params);
    location.reload();
}

function grandTotal()
{
    var http = new XMLHttpRequest();
    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            document.getElementById("grandtotal").innerHTML = this.responseText;
        }
    }
    http.open("GET", "updatecart", true);
    http.send();
    location.reload();
}