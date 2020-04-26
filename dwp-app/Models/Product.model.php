<?php
include_once './dbconn.php';

class ProductModel extends DWPDB
{

    public function __construct()
    {
    }

    protected function getProductsDB()
    {
        try {
        $query = "SELECT * FROM products";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
        }
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
    }

    protected function getProductDB($id)
    {
        try {
            $query = "SELECT * FROM products WHERE ProductID = :id LIMIT 0,1";

            $stmt = $this->connect()->prepare($query);

            // this is the first question mark
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }

    }

    protected function createProductDB($name, $price, $description, $code, $image)
    {
        try {

            // insert query
            $query = "INSERT INTO products (Name, Price, Description, Code, Image) VALUES (:name,:price,:description,:code,:image)";

            // prepare query for execution
            $stmt = $this->connect()->prepare($query);

            // posted values
            $name = htmlspecialchars(strip_tags($name));
            $price = htmlspecialchars(strip_tags($price));
            $description = htmlspecialchars(strip_tags($description));
            $code = htmlspecialchars(strip_tags($code));
            $image = htmlspecialchars(strip_tags($image));

            // bind the parameters
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':code', $code);
            $stmt->bindParam(':image', $image);

            // Execute the query
            $stmt->execute();
            return true;
            // if () {
            //     echo "<div class='alert alert-success'>New product was saved.</div>";
            // } else {
            //     echo "<div class='alert alert-danger'>Unable to create product.</div>";
            // }

        } catch (PDOException $exception) {
            echo 'ERROR: ' . $exception->getMessage();
            return false;
        }
    }

    protected function updateProductDB($name, $price, $description, $code, $image, $id)
    {
            try {

                $query = "UPDATE products
                        SET Name=:name, Description=:description, Price=:price, Code=:code, Image=:image
                        WHERE ProductID = :id";

                // prepare query for excecution
                $stmt = $this->connect()->prepare($query);

                // posted values
                $name = htmlspecialchars(strip_tags($_POST['name']));
                $description = htmlspecialchars(strip_tags($_POST['description']));
                $price = htmlspecialchars(strip_tags($_POST['price']));
                $code = htmlspecialchars(strip_tags($_POST['code']));
                $image = htmlspecialchars(strip_tags($_POST['image']));
                $id = htmlspecialchars(strip_tags($_POST['id']));

                // bind the parameters
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':code', $price);
                $stmt->bindParam(':image', $price);
                $stmt->bindParam(':id', $id);

                // Execute the query
                $stmt->execute();
                return true;
            }

            // show errors
             catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
    }


    protected function deleteProductDB($id)
    {
        try {
            // delete query
            $query = "DELETE FROM products WHERE ProductID = :id";
            $stmt = $this->connect()->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return true;
        }

        // show error
         catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
    }

}
