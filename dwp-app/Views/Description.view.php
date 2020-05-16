<?php
include_once './Controllers/About.controller.php';

class DescriptionView extends AboutController
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

$descView = new DescriptionView();




echo"
<div class='d-flex justify-content-center'>
    <div class=' col-12 col-xs-12 col-sm-10 col-md-7 col-lg-6 col-xl-6 m-4'>
    <div class='d-flex justify-content-center'>
        
        <div class='text-center col-10' style='font-size: 17px;
        letter-spacing: 1px;'> 

        ". $descView->info['Description'] ."
        </div>
         
    </div>
    </div>
</div>
";
