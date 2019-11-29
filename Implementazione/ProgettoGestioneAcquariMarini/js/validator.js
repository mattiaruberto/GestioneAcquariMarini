function validateNumber(selectObject, min, max){
    var number = selectObject.value;
    var reg = /^[0-9]/i;
    if (reg.test(number) && number >= min && number <= max) {
        selectObject.style.border = "1px solid green";
    } else {
        selectObject.style.border = "1px solid red";
    }
}

function validateTankName(selectObject){
    var tankName = selectObject.value;
    var reg = /^[0-9a-z_-]+$/i;
    if (reg.test(tankName) && tankName.length > 0 && tankName.length <= 45 ) {
        selectObject.style.border = "1px solid green";
    } else {
        selectObject.style.border = "1px solid red";
    }
}

function validateDate(selectObject){
    var date = selectObject.value;
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
        selectObject.style.border = "1px solid green";
    }else{
        selectObject.style.border = "1px solid red";
    }
}

function validatePhone(selectObject){
    var phoneNumber = selectObject.value;
    var reg = /^[0-9\s+#]+$/i;
    if(phoneNumber.length >= 9 && phoneNumber.length <= 30 && reg.test(phoneNumber)){
        selectObject.style.border = "1px solid green";
    }else{
        selectObject.style.border = "1px solid red";
    }
}

function validateEmail(selectObject){
    var email = selectObject.value;
    var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (reg.test(email) && email.length > 0) {
        selectObject.style.border = "1px solid green";
    } else {
        selectObject.style.border = "1px solid red";
    }
}

function validateString(selectObject,characterMin,characterMax){
    var string = selectObject.value;
    var reg = /^[a-zèéëàáäìíòöóüùú\s]+$/i;
    if(string.length >= characterMin && string.length <= characterMax && reg.test(string)){
        selectObject.style.border = "1px solid green";
    }else{
        selectObject.style.border = "1px solid red";
    }
}

function validateSelectChangePassword(object){
    var select = object.value;
    if(select == "Da cambiare" || select == "Non cambiare"){
        object.style.border = "1px solid green";
    }else{
        object.style.border = "1px solid red";
    }
}

function validateSelectPermission(object){
    var select = object.value;
    if(select == "Admin" || select == "User"){
        object.style.border = "1px solid green";
    }else{
        object.style.border = "1px solid green";
    }
}


