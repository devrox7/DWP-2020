<?php
include_once './Models/Login.model.php';


class LoginController extends LoginModel{

protected function login($email, $password){
    return $this->loginDB($email, $password);
}

protected function getUserById($id){
    return $this->getUserByIdDB($id);
}

}
?>