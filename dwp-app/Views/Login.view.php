<?php
include_once './Controllers/Login.controller.php';

class LoginView extends LoginController{

    public function loginUser($email, $password)
    {
        $result = $this->login($email, $password);
    }

    public function getCAPTCHA($secrectKey){
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$secrectKey}");
        $return = json_decode($response);
        return $return;
    }
}

$loginView = new LoginView();


$page_title = "LOGIN";

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

        $return = $loginView ->getCAPTCHA($_POST['g-recaptcha-response']);

        if($return->success == true && $return->score > 0.5){
            // echo "<div class='alert alert-success'>Succes!</div>";
            $loginView->loginUser($email, $password);
            redirect_to("DWP-2020/dwp-app/home");
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