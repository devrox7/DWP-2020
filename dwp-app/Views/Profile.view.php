<?php
include_once './Controllers/Login.controller.php';

class ProfileView extends LoginController
{

    public $info;

    function __construct(){
        $this->info = $this->getUserInfo();
        // var_dump($_GET);

    }

    public function getUserInfo()
    {
        return $this->getUserById($_SESSION['UserID']);
    }
}

$profileView = new ProfileView();

$page_title = "Profile";

// header
include_once "./assets/layout/header.php";
echo"
<div class='d-flex justify-content-center'>
    <div class='content-container col-12 col-xs-12 col-sm-9 col-md-6 col-lg-5 col-xl-4 m-4'>
        <div class=' d-flex justify-content-center'>
            <div class='text-center col-6'>   
          
               
                    <h5> Name</h5>
                    ". $profileView->info['Name'] ."<br><br><br>

                    <h5>Email</h5>
                        ". $profileView->info['Email'] ."<br><br><br>

                    <h5>Phone</h5>
                        ". $profileView->info['Phone'] ."<br><br><br>

                    <h5> Address</h5>
                        ". $profileView->info['City'] ."
                        ". $profileView->info['ZIP'] .",
                        ". $profileView->info['Address'] ."<br><br><br>

                    <button class='btn btn-primary' disabled>Change Account Information</button><br><br>
                
           
            </div>
        </div>
    </div>
</div>
";

// footer
include_once "./assets/layout/footer.php";
?>