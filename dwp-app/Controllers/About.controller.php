<?php
include_once './Models/About.model.php';


class AboutController extends AboutModel{

    protected function getInfo(){
        return $this->getInfoDB();
        
    }
}
