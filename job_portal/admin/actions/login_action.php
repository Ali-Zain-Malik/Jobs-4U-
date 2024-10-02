<?php 
include("../config.php");

header('Content-Type: application/json');

if(isset($_POST["email"]) && isset($_POST["password"]))
{
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];

    $user = R::findOne("users", "email = ?", [$email]);

    if($user && $user->role === '2')
    {
        if(password_verify($password, $user->password))
        {
            $_SESSION["id"]     =   $user->id;
            $_SESSION["email"]  =   $email;        
            echo json_encode(true);// Meaning that the right person is logging in with correct details.         
        }
        else
        {
            echo json_encode(false);
        }
    }
    else
    {
        echo json_encode(false);
    }
}
?>


