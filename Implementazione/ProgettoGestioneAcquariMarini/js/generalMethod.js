const URL = 'http://localhost/scuola/ProgettoGestioneAcquariMarini/';
function confirmDeleteTank(name, url) {
    if (confirm("Sei sicuro di voler cancellare: "+name)) {
        location.replace(url+'tankManagement/delete/'+name);
    }
}
function confirmDeleteUser(email, url) {
    if (confirm("Sei sicuro di voler cancellare: "+email)) {
        location.replace(url+'userManagement/delete/'+email);
    }
}
function moveToAddTank(){
    window.location.href = URL+"tankManagement/formAddTank";
}
function showInfo(){
    var el = document.getElementById("listRules");
    if( el && el.style.display == 'none'){
        el.style.display = 'block';
    }else {
        el.style.display = 'none';
    }
}
function changePassword(){
    var emailToChange = prompt("Perfavore inserisci la tua email:");
    if(emailToChange.length > 0) {
        window.location.href = URL+"login/updatePassword/"+emailToChange;
    }else{
        alert("Devi inserire per forza un email");
    }
}
function changeStateFormHabitant(){
    var state = document.getElementById("divFormGestioneAbitante");
    if(document.getElementById("divFormGestioneAbitante").style.display == "none"){
        document.getElementById("divFormGestioneAbitante").style.display="block";
    }else{
        document.getElementById("divFormGestioneAbitante").style.display="none";
    }
}