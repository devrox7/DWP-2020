<?php
include './dbconn.php';

class ProductModel extends DWPDB{

    public function __construct(){
        
    }

    protected function getProducts(){
        $query = "SELECT * FROM products";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
    }

    protected function getProduct($id){
        try {
        $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

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
        }
        catch(PDOException $exception){
            die('ERROR: ' . $exception->getMessage());
        }
    }

    protected function createProduct($name, $price, $description){
        try{
            
        // insert query
        $query = "INSERT INTO products Name:name, Description:description, Price:price";

        // prepare query for execution
        $stmt = $this->connect()->prepare($query);

        // posted values
        $name=htmlspecialchars(strip_tags($_POST['name']));
        $description=htmlspecialchars(strip_tags($_POST['description']));
        $price=htmlspecialchars(strip_tags($_POST['price']));

        // bind the parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);

        // Execute the query
        if($stmt->execute([$name, $price, $description])){
            echo "<div class='alert alert-success'>Record was saved.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
        }
        
        }
        catch(PDOException $exception){
            die('ERROR: ' . $exception->getMessage());
        }
    }

    protected function updateProduct($name, $price, $description){
        // check if form was submitted
        if($_POST){
     
        try{
     
        // write update query
        // in this case, it seemed like we have so many fields to pass and 
        // it is better to label them and not use question marks
        $query = "UPDATE products 
                    SET name=:name, description=:description, price=:price 
                    WHERE id = :id";
 
        // prepare query for excecution
        $stmt = $con->prepare($query);
 
        // posted values
        $name=htmlspecialchars(strip_tags($_POST['name']));
        $description=htmlspecialchars(strip_tags($_POST['description']));
        $price=htmlspecialchars(strip_tags($_POST['price']));
 
        // bind the parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':id', $id);
         
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was updated.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
        }
         
    }
     
    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
    }
    }

    protected function deleteProduct($name, $price, $description){
        try {
            // get record ID
            // isset() is a PHP function used to verify if a value is there or not
            $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
         
            // delete query
            $query = "DELETE FROM products WHERE id = ?";
            $stmt = $con->prepare($query);
            $stmt->bindParam(1, $id);
             
            if($stmt->execute()){
                // redirect to read records page and 
                // tell the user record was deleted
                header('Location: index.php?action=deleted');
            }else{
                die('Unable to delete record.');
            }
        }
         
        // show error
        catch(PDOException $exception){
            die('ERROR: ' . $exception->getMessage());
        }
    }


}