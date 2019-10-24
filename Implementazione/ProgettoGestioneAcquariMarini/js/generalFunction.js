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
function showInfo(){
    var el = document.getElementById("listRules");
    if( el && el.style.display == 'none'){
        el.style.display = 'block';
    }else {
        el.style.display = 'none';
    }
}