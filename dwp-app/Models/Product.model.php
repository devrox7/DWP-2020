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
            $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

            $query = "SELECT * FROM products WHERE ProductID = ? LIMIT 0,1";

            $stmt = $this->connect()->prepare($query);

            // this is the first question mark
            $stmt->bindParam(1, $id);

            $stmt->execute([$id]);

            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
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

    protected function updateProductDB($name, $price, $description)
    {
        // check if form was submitted
        if ($_POST) {

            try {

                // write update query
                // in this case, it seemed like we have so many fields to pass and
                // it is better to label them and not use question marks
                $query = "UPDATE products
                        SET name=:name, description=:description, price=:price
                        WHERE id = :id";

                // prepare query for excecution
                $stmt = $con->prepare($query);

                // posted values
                $name = htmlspecialchars(strip_tags($_POST['name']));
                $description = htmlspecialchars(strip_tags($_POST['description']));
                $price = htmlspecialchars(strip_tags($_POST['price']));

                // bind the parameters
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':id', $id);

                // Execute the query
                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Record was updated.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
                }

            }

            // show errors
             catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        }
    }

    protected function deleteProductDB($id)
    {
        try {
            // get record ID
            // $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

            // delete query
            $query = "DELETE FROM products WHERE id = ?";
            $stmt = $con->prepare($query);
            $stmt->bindParam(1, $id);

            if ($stmt->execute()) {
                // redirect to read records page and
                // tell the user record was deleted
                header('Location: index.php?action=deleted');
            } else {
                die('Unable to delete record.');
            }
        }

        // show error
         catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
    }

}
