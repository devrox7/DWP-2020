<?php
include_once './dbconn.php';



class RegisterModel extends DWPDB{

    protected function registerDB($email, $password, $name, $phone, $address, $city, $zip)
    {
        try {

            // insert query
            $query = "INSERT INTO users (Email, Password, Name, Phone, Address, City, ZIP) VALUES (:email,:password,:name,:phone,:address,:city,:zip)";

            // prepare query for execution
            $stmt = $this->connect()->prepare($query);

            // posted values
            $email = trim(htmlspecialchars(strip_tags($email)));
            $name = trim(htmlspecialchars(strip_tags($name)));
            $phone = trim(htmlspecialchars(strip_tags($phone)));
            $address = trim(htmlspecialchars(strip_tags($address)));
            $city = trim(htmlspecialchars(strip_tags($city)));
            $zip = trim(htmlspecialchars(strip_tags($zip)));

            $password = trim(htmlspecialchars(strip_tags($password)));
            $iterations = ['cost' => 15];
            $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);

            // bind the parameters
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':zip', $zip);

            // Execute the query
            $stmt->execute();
            return true;

        } catch (PDOException $exception) {
            return 'ERROR: ' . $exception->getMessage();
        }
    }

}



?>