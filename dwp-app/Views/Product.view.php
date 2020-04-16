<?php
include './Models/Product.model.php';

class ProductView extends ProductModel{

    public function showProducts(){
        $products = $this->getProducts();
        // var_dump($products);

        foreach($products as $product){
            echo "<tr>";
            echo "<td>".$product['ProductID']."</td> ";
            echo "<td>".$product['Name']."</td>  ";
            echo "<td>".$product['Price']." kr </td> ";
            echo "<td>".$product['Code']."  </td> ";
            echo "<td>".$product['Description']."</td> ";
            echo "<td> <img style='width:40px; height: 40px' src='./assets/images/{$product['Image']}'> </td> ";
            echo "<td><button>Delete</button</td> ";
            echo "<td><button>Edit</button</td> ";

            echo "</tr>";

        }
        // echo "Products:".$result['Name'] .",";
    }
}

$productView = new ProductView();

?>

<html>
<div class="container">
<table style="width:100%">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Price</th>
    <th>Code</th>
    <th>Description</th>
    <th>Image</th>
    <th></th>
    <th></th>
  </tr>
  
    <?php
    $productView->showProducts();
    ?>
 

</table>
</div>
</html>
