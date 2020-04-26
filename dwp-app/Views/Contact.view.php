<?php

// set page headers
$page_title = " Contact Us";

include_once "./assets/layout/header.php";

if($_POST){
    $mymail = "no-reply@roxanaion.com";
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    // $regexp = "/^[^0-9][A-z0-9_-]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_-]+)*[.][A-z]{2,4}$/";
    
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {echo "email wrong";}
    elseif (empty($email) || empty($message) || empty($subject))
    {echo "Empty field";}
    else
    {
        $body = "$message\n\nE-mail: $email";
        mail($mymail,$subject,$body,"From: $email\n");
        echo "Thanks for your E-mail";
    }

    function IsInjected($str){
    $injections = array('(\n+)','(\r+)','(\t+)','(%0A+)','(%0D+)','(%08+)','(%09+)');
               
    $inject = join('|', $injections);
    $inject = "/$inject/i";
    
    if(preg_match($inject,$str))
    {
      return true;
    }
    else
    {
      return false;
    }
}

if(IsInjected($email))
{
    echo "Bad email value!";
    exit;
}
}


echo"
<div class='content-container col-lg-4 col-sm-9 col-md-6 col-xl-4 m-4'>
<form method='post' action=''>
    Email <br /><br /><input type='text' name='email' class='form-control' /><br /><br />
    Subject <br /><br /><input type='text' name='subject' class='form-control' /><br /><br />
    Message <br /><br />
    <textarea name='message' rows='15' cols='40' class='form-control'>
</textarea><br /><br /><br />
    <button type='submit' class='btn btn-primary' name='submit'>Send Message</button>
</form>
</div>
";

// footer
include_once "./assets/layout/footer.php";
?>

