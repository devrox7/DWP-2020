<?php
include_once './dbconn.php';


class HomeModel extends DWPDB
{

    public function __construct()
    {
    }

    protected function getSpecialOffersDB()
    {
        try {
        $query = "SELECT * FROM products WHERE SpecialOffer='1'";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
        }
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
    }

    protected function getLatestProductsDB()
    {
        try {
        $query = "SELECT * FROM products ORDER BY ProductID DESC LIMIT 3";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
        }
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
    }

}

?>