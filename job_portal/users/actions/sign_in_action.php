<?php
include("../config.php");
include("../classes/auth_class.php");

if(isset($_POST["email"]) && isset($_POST["password"]))
{
    $email      =   $_POST["email"];
    $password   =   $_POST["password"];

    if($email && $password)
    {
        $login      =   new Auth($email, $password);
        $response   =   $login->authenticate();

        echo json_encode($response);
    }
    else
    {
        echo json_encode(array(
            "message"   =>  "Something went wrong 🙁",
            "success"   =>  false
        ));
    }
}
else 
{
    echo json_encode(array(
        "message"   =>  "Something went wrong 🙁",
        "success"   =>  false
    ));
}
   

// Storing the limit in session so we can use it in setting the limit of cards to display.
if(isset($_POST["limit"]))
{
    $_SESSION["limit"]  =   $_POST["limit"];
}

?>
