<?php
require_once('router.php');

Route::set('', function(){
    require_once 'Views/Home.view.php';
});
Route::set('/DWP-2020/dwp-app/home', function(){
    require_once 'Views/Home.view.php';
});

Route::set('/DWP-2020/dwp-app/products', function(){
    // echo "productsss";
    require_once 'Views/Product.view.php';

});

Route::set('/DWP-2020/dwp-app/admin-panel', function(){
    // echo "admin paneeel";
    require_once 'Views/Admin.view.php';

});

Route::set('/DWP-2020/dwp-app/contact', function(){
    // echo "admin paneeel";
    require_once 'Views/Contact.view.php';

});
?>