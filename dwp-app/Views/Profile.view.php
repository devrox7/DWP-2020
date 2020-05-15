<?php
// include_once './Controllers/About.controller.php';

class ProfileView 
{


}

$profileView = new ProfileView();

$page_title = "Profile";

// header
include_once "./assets/layout/header.php";

echo"
<div class='d-flex justify-content-center'>
    <div class='content-container col-12 col-xs-12 col-sm-9 col-md-6 col-lg-5 col-xl-4 m-4'>
    <div class=' d-flex justify-content-center'>
        <form class='col-12 col-xs-12 col-sm-11 col-md-8 col-lg-7 col-xl-6 ' method='post' action=''>
        profile test
        </form>
    </div>
</div>
";

// footer
include_once "./assets/layout/footer.php";
?>