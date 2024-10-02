<?php

include("../config.php");

// if(isset($_POST["limit"]))
// {
//     $_SESSION["limit"]  =   $_POST["limit"];
// }



if(isset($_POST["flag"]))
{
    $flag       =   $_POST["flag"];
    $job_id     =   $_POST["job_id"];
    $email      =   $_SESSION["email"];

    $user   =   R::findOne("users", "WHERE email = ?", [$email]);

    if($user)
    {
        $user_id    =   $user->id;
    }

    if($flag === "add-favorite")
    {
        $favoirte_job           =   R::dispense("favorites");
        $favoirte_job->user_id  =   $user_id;
        $favoirte_job->job_id   =   $job_id;

        if(R::store($favoirte_job))
        {
            echo json_encode(array(
                "message"   =>  "Added to the favorites",
                "success"   =>  true
            ));
        }
        else
        {
            echo json_encode(array(
                "message"   =>  "Couldn't add to the favorites",
                "success"   =>  false
            ));
        }
    }
    else if($flag === "remove-favorite")
    {
        $favoirte_job   =   R::findOne("favorites", "WHERE user_id = ? AND job_id = ?", [$user_id, $job_id]);

        if($favoirte_job)
        {
            if(R::trash($favoirte_job))
            {
                echo json_encode(array(
                    "message"   =>  "Removed from favorites",
                    "success"   =>  true
                ));
            }
            else
            {
                echo json_encode(array(
                    "message"   =>  "Couldn't remove from favorites",
                    "success"   =>  false
                ));
            }
        }
    }
}

?>