<?php
include_once './Controllers/Home.controller.php';

class ProductView extends HomeController
{

    public function showOfferProducts()
    {
        $offers = $this->getSpecialOffers();
        // var_dump($offers);

        foreach ($offers as $offer) {
            echo "

                <div class='col-12 col-xs-12 col-sm-10 col-md-6 col-lg-4 col-xl-3'>
                    <div class='card '>

                        <img  src='./assets/images/{$offer['Image']}' class='card-img-top p-1 duck-img' alt='...''>

                        <div class='card-body'>

                            <h5 class='card-title'>" . $offer['Name'] . "</h5>

                            <p class='prod-price mb-2'>" . $offer['Price'] . " kr </p>

                            <p id='card-text' class='card-text overflow-auto mb-2'>" . $offer['Description'] . "</p>

                            


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
                <div class='col-12 col-xs-12 col-sm-10 col-md-6 col-lg-4 col-xl-3'>
                    <div class='card '>

                        <img  src='./assets/images/{$product['Image']}' class='card-img-top p-1 duck-img' alt='...''>

                        <div class='card-body'>

                            <h5 class='card-title'>" .  $product['Name']. "</h5>

                            <p class='prod-price mb-2'>" . $product['Price'] . " kr </p>

                            <p id='card-text' class='card-text overflow-auto mb-2'>" . $product['Description'] . "</p>


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

// SPECIAL OFFERS
echo "
<div class='container-fluid'>
<div class='row mt-5 m-4 d-flex justify-content-center'>

    <div class='row pt-3' style='display:inline-block;text-align: center;'>  
        <h1>WELCOME TO THE RUBBER DUCK SHOP</h1>
        </br>
        <h3 style='text-align:center'>See our Special Offers</h3>
    </div>

    <div class='row m-4 d-flex justify-content-center'>";

        $productView->showOfferProducts();




echo "</div>

</div>";

echo "<div class='row mt-5 m-4 d-flex justify-content-center'>

<div class='row' style='display:inline-block'>  
        
        </br>
        <h3 style='text-align:center'>See our Latest Products</h3>
        </div>


    <div class='row m-4 d-flex justify-content-center'>";

       $productView->showLatestProducts();



echo "</div>
</div>
</div>";


// footer
include_once "./assets/layout/footer.php";
?>
