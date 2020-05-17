<?php
include_once './Models/Product.model.php';



class ProductController extends ProductModel{

    protected function getProducts(){
        return $this->getProductsDB();
        
    }

    protected function getProduct($id){
        $this->getProductDB($id);
        
    }

    protected function updateProduct($id, $name, $price, $discount, $description, $code, $image){
        echo "8";

        $this->updateProductDB($id, $name, $price, $discount, $description, $code, $image);
        
    }

    protected function createProduct($name, $price, $discount, $description, $code, $imageName){
        $this->createProductDB($name, $price, $discount, $description, $code, $imageName);
    }

    protected function deleteProduct($id){
        $this->deleteProductDB($id);
    }
}

// $product = new Product();
// var_dump($product);