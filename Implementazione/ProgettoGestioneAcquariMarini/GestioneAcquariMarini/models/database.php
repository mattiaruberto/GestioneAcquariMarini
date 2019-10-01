<?php

class Database extends PDO
{
    //inserisco i valori delle costanti nelle variabili della classe
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = "";


    public function __construct($dbname)
    {
        $this->dbname=$dbname;
        try{
            //creo PDO per mysql
            $dns = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
            parent::__construct($dns, $this->user, $this->pass);
            //setto attributo per ritornare errori PDOException
            $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // meglio disabilitare gli emulated prepared con i driver MySQL
            $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
            //se ci sono errori li ritorno
        catch (PDOException $e){
            echo $e->getMessage();
        }
    }
}
?>
