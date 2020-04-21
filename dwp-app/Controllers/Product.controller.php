<?php
include_once './Models/Product.model.php';



class ProductController extends ProductModel{

    public function createProduct($name, $price, $description){
        $this->setProduct($name, $price, $description);
    }

}

// $product = new Product();
// var_dump($product);