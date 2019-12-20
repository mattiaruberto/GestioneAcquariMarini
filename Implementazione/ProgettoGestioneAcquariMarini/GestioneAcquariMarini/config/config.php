<?php
    //Costanti generali per il database
    define('URL', 'http://localhost/scuola/ProgettoGestioneAcquariMarini/');
    define('PATH', '/scuola/ProgettoGestioneAcquariMarini/');
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("TOCHANGEPASSWORD", "Da cambiare");
    define("NOTCHANGEPASSWORD", "Non cambiare");

    //Costante utilizzata per arrivare alla pagina di login
    define("LOGIN", "login");
    //Costante utilizzata per arrivare alla pagina home
    define("HOME", "home");
    //Costante utilizzata per arrivare alla pagine nuova password
    define("NEW_PASSWORD", "newPassword");
    //Costante che identifica la sessione per identificare se l'utente si è autentificato
    define("AUTHENTIFICATION", "authentification");
    //Costante che identifica se c'è stato un errore nel login
    define("ERROR_REQUEST_NEW_PASSWORD", "errorRequestNewPassword");

    //Costanti vasca della pagina html
    define("TANK_NAME", "name");
    define("TANK_MAGNESIUM", "magnesium");
    define("TANK_CALCIUM", "calcium");
    define("TANK_KH", "kh");
    define("TANK_WATER_CHANGE", "waterChange");
    define("TANK_LITER", "liter");

    //Costanti vasca per il data base
    define("DB_TANK_NAME", "nome");
    define("DB_TANK_MAGNESIUM", "magnesio");
    define("DB_TANK_CALCIUM", "calcio");
    define("DB_TANK_KH", "kh");
    define("DB_TANK_WATER_CHANGE", "ultimo_cambio_acqua");
    define("DB_TANK_LITER", "litri");

    //Costanti utente della pagina html
    define("USER_EMAIL", "email");
    define("USER_NAME", "name");
    define("USER_SURNAME", "surname");
    define("USER_TYPE", "type");
    define("USER_PHONE_NUMBER", "phoneNumber");
    define("USER_PASSWORD", "password");
    define("USER_PASSWORD_CHANGE", "passwordChange");

    //Costanti utente del data base
    define("DB_USER_EMAIL", "email");
    define("DB_USER_NAME", "nome");
    define("DB_USER_SURNAME", "cognome");
    define("DB_USER_TYPE", "tipo");
    define("DB_USER_PHONE_NUMBER", "numeroTelefonico");
    define("DB_USER_PASSWORD_CHANGE", "cambioPassword");
    define("DB_USER_PASSWORD", "password");

    //Costanti abitanti della pagina html
    define("HABITANT_SPECIES", "species");
    define("HABITANT_SEX", "sex");
    define("HABITANT_TYPE", "type");
    define("HABITANT_NUMBER", "number");

    //Costanti abitanti per data base
    define("DB_HABITANT_SPECIES", "specie");
    define("DB_HABITANT_SEX", "genere");
    define("DB_HABITANT_TYPE", "tipo");
    define("DB_HABITANT_NUMBER", "numero");

    //Costanti array contenente informazioni form
    define("PAGE_TITLE", 0);
    define("NAME_BUTTON", 1);
    define("PATH_BUTTON", 2);
    define("ERRORS_STRING", 3);
    define("FORM_BENCHMARK_NAME", 4);
?>