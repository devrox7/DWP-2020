<?php
$_SESSION = array();
if(isset($_COOKIE[session_name()])){
    setcookie(session_name(),"", time()-999);
}

session_destroy();
redirect_to("login");