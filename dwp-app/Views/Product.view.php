<?php
include './Models/Product.model.php';

class ProductView extends ProductModel{

    public function showProducts(){
        $products = $this->getProducts();
        // var_dump($products);

        foreach($products as $product){
            echo "ID: "."<b>". $product['ProductID']."</b>" ." |  ";
            echo "Name: "."<b>". $product['Name']."</b>" ." |  ";
            echo "Price: "."<b>". $product['Price']."</b> kr"." |  ";
            echo "Code: "."<b>". $product['Code']."</b> kr"." |  ";
            echo "Description: "."<b>". $product['Description']."</b><br>";
            echo "<img src='./assets/images/{$product['Image']}'> <br><br>";

        }
        // echo "Products:".$result['Name'] .",";
    }
}