<?php
require_once('router.php');

Route::set('', function(){
    require_once 'Views/Home.view.php';
});
Route::set('home', function(){
    require_once 'Views/Home.view.php';
});

Route::set('products', function(){
    // echo "productsss";
    require_once 'Views/Product.view.php';

});

Route::set('admin-panel', function(){
    // echo "admin paneeel";
    require_once 'Views/Admin.view.php';

});

Route::set('contact', function(){
    // echo "admin paneeel";
    require_once 'Views/Contact.view.php';

});
?>