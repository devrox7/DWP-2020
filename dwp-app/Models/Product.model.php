<?php
include './dbconn.php';

class ProductModel extends DWPDB{

    protected function getProducts(){
        $sql = "SELECT * FROM products";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
    }

    // protected function getProduct($id){
    //     $sql = "SELECT * FROM products WHERE ProductID = ?";
    //     $stmt = $this->connect()->prepare($sql);
    //     $stmt->execute([$id]);

    //     $result = $stmt->fetchAll();
    //     return $result;
    // }

    protected function setProduct($name, $price, $description){
        $sql = "INSERT INTO products(Name, Price, Description) VALUES (?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name, $price, $description]);

      
    }

}