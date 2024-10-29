
// CREATING A FUNCTION CALLED VALIDATE
function validate() {
    
    // CREATING OF VARIABLES(Are placeholders which are used to store values)
    var name = document.getElementById('name').value;
    var phone = document.getElementById('phone').value;
    // var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var conpassword = document.getElementById('conpassword').value;
    
    
    //ENCRIPTED CODE FOR CHECKING IF NAME IS LETTERS OR ALPHABETS
    var nametype = /^[A-Z a-z]+$/;
    
    
    
    //CREATING A CONDITIONAL STATEMENTS
    
    //CREATING A CONDITION IF NAME IS EMPTY
    if (name == "") {
        document.getElementById('error_name').innerHTML = "Please fill out this field";
        return false;
    }
    
    
    //CHECKING IF NAME INPUT IS NUMBER
    if (nametype.test(name) == false) {
        document.getElementById('error_name').innerHTML = "Please input text";
        return false;
    }
    
    
    //CREATING A CONDITION IF PHONE IS EMPTY
    if (phone == ""){
        document.getElementById("error_phone").innerHTML = "**Please fill out this field";
        return false;
    }
    
    
    //CHECKING IF PHONE NUMBER IS IN NUMBERS
     if (isNaN(phone)){
        document.getElementById("error_phone").innerHTML="** Contact must be only digits";
        return false;
    }
    
    
    //CHECKING IF PHONE NUMBER IS LESS THAN 10
    //  if (phone.length<10){
    //     document.getElementById("error_phone").innerHTML="** Phone Number must be 10 digits";
    //     return false;
    // }
    
    
    //CHECKING IF PHONE NUMBER IS MORE THAN 10
    if (phone.length>13){
        document.getElementById("error_phone").innerHTML="** Phone Number must not be more than 13 digits";
        return false;
    }
    
    
    //CHECKING IF THE FIRST DIGIT OF THE PHONE NUMBER IS NOT ZERO
    // if ((phone.charAt(0) != 0)){
    //     document.getElementById("error_phone").innerHTML="** Contact must begin with 0";
    //     return false;
    // }
    
    
    //CHECKING IF EMAIL IS EMPTY
    // if (email == "") {
    //     document.getElementById('error_email').innerHTML = "Please fill out this field";
    //     return false;
    // }
    
    
    //CHECKING IF PASSWORD IS EMPTY
    if (password == "") {
        document.getElementById('error_password').innerHTML = "Please fill out this field";
        return false;
    }
    
    
    
    if (password.length<=4){
        document.getElementById("error_password").innerHTML="** Password must be more than 5 letters or digits";
        return false;
    }
    
    
    //CHECKING IF CONFIRM PASSWORD IS EMPTY
    if (conpassword == "") {
        document.getElementById('error_conpassword').innerHTML = "Please fill out this field";
        return false;
    }
    
    
    // CHECKING IF PASSWORD AND CONFIRM PASSWORD DOES NOT MATCH
    if(password != conpassword){
        document.getElementById('error_conpassword').innerHTML = "Password does not match";
        return false;
    }
    
    
    
    // else{
    //     alert("Registration Successfully");
    //     //return register.html;
    // }
    
    
    }