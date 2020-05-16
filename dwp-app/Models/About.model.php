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


    protected function updateDetailsDB($name, $description, $openingHours, $contactInfo, $address)
    {
            try {
              
                $query = "UPDATE company
                        SET Name=:name, Description=:description, OpeningHours=:openingHours, ContactInfo=:contactInfo, Address=:address
                        WHERE CompanyID = 1";

                // prepare query for excecution
                $stmt = $this->connect()->prepare($query);

                // posted values
                $name = trim(htmlspecialchars(strip_tags(($name))));
                $description = trim(htmlspecialchars(strip_tags(($description))));
                $openingHours = trim(htmlspecialchars(strip_tags($openingHours)));
                $contactInfo = trim(htmlspecialchars(strip_tags($contactInfo)));
                $address = trim(htmlspecialchars(strip_tags($address)));
        
                // bind the parameters
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':openingHours', $openingHours);
                $stmt->bindParam(':contactInfo', $contactInfo);
                $stmt->bindParam(':address', $address);



                
                // Execute the query
                $stmt->execute();
                return true;
            }

            // show errors
             catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
    }

}