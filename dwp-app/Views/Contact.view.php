<?php

class ContactView {

    public function sendEmail($email, $subject,$message, $fullName)
    {
        $mymail = "ion.roxana27@gmail.com";


        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            {
                echo "<div class='alert alert-warning'>Wrong email format!</div>";
            }
        else if (empty($email) || empty($message) || empty($subject))
            {
                echo "<div class='alert alert-warning'>Fill in all fields!</div>";
            }
        else
            {
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= "From: {$fullName} <no-reply@roxanaion.com>" . "\r\n" .
                            "Reply-To: {$email}" . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();

                $body = "$message\n\n <br> E-mail: $email";
                if(!mail($mymail,$subject,$body,$headers)){
                    echo " <div class='alert alert-danger'>The email could not be sent... </div>";
                }
                // mail($mymail,$subject,$body,"From: $fullName no-reply@roxanaion.com\n Reply-To: $email ");
                echo "<div class='alert alert-success'>Thank you for your E-mail! We'll get back to you as soon as possible :)</div>";
            }
    }

    public function getCAPTCHA($secrectKey){
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$secrectKey}");
        $return = json_decode($response);
        return $return;
    }

}

$contactView = new ContactView();


// set page headers
$page_title = "Contact Us";

include_once "./assets/layout/header.php";

if($_POST)
{
    if (!empty($_POST['token']) && hash_equals($_SESSION['token'], $_POST['token'])) 
    {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    
        $email = trim(htmlspecialchars(strip_tags(($_POST['email']))));
        $fullName = trim(htmlspecialchars(strip_tags(($_POST['fullName']))));
        $subject = trim(htmlspecialchars(strip_tags($_POST['subject'])));
        $message = trim(htmlspecialchars(strip_tags($_POST['message'])));

        $return = $contactView->getCAPTCHA($_POST['g-recaptcha-response']);

        if($return->success == true && $return->score > 0.5){
            // echo "<div class='alert alert-success'>Succes!</div>";
            $contactView->sendEmail($email,$subject,$message,$fullName);
        }
        else
        {
            die("<div class='alert alert-danger'>You are a bot! </div>");
        }

    }
    else
    {
        die(" <div class='alert alert-danger'>Invalid CSFR token</div>");
    }

}



echo"
<div class='d-flex justify-content-center'>
    <div class='content-container col-12 col-xs-12 col-sm-9 col-md-6 col-lg-5 col-xl-4 m-4'>
        <form method='post' action=''>

            <input type='hidden' name='token' value=".$_SESSION['token']." />

            Full Name <br /><br /><input required type='text' name='fullName' class='form-control' /><br />

            Email <br /><br /><input required type='email' name='email' class='form-control' /><br />

            Subject <br /><br /><input required type='text' name='subject' class='form-control' /><br />

            Message <br /><br /><textarea required name='message' rows='15' cols='40' class='form-control'></textarea><br /><br /><br />

            <input type='hidden' id='g-recaptcha-response' name='g-recaptcha-response' class='form-control' />

            <button type='submit' class='btn btn-primary' name='submit'>Send Message</button>
        </form>
    </div>
</div>
";

// footer
include_once "./assets/layout/footer.php";
?>

