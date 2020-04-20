
<?php
require_once './Models/Product.model.php';

class ProductView extends ProductModel
{

    public function showProducts()
    {
        $products = $this->getProducts();
        // var_dump($products);

        foreach ($products as $product) {
            echo "

                <div class='col-sm-4 col-md-4 col-lg-4 col-xl-2'>
                    <div class='card '>
                        <img  src='./assets/images/{$product['Image']}' class='card-img-top p-1 duck-img' alt='...''>
                        <div class='card-body'>
                            <h5 class='card-title'>" . $product['Name'] . "</h5>
                            <p class='prod-price mb-2'>" . $product['Price'] . " kr </p>
                            <p id='card-text' class='card-text overflow-auto mb-2'>" . $product['Description'] . "</p>
                            <p class='prod-code mb-5 text-muted'>Product Code  #" . $product['Code'] . "</p>
                            <p class='prod-code mb-2 text-muted'>Select Quantity</p>
                            <form><div class='form-row'><div class='col-5 col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-4'><input style='text-align: center;' type='number' class='form-control' placeholder='Quantity' value='0'></div></div></form>
                            <a href='#' class='btn btn-primary mb-2 '>Add to basket <i class='fas fa-shopping-cart'></i></a>


                        </div>
                    </div>
                </div>";

        }

    }

}

$productView = new ProductView();
?>


<?php
// set page headers
$page_title = "Products";
include_once "./assets/layout/header.php";

echo "<div class='row m-4 d-flex justify-content-center'>";
$productView->showProducts();
echo "</div>";
// footer
include_once "./assets/layout/footer.php";
?>
