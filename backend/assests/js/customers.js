function validate(){
    var name = validatename();
    var email = validateemail();
    
    if(name && email){
        return true;
    }
        return false;

    function validatename(){
        var name = document.getElementById("name").value;
        var error = "";
        if(name == ""){
            error = "Please enter the name";
        }
        nameerr.innerHTML = error;
        return error == "" ? true : false;
    }

    function validateemail(){
        var email = document.getElementById("email").value;
        var error = "";
        if(email == ""){
            error = "Please enter the email";
        }else if(email.indexOf("@") == -1 || !(/\w+\d*@\w+.\w+/.test(email))){
            error = "Please enter the valid email"
        }
        emailerr.innerHTML = error;
        return error == "" ? true : false;
    }
}

function changeOrderStatus(cart_id,order_status){
    var http = new XMLHttpRequest();
    var params = 'cart_id=' +cart_id + '&order_status=' +order_status;
    http.open('POST', 'orders', true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.send(params);
    location.reload();
}

function removeOrder(cart_id){
    var http = new XMLHttpRequest();
    var params = 'cart_id=' +cart_id;
    http.open('POST', 'orderstatus', true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.send(params);
    location.reload();
}