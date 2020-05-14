<?php
include_once './Models/Home.model.php';



class HomeController extends HomeModel{

    protected function getSpecialOffers(){
        return $this->getSpecialOffersDB();
        
    }

    protected function getLatestProducts(){
        return $this->getLatestProductsDB();
        
    }

    protected function getRecommendations(){
        return $this->getRecommendationsDB();

    }


}