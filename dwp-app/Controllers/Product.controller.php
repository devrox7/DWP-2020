<?php
include_once './Models/Product.model.php';



class ProductController extends ProductModel{

    protected function getProducts(){
        return $this->getProductsDB();
        
    }

    protected function getProduct($id){
        $this->getProductDB($id);
        
    }

    protected function updateProduct($name, $price, $discount, $description, $code, $image){
        $this->updateProductDB($name, $price, $discount, $description, $code, $image);
        
    }

    protected function createProduct($name, $price, $discount, $description, $code, $image){
        $this->createProductDB($name, $price, $discount, $description, $code, $image);
    }

    protected function deleteProduct($id){
        $this->deleteProductDB($id);
    }
}

// $product = new Product();
// var_dump($product);