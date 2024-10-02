<?php
include("../config.php");
include("../classes/user_class.php");
// if(isset($_POST["flag"]))
// {
//     $email      =   (isset($_POST["email"]))    ?   $_POST["email"]     :   null;
//     $name       =   (isset($_POST["name"]))     ?   $_POST["name"]      :   null;
//     $role       =   (isset($_POST["role"]))     ?   $_POST["role"]      :   null;
//     $password   =   (isset($_POST["password"])) ?   $_POST["password"]  :   null;

//     if($password)
//     {
//         $hashed_password    =   password_hash($password, PASSWORD_DEFAULT);
//     }

//     if(duplicateEmail($email))
//     {
//         echo json_encode(array(
//             "message"   =>  "This email already exists", 
//             "success"   =>  false
//         ));

//         exit;
//     }
//     else
//     {
//         $user   =   R::dispense("users");

//         $user->name         =   $name;
//         $user->email        =   $email;
//         $user->role         =   $role;
//         $user->password     =   $hashed_password;
//         $user->signup_date  =   date("Y-m-d");

//         if(R::store($user))
//         {
//             echo json_encode(array(
//                 "message"   =>  "Account Created Successfully",
//                 "success"   =>  true
//             ));
//         }
//     }
// }



if(isset($_POST["flag"]))
{
    $email          =   $_POST["email"]         ??  null;
    $name           =   $_POST["name"]          ??  null;
    $role           =   $_POST["role"]          ??  0; // If role is not set then make user as an applicant by default.
    $emp_company    =   $_POST["emp-company"]   ??  null;
    $password       =   $_POST["password"]      ??  null;


    if($name && $email && $password)
    {
        $user       =   new User($name, $email, $role, $emp_company, $password);
        $response   =   $user->createAccount();
        
        echo json_encode($response);
    }
    else
    {
        echo json_encode(array(
            "message"   =>  "Please fill all fields",
            "success"   =>  false
        ));
    }
}
?>