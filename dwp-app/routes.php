<?php
require_once('router.php');

Route::set('', function(){
    require_once 'Views/Home.view.php';
});
Route::set('/DWP-2020/dwp-app/home', function(){
    require_once 'Views/Home.view.php';
});

Route::set('/DWP-2020/dwp-app/products', function(){

    require_once 'Views/Product.view.php';

});

Route::set('/DWP-2020/dwp-app/admin-panel', function(){

    require_once 'Views/Admin.view.php';

});

Route::set('/DWP-2020/dwp-app/contact', function(){

    require_once 'Views/Contact.view.php';

});
?>