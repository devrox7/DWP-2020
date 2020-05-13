<?php
include_once './Models/Login.model.php';


class LoginController extends LoginModel{

protected function login($email, $password){
    return $this->loginDB($email, $password);
}

}
?>