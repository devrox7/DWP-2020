<?php
include_once './Models/Home.model.php';



class HomeController extends HomeModel{

    public function getSpecialOffers(){
        return $this->getSpecialOffersDB();
        
    }

    public function getLatestProducts(){
        return $this->getLatestProductsDB();
        
    }


}