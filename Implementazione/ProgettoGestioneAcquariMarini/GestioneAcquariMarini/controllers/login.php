<?php
class Login{
    //funzione per controllare gli accessi
    public function index(){
        require 'GestioneAcquariMarini/views/_templates/header.php';
        require 'GestioneAcquariMarini/views/gestioneAcquari/login.php';
        require 'GestioneAcquariMarini/views/gestioneAcquari/newPassword.php';
        require 'GestioneAcquariMarini/views/_templates/footer.php';
    }
    public function checkLogin()
    {
        //setto le 3 variabili vuote
        $email = "";
        $password = "";

        //ricavo i valori dal form
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        }
        if (isset($_POST['password'])) {
            $password = $_POST['password'];
        }

        //chiamo il model e lo istanzio
        require 'application/models/userModel.php';
        $user_model = new UserModel();
        //richiamo la funzione del model per mostrare tutti gli utenti
        $utenti = $user_model->getAllUsers();
        //print_r($utenti);


        $tipo_utente = "";
        $currentUser = array();
        //ciclo l'array utenti
        foreach ($utenti as $ut) {
            //se userame e pass corrispondono
            if ($ut[2] == $email && $ut[3] == $password) {
                $currentUser = ($ut);
            }

        }
        //print_r($utente_corrente);
        //se username e pass non corrispondono
        if (empty($currentUser)) {
            $mess = "Errore, login o password errati.";
            // carico le viste dove mostrerò i risultati
            require 'application/views/_templates/header.php';
            require 'application/views/login/index.php';
            require 'application/views/_templates/footer.php';
        } //se l'utente è nel file
        else {
            $mess = "Benvenuto $currentUser[0] $currentUser[1].";

            require 'application/models/loanModel.php';
            $user_loan = new LoanModel();

            $loans = $user_loan->getAllLoan();

            // carico le viste dove mostrerò i risultati
            require 'application/views/_templates/header.php';
            require 'application/views/loan/index.php';
            require 'application/views/_templates/footer.php';
        }
    }
}
?>
