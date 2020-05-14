
<?php
include_once './Controllers/Product.controller.php';

class ProductView extends ProductController
{

    public function calculateDiscount($discount, $price){
        return $price - ($price*($discount/100));
    }

    public function showProducts()
    {
        $products = $this->getProducts();
        // var_dump($products);

        foreach ($products as $product) {
            // $discount = $product['Discount'];
            // $price = $product['Price'];

            echo "

                <div class='col-12 col-xs-12 col-sm-10 col-md-6 col-lg-4 col-xl-3 d-flex align-items-stretch'>
                    <div class='card '>
                        
                        "; if($product['Discount'] !== NULL){ echo "
                            <span class='badge badge-pill badge-primary'>Offer <i class='fas fa-star'></i></span>
                        "; } echo"

                        

                        <div class='card-body'>
                            <img  src='./assets/images/{$product['Image']}' class='card-img-top p-1 duck-img' alt='...''>

                            <h5 class='card-title'>" . $product['Name'] . "</h5>

                            

                            "; if($product['Discount'] !== NULL){ echo "
                                

                                <p class='prod-price-disc mb-2'>" . $this->calculateDiscount($product['Discount'], $product['Price']) . " kr</p>

                                <p class='discounted mb-2'>" . $product['Price'] . " kr </p>
                            "; }
                                else { echo"
                                    <p class='prod-price  mb-2'>" . $product['Price'] . " kr </p>
                                "; } echo" 

                            

                            <p id='card-text' class='card-text overflow-auto mb-2'>" . $product['Description'] . "</p>

                            <p class='prod-code mb-5 text-muted'>Product Code  #" . $product['Code'] . "</p>

                            "; if($product['Discount'] !== NULL){ echo "
                                <button type='button' class='btn btn-discount mb-2'>Read more</button>

                            "; }
                                else { echo"
                                    <button type='button' class='btn btn-primary mb-2'>Read more</button>
                                "; } echo" 

                        </div>
                    </div>
                </div>";

        }

    }

}

$productView = new ProductView();
?>


<?php
// require_once "router.php";
// $request = $_SERVER['REQUEST_URI'];
// $router = new Router($request);

// $router->get('/products', 'Views/Product.view');


// set page headers
$page_title = "Products";
include_once "./assets/layout/header.php";

echo "<div class='container-fluid'><div class='row m-4 d-flex justify-content-center'>";
$productView->showProducts();
echo "</div></div>";
// footer
include_once "./assets/layout/footer.php";
?>


<!-- <p class='prod-code mb-2 text-muted'>Select Quantity</p>

                            <form>
                                <div class='form-row'>
                                    <div class='col-5 col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-4'>
                                        <input style='text-align: center;' type='number' class='form-control' placeholder='Quantity' value='0'>
                                    </div>
                                </div>
                            </form>

                            <button type='button' class='btn btn-primary mb-2 '>Add to basket <i class='fas fa-shopping-cart'></i></button> -->