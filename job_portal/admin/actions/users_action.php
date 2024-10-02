<?php
include("../config.php");

header("Content-Type: application/json");

if(isset($_POST["user_id"]))
{
    $user_id    =   $_POST["user_id"];
}

$user   =   R::findOne("users", "id = ?", [$user_id]);
if($user)
{
    if(R::trash($user))
    {
        echo json_encode(array(
            "message"   =>  "User Deleted!",
            "success"   =>  true
        ));
    }
    else
    {
        echo json_encode(array(
            "message"   =>  "Something went wrong!",
            "success"   =>  false
        ));
    }
}
?>