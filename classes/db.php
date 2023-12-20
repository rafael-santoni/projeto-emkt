<?php

class DB {

    const HOST = 'johnny.heliohost.org:3306';
    const USER = 'rafasantoni_conn';
    const PASS = 'thunder02';
    const DB   = 'rafasantoni_emkt';
    public $tabela;
    public $conn;
    public $result;

    public function __construct($tabela=null) {
        $this->tabela = $tabela;
        try{
			$this->conn = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME, self::USER, self::PASS);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e){
			die('Erro: '.$e->getMessage());
		}
        echo "conectou";
    }

}




//echo "mysql:host=$host;dbname=$db,user:$user,pass:$pass";
//$conn = new PDO("mysql:host=$host;dbname=$db",$user,$pass);

