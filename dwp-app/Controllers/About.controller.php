<?php
include_once './Models/About.model.php';


class AboutController extends AboutModel{

    protected function getInfo(){
        return $this->getInfoDB();
        
    }

    protected function updateDetails($name, $description, $openingHours, $contactInfo, $address){
        $this->updateDetailsDB($name, $description, $openingHours, $contactInfo, $address);
        
    }

}
