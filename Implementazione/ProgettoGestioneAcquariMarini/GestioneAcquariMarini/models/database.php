<?php

class Database extends PDO{
    /**
     * Atributo rappresentante l'host
     */
    private $host = DB_HOST;
    /**
     * Atributo rappresentante l'user
     */
    private $user = DB_USER;
    /**
     * Atributo rappresentante la password
     */
    private $pass = DB_PASS;
    /**
     * Atributo rappresentante il nome del DB
     */
    private $dbname = "";

    /**
     * Meotod costruttore che effettu la connessione al database.
     * @param $dbname
     */
    public function __construct($dbname){
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
