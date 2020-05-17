<?php
include_once './Controllers/Product.controller.php';


class AdminView extends ProductController{}


$adminView = new AdminView();


$page_title = "Admin Panel";
include_once "./assets/layout/header.php";

// MANAGE PRODUCTS TABLE
echo "
<div class='content-container m-2 mt-3 mb-5'>";
    include './Views/ManageProducts.view.php'; echo" 
</div>";



// MANAGE COMPANY DETAILS TABLE
echo "
<div class='content-container m-2 mb-5' style='margin: 3rem 23px !important'>";
  include './Views/ManageDetails.view.php'; echo " 
</div>";


// MANAGE ORDERS TABLE
echo "
<div class='content-container  m-2 mb-5' style='margin: 3rem 23px !important'>
      <div class='row mb-4'>
        <div class='col'>
          <h4><b>Manage Orders</b></h4>
        </div>
      </div>
      <p>Work in progress</p>
  </div>";

// FOOTER
include_once "./assets/layout/footer.php";
?>
