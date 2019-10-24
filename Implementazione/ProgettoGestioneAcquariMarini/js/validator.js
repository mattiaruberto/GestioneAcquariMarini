function validateUser(){
    var confirmValidate = true;

    var email = document.getElementById("email").value;
    var name = document.getElementById("name").value;
    var surname = document.getElementById("surname").value;
    var type = document.getElementById("type").value;
    var phoneNumber = document.getElementById("phoneNumber").value;
    var passwordChange = document.getElementById("passwordChange").value;

    if(!validateEmail(email)){
        document.getElementById("email").style.border = "1px solid red";
        confirmValidate = false;
    }else{
        document.getElementById("email").style.border = "1px solid green";
    }

    if(!validateString(name,1,45)){
        document.getElementById("name").style.border = "1px solid red";
        confirmValidate = false;
    }else{
        document.getElementById("name").style.border = "1px solid green";
    }

    if(!validateString(surname,1,45)){
        document.getElementById("surname").style.border = "1px solid red";
        confirmValidate = false;
    }else{
        document.getElementById("surname").style.border = "1px solid green";
    }

    if(!validateString(type,1,45) && (type!="Admin" || type!="User")){
        document.getElementById("type").style.border = "1px solid red";
        confirmValidate = false;
    }else{
        document.getElementById("type").style.border = "1px solid green";
    }

    if(!validatePhone(phoneNumber)){
        document.getElementById("phoneNumber").style.border = "1px solid red";
        confirmValidate = false;
    }else{
        document.getElementById("phoneNumber").style.border = "1px solid green";
    }

    if(!validateString(passwordChange,1,45) && (type!="Cambiata" || type!="Da cambiare")){
        document.getElementById("passwordChange").style.border = "1px solid red";
        confirmValidate = false;
    }else{
        document.getElementById("passwordChange").style.border = "1px solid green";
    }
    if(confirmValidate){
        document.getElementById("formAddUser").submit();
    }
}

function validateTank() {
    var confirmValidate = true;

    var name = document.getElementById("tankName").value;
    var calcio = document.getElementById("calcio").value;
    var magnesio = document.getElementById("magnesio").value;
    var kh = document.getElementById("kh").value;
    var waterChange = document.getElementById("waterChange").value;
    var liter = document.getElementById("liter").value;

    if(!validatePrimaryKey(name)){
        document.getElementById("tankName").style.border = "1px solid red";
        confirmValidate = false;
    }else{
        document.getElementById("tankName").style.border = "1px solid green";
    }

    if(!validateNumber(magnesio)){
        document.getElementById("magnesio").style.border = "1px solid red";
        confirmValidate = false;
    }else{
        document.getElementById("magnesio").style.border = "1px solid green";
    }

    if(!validateNumber(calcio)){
        document.getElementById("calcio").style.border = "1px solid red";
        confirmValidate = false;
    }else{
        document.getElementById("calcio").style.border = "1px solid green";
    }

    if(!validateNumber(kh)){
        document.getElementById("kh").style.border = "1px solid red";
        confirmValidate = false;
    }else{
        document.getElementById("kh").style.border = "1px solid green";
    }

    if(!validateDate(waterChange)){
        document.getElementById("waterChange").style.border = "1px solid red";
        confirmValidate = false;
    }else{
        document.getElementById("waterChange").style.border = "1px solid green";
    }

    if(!validateNumber(liter)){
        document.getElementById("liter").style.border = "1px solid red";
        confirmValidate = false;
    }else{
        document.getElementById("liter").style.border = "1px solid green";
    }
    if(confirmValidate){
        document.getElementById("formAddTanke").submit();
    }
}

function validateEmail(email){
    var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!reg.test(email) || !email.length > 0) {
        return false;
    } else {
        return true;
    }
}


function validateNumber(number){
    if (isNaN(number) || !number.toString().length > 0) {
        return false;
    } else {
        return true;
    }
}

function validatePrimaryKey(text){
    var reg = /^[0-9a-z_-]+$/i;
    if (!reg.test(text) || !text.length > 0) {
        return false;
    } else {
        return true;
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

function validateDate(date){
    if (date.length == 10) {
        year = date.substring(0, 4);
        month = date.substring(5, 7) - 1; // because months in JS start from 0
        day = date.substring(8, 10);

        var today = new Date();
        var dayNow = today.getDate();
        var monthNow = today.getMonth()+1; //January is 0!
        var yearNow = today.getFullYear();

        if(year > yearNow){
            return false;
        }else if(year == yearNow){
            if(monthNow > month){
                return false;
            }else if(monthNow == month){
                if(dayNow > day){
                    return false
                }else{
                    return true;
                }
            }else{
                if(day > 0 && day < 31){
                    return true;
                }else{
                    return false;
                }
            }
        }else if(year < yearNow){
            if(month > 0 && month < 13){
                if(day > 0 && day < 31){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }else {
        return false;
    }
}