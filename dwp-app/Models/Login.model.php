<?php
include_once './dbconn.php';



class LoginModel extends DWPDB{

    protected function loginDB($email, $password)
    {
        try {

            // insert query
            $query = "SELECT UserID, Email, Password, RoleID FROM users WHERE Email = :email LIMIT 1";

            // prepare query for execution
            $stmt = $this->connect()->prepare($query);

            // posted values
            $email = trim(htmlspecialchars(strip_tags($email)));
            $password = trim(htmlspecialchars(strip_tags($password)));


            // bind the parameters
            $stmt->bindParam(':email', $email);


            // Execute the query
            $stmt->execute();
            
            if (count($stmt)==1){
                $found_user = $stmt->fetch(PDO::FETCH_ASSOC);
                if(password_verify($password, $found_user['Password']))
                {
                    $_SESSION['UserID'] = $found_user['UserID'];
                    $_SESSION['Email'] = $found_user['Email'];
                    $_SESSION['RoleID'] = $found_user['RoleID'];
                    return true;
                }
                else
                {
                    die('credentials failed');
                    // return false;
                }
                
            }
            else
            {
                die("could not find user");
            }

        } 
        catch (PDOException $exception) {
            die('ERROR: '. $exception->getMessage());
        }
    }

}



?>