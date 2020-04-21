<?php
include_once './Controllers/Home.controller.php';

class ProductView extends HomeController
{

    public function showProducts()
    {
        $offers = $this->getSpecialOffers();
        // var_dump($offers);

        foreach ($offers as $offer) {
            echo "

                <div class='col-sm-4 col-md-4 col-lg-4 col-xl-2'>
                    <div class='card '>

                        <img  src='./assets/images/{$offer['Image']}' class='card-img-top p-1 duck-img' alt='...''>

                        <div class='card-body'>

                            <h5 class='card-title'>" . $offer['Name'] . "</h5>

                            <p class='prod-price mb-2'>" . $offer['Price'] . " kr </p>

                            <p id='card-text' class='card-text overflow-auto mb-2'>" . $offer['Description'] . "</p>

                            <p class='prod-code mb-5 text-muted'>Product Code  #" . $offer['Code'] . "</p>

                            <p class='prod-code mb-2 text-muted'>Select Quantity</p>

                            <form>
                                <div class='form-row'>
                                    <div class='col-5 col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-4'>
                                        <input style='text-align: center;' type='number' class='form-control' placeholder='Quantity' value='0'>
                                    </div>
                                </div>
                            </form>

                            <button type='button' class='btn btn-primary mb-2 '>Add to basket <i class='fas fa-shopping-cart'></i></button>


                        </div>
                    </div>
                </div>";
        }

    }

    public function showLatestProducts(){
        $latestProducts = $this->getLatestProducts();
        // var_dump($offers);

        foreach ($latestProducts as $product) {
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

                            <form>
                                <div class='form-row'>
                                    <div class='col-5 col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-4'>
                                        <input style='text-align: center;' type='number' class='form-control' placeholder='Quantity' value='0'>
                                    </div>
                                </div>
                            </form>

                            <button type='button' class='btn btn-primary mb-2 '>Add to basket <i class='fas fa-shopping-cart'></i></button>


                        </div>
                    </div>
                </div>";
        }
    }

}

$productView = new ProductView();
// set page headers
$page_title = "";
include_once "./assets/layout/header.php";

echo "
<div class='row mt-5 m-4 d-flex justify-content-center'>
    <div class='row' style='display:inline-block'>
           
        <h1>WELCOME TO THE RUBBER DUCK SHOP</h1>
        </br>
        <h3 style='text-align:center'>See our Special Offers</h3>
           

    </div>
<div class='row m-4 d-flex justify-content-center'>";
$productView->showProducts();

echo"</div>
</div>
";

echo "
<div class='row mt-5 m-4 d-flex justify-content-center'>
    <div class='row' style='display:inline-block'>
        <h3 style='text-align:center'>Newest Additions</h3>
    </div>
<div class='row m-4 d-flex justify-content-center'>";
$productView->showLatestProducts();

echo"</div>
</div>
";


// footer
include_once "./assets/layout/footer.php";
?>
