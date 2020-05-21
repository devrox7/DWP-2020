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
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }

    }

    protected function createProductDB($name, $price, $discount, $description, $code, $imageName)
    {
        try {

            // insert query
            $query = "INSERT INTO products (Name, Price, Discount, Description, Code, Image) VALUES (:name,:price, :discount,:description,:code,:imageName)";

            // prepare query for execution
            $stmt = $this->connect()->prepare($query);

            // posted values
            $name = htmlspecialchars(strip_tags($name));
            $price = htmlspecialchars(strip_tags($price));
            $discount = htmlspecialchars(strip_tags($discount));
            $description = htmlspecialchars(strip_tags($description));
            $code = htmlspecialchars(strip_tags($code));
            $imageName = htmlspecialchars(strip_tags($imageName));

            // bind the parameters
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':discount', $discount);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':code', $code);
            $stmt->bindParam(':imageName', $imageName);

            // Execute the query
            $stmt->execute();
            return true;

        } catch (PDOException $exception) {
            return 'ERROR: ' . $exception->getMessage();
 
        }
    }

    protected function updateProductDB($id, $name, $price, $discount, $description, $code, $image)
    {
        echo "9";

            try {
          echo "10";
              
                $query = "UPDATE products
                        SET Name=:name, Price=:price, Discount=:discount, Description=:description, Code=:code, Image=IFNULL(NULLIF(:image, ''), Image)
                        WHERE ProductID = :id";

                // prepare query for excecution
                $stmt = $this->connect()->prepare($query);

                // posted values
                $id = htmlspecialchars(strip_tags($id));
                $name = htmlspecialchars(strip_tags($name));
                $description = htmlspecialchars(strip_tags($description));
                $price = htmlspecialchars(strip_tags($price));
                $discount = htmlspecialchars(strip_tags($discount));
                $code = htmlspecialchars(strip_tags($code));
                $image = htmlspecialchars(strip_tags($image));

                // bind the parameters
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':discount', $discount);
                $stmt->bindParam(':code', $code);
                $stmt->bindParam(':image', $image);
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
