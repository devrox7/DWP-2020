<?php
include_once './Models/Product.model.php';



class ProductController extends ProductModel{

    protected function getProducts(){
        return $this->getProductsDB();
        
    }

    protected function createProduct($name, $price, $description, $code, $image){
        $this->createProductDB($name, $price, $description,$code, $image);
    }

    protected function deleteProduct($id){
        $this->deleteProductDB($id);
    }
}

// $product = new Product();
// var_dump($product);