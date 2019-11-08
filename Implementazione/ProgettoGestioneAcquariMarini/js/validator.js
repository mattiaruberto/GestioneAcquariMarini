function validateNumber(number, min, max){
    var reg = /^[0-9]/i;
    if (reg.test(number) && number >= min && number <= max) {
        return true;
    } else {
        return false;
    }
}

function validateTankName(){
    var tankName = document.getElementById("tankName").value;
    var reg = /^[0-9a-z_-]+$/i;
    if (reg.test(tankName) && tankName.length > 0 && tankName.length <= 45 ) {
        document.getElementById("tankName").style.border = "1px solid green";
    } else {
        document.getElementById("tankName").style.border = "1px solid red";
    }
}

function validateMagnesium(){
    var magnesium = document.getElementById("magnesium").value;
    if(!validateNumber(magnesium, 0, 3000)){
        document.getElementById("magnesium").style.border = "1px solid red";
    }else{
        document.getElementById("magnesium").style.border = "1px solid green";
    }
}

function validateCalcium(){
    var calcium = document.getElementById("calcium").value;
    if(!validateNumber(calcium, 0, 1000)){
        document.getElementById("calcium").style.border = "1px solid red";
    }else{
        document.getElementById("calcium").style.border = "1px solid green";
    }
}

function validateKh(){
    var kh = document.getElementById("kh").value;
    if(!validateNumber(kh, 0, 20)){
        document.getElementById("kh").style.border = "1px solid red";
        confirmValidate = false;
    }else{
        document.getElementById("kh").style.border = "1px solid green";
    }
}

function validateDate(){
    var date = document.getElementById("waterChange").value;
    var validateDate = false;
    if (date.length == 10) {
        year = date.substring(0, 4);
        month = date.substring(5, 7) - 1; // because months in JS start from 0
        day = date.substring(8, 10);

        var today = new Date();
        var dayNow = today.getDate();
        var monthNow = today.getMonth()+1; //January is 0!
        var yearNow = today.getFullYear();

        if(year == yearNow){
            if(monthNow == month){
                if(dayNow < day){
                    validateDate = true
                }
            }else{
                if(day > 0 && day < 31){
                    validateDate = true;
                }
            }
        }else if(year < yearNow){
            if(month > 0 && month < 13){
                if(day > 0 && day < 31){
                    validateDate = true;
                }
            }
        }
    }
    if(validateDate){
        document.getElementById("waterChange").style.border = "1px solid green";
    }else{
        document.getElementById("waterChange").style.border = "1px solid red";
    }
}

function validateLiter(){
    var liter = document.getElementById("liter").value;
    if(!validateNumber(liter, 0, 1000000)){
        document.getElementById("liter").style.border = "1px solid red";
    }else{
        document.getElementById("liter").style.border = "1px solid green";
    }
}

function validateString(string,characterMin,characterMax){
    var reg = /^[a-zèéëàáäìíòöóüùú\s]+$/i;
    if(string.length >= characterMin && string.length <= characterMax){
        if(!reg.test(string)){
            return false;
        }else{
            return true;
        }
    }else{
        return false;
    }
}

function validatePhone(phoneNumber){
    var reg = /^[0-9\s+#]+$/i;
    if(phoneNumber.length >= 9 && phoneNumber.length <= 30){
        if(!reg.test(phoneNumber)){
            return false;
        }else{
            return true;
        }
    }else{
        return false;
    }
}

function validateEmail(){
    var email = document.getElementById("email").value;
    var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (reg.test(email) || email.length > 0) {
        document.getElementById("email").style.border = "1px solid green";
    } else {
        document.getElementById("email").style.border = "1px solid red";
    }
}