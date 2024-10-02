<?php

use function PHPSTORM_META\map;

include("../config.php");

header("Content-Type: application/json");
if(isset($_POST["user_id"]))
{
    $user_id    =   $_POST["user_id"];
    $feedback   =   R::findOne("feedbacks", "user_id = ?", [$user_id]);

    if($feedback)
    {
        
// This will be executed when the user only wants to view the feedback. As no deleteFeedback is set when view button is clicked
        if(isset($_POST["viewFeedback"])) 
        {
            $feedback_content   =   $feedback->feedback;
            echo json_encode(array(
                "feedback"  =>  $feedback_content,
                "status"    =>  true
            ));
        }
        

        if(isset($_POST["deleteFeedback"])) // This part will be executed when the user wants to delete the feedback. 
        {
            if(R::trash($feedback))
            {
                echo json_encode(array(
                    "message"   =>  "User Deleted",
                    "status"    =>  true
                ));
            }
        }


        // This part will be executed when the user is either displaying or hiding feedback at landing page.
        if(isset($_POST["toggleFeedbackDisplay"]))
        {
            if($feedback->is_displayed == 0) // Checks if feedback is already hidden| 0 = hidden, 1 = displayed
            { 
                $feedback->is_displayed =   1; // If it is hidden and button is clicked then it will be changed to displayed
                R::store($feedback);

                echo json_encode(array(
                    "message"   =>  "Feedback Displayed",
                    "status"    =>  true
                ));
            }
            else if($feedback->is_displayed == 1) // Vice Versa
            {
                $feedback->is_displayed =   0;
                R::store($feedback);

                echo json_encode(array(
                    "message"    =>  "Feedback Hidden",
                    "status"    =>  true
                ));
            }
        }


    }
    else
    {
        echo json_encode(array(
            "message"  =>  "User does not exist",
            "status"   =>  false
        ));
    }
}
else
{
    echo json_encode(array(
        "message"  =>  "Something went wrong",
        "status"    =>  false
    ));
}
?>