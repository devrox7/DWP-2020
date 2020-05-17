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
    if($_SESSION['RoleID'] == 1){
    require_once 'Views/Admin.view.php';
    }else{
    

    }

});

Route::set('/DWP-2020/dwp-app/contact', function(){

    require_once 'Views/Contact.view.php';

});

Route::set('/DWP-2020/dwp-app/register', function(){
    if(!$_SESSION['UserID'] ){
    require_once 'Views/Register.view.php';
    }
    else{
    require_once 'Views/Homee.view.php';
    }

});

Route::set('/DWP-2020/dwp-app/login', function(){
    if(!$_SESSION['UserID'] ){
    require_once 'Views/Login.view.php';
    }else{
    require_once 'Views/Homee.view.php';
    }

});

Route::set('/DWP-2020/dwp-app/logout', function(){

    require_once 'Views/Logout.view.php';

});

Route::set('/DWP-2020/dwp-app/about', function(){

    require_once 'Views/About.view.php';

});

Route::set("/DWP-2020/dwp-app/profile", function(){

    if(!$_SESSION['UserID'] ){
        require_once 'Views/Login.view.php';
        }else{
        require_once 'Views/Profile.view.php';
        }

});
?>