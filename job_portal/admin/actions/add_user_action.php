<?php
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name       =   isset($_POST["name"])       ? $_POST["name"]        :   "";
    $email      =   isset($_POST["email"])      ? $_POST["email"]       :   "";
    $role       =   isset($_POST["role"])       ? $_POST["role"]        :   "";
    $password   =   isset($_POST["password"])   ? $_POST["password"]    :   "";

    if(isset($email))
    {
        $duplicate_email    =   R::findAll("users", "WHERE email = ?", [$email]);
        if($duplicate_email)
        {
            echo json_encode(array(
                "message"   =>  "This email already exist, Try using another one",
                "success"   =>  false
            ));

            exit;
        }
    }

    
    if(isset($password))
    {
        $hashed_password    =   password_hash($password, PASSWORD_DEFAULT);
    }

    $current_date           =   date("Y-m-d");

    $new_user               =   R::dispense("users");
    $new_user->name         =   $name;
    $new_user->email        =   $email;
    $new_user->role         =   $role; 
    $new_user->password     =   $hashed_password;
    $new_user->signup_date  =   $current_date;


    if(R::store($new_user))
    {
        echo json_encode(array(
            "message"   =>  "User added successfully",
            "success"   =>  true
        ));
    }
    
}

?>