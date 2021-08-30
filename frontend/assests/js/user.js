//Validation for register
function validate(){
    var name = validatename();
    var email = validateemail();
    var password = validatepassword();
    if(name && email && password){
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

    function validatepassword(){
        var password = document.getElementById("password").value;
        var error = "";
        if(password == ""){
            error = "Please enter the password";
        }
        passworderr.innerHTML = error;
        return error == "" ? true : false;
    }
}


//Validation for login
function loginvalidate(){
    var name = loginname();
    var password = loginpassword();
    if(name && password){
        return true;
    }
        return false;

    function loginname(){
        var loginname = document.getElementById("loginname").value;
        var loginerror = "";
        if(loginname == ""){
            loginerror = "Please enter the username";
        }
        loginnameerr.innerHTML = loginerror;
        return loginerror == "" ? true : false;
    }

    function loginpassword(){
        var loginpassword = document.getElementById("loginpassword").value;
        var loginerror = "";
        if(loginpassword == ""){
            loginerror = "Please enter the password";
        }
        loginpassworderr.innerHTML = loginerror;
        return loginerror == "" ? true : false;
    }
}
