<?php
include_once './dbconn.php';


class AboutModel extends DWPDB
{
    protected function getInfoDB()
    {
        try {
        $query = "SELECT * FROM company";
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