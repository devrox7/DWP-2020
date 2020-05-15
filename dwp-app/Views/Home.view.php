<?php
include_once './Controllers/Home.controller.php';
// include_once './Controllers/About.controller.php';

// $aboutCtrl = new AboutController();

class HomeView extends HomeController
{
    public $info;

    function __construct(){
        // $this->getCompanyInfo();
    }

    // public function getCompantyInfo(){
    //     $this->info =  $aboutCtrl->getInfo() [0];
    // }

    public function calculateDiscount($discount, $price){
        return $price - ($price*($discount/100));
    }

    public function showOfferProducts()
    {
        $offers = $this->getSpecialOffers();
        // var_dump($offers);

        foreach ($offers as $offer) {
            echo "

                <div class='col-12 col-xs-12 col-sm-10 col-md-6 col-lg-4 col-xl-3'>
                    <div class='card '>

                        "; if($offer['Discount'] !== NULL){ echo "
                            <span class='badge badge-pill badge-primary'>Offer <i class='fas fa-star'></i></span>
                        "; } echo"

                        <img  src='./assets/images/{$offer['Image']}' class='card-img-top p-1 duck-img' alt='...''>

                        <div class='card-body'>

                            <h5 class='card-title'>" . $offer['Name'] . "</h5>

                            "; if($offer['Discount'] !== NULL){ echo "
                                

                                <p class='prod-price-disc mb-2' style='color:rgb(252, 186, 0) !importan'>" . $this->calculateDiscount($offer['Discount'], $offer['Price']) . " kr</p>

                                <p class='discounted mb-2'>" . $offer['Price'] . " kr </p>
                            "; } echo"

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

    public function showRecommendations(){
        $latestRec = $this->getRecommendations();
        // var_dump($offers);

        foreach ($latestRec as $rec) {
                echo "
                <div class='col-12 col-xs-12 col-sm-10 col-md-6 col-lg-4 col-xl-3'>
                    <div class='card '>

                        <img  src='./assets/images/{$rec['Image']}' class='card-img-top p-1 duck-img' alt='...''>

                        <div class='card-body'>

                            <h5 class='card-title'>" .  $rec['Name']. "</h5>

                            <p class='prod-price mb-2'>" . $rec['Price'] . " kr </p>

                            <p id='card-text' class='card-text overflow-auto mb-2'>" . $rec['Description'] . "</p>


                        </div>
                    </div>
                </div>";
        }
    }

}

$homeView = new HomeView();


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
        <h3 style='text-align:center'>Special Offers</h3>
    </div>

    <div class='row m-4 d-flex justify-content-center'>";

        $homeView->showOfferProducts();




echo "</div>

</div>";

echo "</div>
</div>
</div>";

echo "<div class='row mt-5 m-4 d-flex justify-content-center'>

<div class='row' style='display:inline-block'>  
        
        </br>
        <h3 style='text-align:center'>Recommendations</h3>
        </div>


    <div class='row m-4 d-flex justify-content-center'>";

       $homeView->showRecommendations();



echo "</div>
</div>
</div>";

echo "<div class='row mt-5 m-4 d-flex justify-content-center'>

<div class='row' style='display:inline-block'>  
        
        </br>
            <h3 style='text-align:center'>Newest Products</h3>
        </div>


    <div class='row m-4 d-flex justify-content-center'>";

       $homeView->showLatestProducts();





// footer
include_once "./assets/layout/footer.php";
?>
