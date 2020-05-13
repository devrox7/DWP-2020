<?php
include_once './Models/Register.model.php';


class RegisterController extends RegisterModel{

protected function register($email, $password, $name, $phone, $address, $city, $zip){
    return $this->registerDB($email, $password, $name, $phone, $address, $city, $zip);
}

}
?>