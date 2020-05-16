<?php
include_once './Controllers/About.controller.php';

class AboutView extends AboutController
{
    public $info;

    function __construct(){
        $this->info = $this->getCompanyInfo();
    }

    public function getCompanyInfo()
    {
        return $this->getInfo() [0];
    }

}

$aboutView = new AboutView();

$page_title = "About";

// header
include_once "./assets/layout/header.php";

echo"
<div class='d-flex justify-content-center'>
    <div class='content-container col-12 col-xs-12 col-sm-10 col-md-7 col-lg-6 col-xl-6 m-4'>
    <div class='d-flex justify-content-center'>
        
<div class='text-center col-6'> 
    <h3>". $aboutView->info['Name'] ."</h3>
    <br><br>
    <h4>Company Description</h4>
        ". $aboutView->info['Description'] ."<br><br><br>

    <h4>Opening Hours</h4>
        ". $aboutView->info['OpeningHours'] ."<br><br><br>

    <h4>Contact Info</h4>
        ". $aboutView->info['ContactInfo'] ."<br><br><br>

    <h4>Address</h4>
        ". $aboutView->info['Address'] ."<br><br><br>

        </div>
         
    </div>
</div>
";

// footer
include_once "./assets/layout/footer.php";
?>