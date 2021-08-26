function validate(){
    var firstname = validatefirstname();
    var lastname = validatelastname();
    var country = validatecountry();
    var address = validateaddress();
    var town = validatetown();
    var state = validatestate();
    var postalcode = validatepostalcode();
    var phone = validatephone();
    var email = validateemail();
    var shipping = validateshipping()
    var cash = validatecash();
    var terms = validateterms();
    if(firstname && lastname && address && country && town && state && postalcode && phone && email && shipping && cash && terms){
        return true;
    }
        return false;

    function validatefirstname(){
        var name = document.getElementById("firstname").value;
        var error = "";
        if(name == ""){
            error = "Please enter the first name.";
        }
        firstnameerr.innerHTML = error;
        return error == "" ? true : false;
    }

    function validatelastname(){
        var name = document.getElementById("lastname").value;
        var error = "";
        if(name == ""){
            error = "Please enter the last name.";
        }
        lastnameerr.innerHTML = error;
        return error == "" ? true : false;
    }

    function validatecountry(){
        var select = document.getElementById("country").value;
        var error = "";
        if(select == "select"){
            error = "Please select the country.";
        }
        countryerr.innerHTML = error;
        return error == "" ? false : true;
    }

    function validateaddress(){
        var address = document.getElementById("address").value;
        var error = "";
        if(address == ""){
            error = "Please enter the address.";
        }
        addresserr.innerHTML = error;
        return error == "" ? true : false;
    }

    function validatetown(){
        var town = document.getElementById("town").value;
        var error = "";
        if(town == ""){
            error = "Please enter the town.";
        }
        townerr.innerHTML = error;
        return error == "" ? true : false;
    }

    function validatestate(){
        var select = document.getElementById("state").value;
        var error = "";
        if(select == "select"){
            error = "Please select the state.";
        }
        stateerr.innerHTML = error;
        return error == "" ? false : true;
    }

    function validatepostalcode(){
        var number = document.getElementById("postalcode").value;
        var error = "";
        if(number == ""){
            error = "Please enter the postalcode.";
        }else if(!(/^\d{6}$/.test(number))){
            error = "Please enter the valid postalcode.";
        }
        postalerr.innerHTML = error;
        return error == "" ? true : false;
    }

    function validatephone(){
        var number = document.getElementById("phone").value;
        var error = "";
        if(number == ""){
            error = "Please enter the mobile number.";
        }else if(!(/^\d{10}$/.test(number))){
            error = "Please enter the valid mobile number.";
        }
        phoneerr.innerHTML = error;
        return error == "" ? true : false;
    }

    function validateemail(){
        var email = document.getElementById("email").value;
        var error = "";
        if(email == ""){
            error = "Please enter the email";
        }else if(email.indexOf("@") == -1 || !(/\w+\d*@\w+.\w+/.test(email))){
            error = "Please enter the valid email."
        }
        emailerr.innerHTML = error;
        return error == "" ? true : false;
    }

    function validateshipping(){
        var shipping = document.getElementById("shipping");
        var free = document.getElementById("free");
        var local = document.getElementById("local");
        var error = "";
        if(!(shipping.checked == true || free.checked == true || local.checked == true)){
            error = "Please select the shipping type.";
        }
        shippingerr.innerHTML = error;
        return error == "" ? true : false;
    }

    function validatecash(){
        var cash = document.getElementById("cash");
        var error = "";
        if(!(cash.checked == true)){
            error = "Please select the delivery type.";
        }
        casherr.innerHTML = error;
        return error == "" ? true : false;
    }

    function validateterms(){
        var term = document.getElementById("terms");
        var error = "";
        if(!(term.checked == true)){
            error = "Please read and accept the terms and conditions to proceed with your order.";
        }
        termserr.innerHTML = error;
        return error == "" ? true : false;
    }
}
