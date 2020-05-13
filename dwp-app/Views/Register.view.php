<?php
include_once './Controllers/Register.controller.php';

class RegisterView extends RegisterController{

    public function registerUser($email, $password, $name, $phone, $address, $city, $zip)
    {
        $result = $this->register($email, $password, $name, $phone, $address, $city, $zip);
    }

    public function getCAPTCHA($secrectKey){
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$secrectKey}");
        $return = json_decode($response);
        return $return;
    }
}

$registerView = new RegisterView();


$page_title = "Sign Up";

// header
include_once "./assets/layout/header.php";

if($_POST)
{
    if (empty($_POST['token']) || !hash_equals($_SESSION['token'], $_POST['token'])) 
    {
        die(" <div class='alert alert-danger'>Invalid CSFR token</div>");
    }
    
    $_SESSION['token'] = bin2hex(random_bytes(32));
    
        $email = $_POST['email'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $zip = $_POST['zip'];

        $return = $registerView ->getCAPTCHA($_POST['g-recaptcha-response']);

        if($return->success == true && $return->score > 0.5){
            // echo "<div class='alert alert-success'>Succes!</div>";
            $registerView->registerUser($email, $password, $name, $phone, $address, $city, $zip);
            redirect_to("DWP-2020/dwp-app/login");
        }
        else
        {
            die("<div class='alert alert-danger'>You are a bot! </div>");
        }

}



echo"
<div class='d-flex justify-content-center'>
    <div class='content-container col-12 col-xs-12 col-sm-9 col-md-6 col-lg-5 col-xl-5 m-4'>
        <form method='post' action=''>

            <input type='hidden' name='token' value=".$_SESSION['token']." />
            <input type='hidden' id='g-recaptcha-response' name='g-recaptcha-response' class='form-control' />

            Email <br /><br /><input required type='email' name='email' class='form-control' /><br />

            Password <br /><br /><input required type='password' name='password' class='form-control' /><br />

            <hr>

            <div class='d-flex justify-content-center'>Fill in your details</div>

            Full Name <br /><br /><input required type='text' name='name' class='form-control' /><br />

            Phone <br /><br /><input required type='text' name='phone' class='form-control' /><br />

            Address <br /><br /><input required type='text' name='address' class='form-control' /><br />

            City <br /><br /><input required type='text' name='city' class='form-control' /><br />

            ZIP <br /><br /><input required type='text' name='zip' class='form-control' /><br /><br />
            

            <div class='d-flex justify-content-center'>
                <button type='submit' class='btn btn-primary  mt-3 mb-3' name='submit'>Register</button>
            </div>
        </form>
    </div>
</div>
";

// footer
include_once "./assets/layout/footer.php";
?>