<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo $page_title; ?></title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"  rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="./assets/styles.css?v=<?php echo filemtime(getcwd() . "/assets/STYLES.css"); ?>"  rel="stylesheet">

    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY ?>"></script>
        
</head>

<body>

    <!-- container -->
    <div class="container-fluid">

        <nav class="navbar navbar-expand-lg navbar-dark  d-flex">

                <img class="duck-logo" src="./assets/images/logo.png">
                <a class="navbar-brand" href="home">DUCK SHOP</a>




                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>





                    <div class="collapse navbar-collapse row " id="navbarNav">
                        <ul class="navbar-nav col-6 ml-4">

                            <li class="nav-item ">
                                <a class="nav-link " href="home"> <i class="fas fa-home"></i>&nbsp; Home </a>
                            </li>

                            <li class="nav-item ">
                                <a href="products" class="nav-link " href="#"><i class="fas fa-money-check-alt"></i>&nbsp;Products</a>
                            </li>

                            <li class="nav-item ">
                                <a href="contact" class="nav-link" href="#"> <i class="fas fa-address-card"></i> &nbsp;Contact</a>
                            </li>

                            <li class="nav-item ">
                                <a href="about" class="nav-link" href="#"> <i class="fas fa-address-card"></i> &nbsp;About</a>
                            </li>


                            <?php if($_SESSION['RoleID'] == 1 )
                            { ?>

                                <li class="nav-item ">
                                    <a href="admin-panel" class="nav-link" href="#"> <i class="fas fa-user-shield"></i> &nbsp;Admin Panel</a>
                                </li>
                            
                             <?php } ?>
                            

                            

                            

                        </ul>
                    


                        <div class="col d-flex justify-content-md-end justify-content-sm-start">

                        <?php if( isset($_SESSION['UserID']) && !empty($_SESSION['UserID']) )
                        {
                            
                        ?>
                            <div class="logged-user"><?php echo $_SESSION['Name'] ?> </div>
                            <a href="logout"  class="btn btn-outline-light btn-sm  m-1 mr-2"> Logout </a>

                        <?php }else{ ?>
                            <a href="register"  class="btn btn-outline-light btn-sm  m-1"> Register </a>
                            <a href="login" class="btn btn-outline-light btn-sm m-1 mr-3"> Login </a>
                        <?php } ?>
                            <!-- <div class="login-text">SIGN UP/LOG IN &nbsp;</div> -->
                            
                            <div class="user-icon "> <i class="fas fa-user"></i></div>
                        </div>

                    </div>
        </nav>


        
        
        <?php
        // show page header
        echo "
                <div class=' page-header ml-4 pt-4 bp-3'>
                    <div class='row d-flex justify-content-around'>
                    <div   data-toggle='tooltip' data-placement='left' title='Shopping Basket' class='col d-flex justify-content-end'>
                    <div class='basket-icon' >
                        <i class='fas fa-shopping-cart'></i>
                    </div>
                </div>
                        <div class='col-12 text-center'><h1>{$page_title}</h1></div>

                        
                    </div>
                </div>";

        ?>
