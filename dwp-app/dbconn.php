<?php 

class DWPDB{


    private $host = "localhost";
    private $dbName = "dwpdb";
    private $user = "user_dwpdb";
    private $pass = "pQHGunQvmsmaM9SP";


    protected function connect(){
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbName;
        $pdo = new PDO($dsn, $this->user, $this->pass);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    }


}