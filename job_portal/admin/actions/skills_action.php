<?php 
include("../config.php");

if(isset($_POST["skill_id"]) && isset($_POST["flag"]))
{
    $skill_id   =   $_POST["skill_id"];
    $flag       =   $_POST["flag"];

    $skill      =   R::findOne("skills", "id = ?", [$skill_id]);


    if($skill)
    {
        if($flag == "view")
        {
            echo json_encode(array(
                "skill"         =>  $skill->name,
                "status"        =>  $skill->status,
                "edit"          =>  true,
                "success"       =>  true
            ));
        }
        else if($flag == "save")
        {
            if(isset($_POST["status"]) && isset($_POST["skill_input"]))
            {
                $status         =   $_POST["status"];
                $skill_name     =   strtolower(trim($_POST["skill_input"]));

                $duplicate_check = R::findOne("skills", "WHERE name = ?", [$skill_name]);

                if($duplicate_check && $skill_id !== $duplicate_check->id)
                {
                    echo json_encode(array(
                        "message"   =>  "This skill already exist",
                        "save"      =>  true,
                        "success"   =>  false
                    ));
                }
                else
                {
                    $skill->status  =   $status;
                    $skill->name    =   $skill_name;
                    if(R::store($skill))
                    {
                        echo json_encode(array(
                            "message"   =>  "Changes made successfully",
                            "save"      =>  true,
                            "success"   =>  true
                        ));
                    }
                }
               
            }
        }
        else if($flag == "delete")
        {
            if(R::trash($skill))
            {
                echo json_encode(array(
                    "message"   =>  "Skill Deleted",
                    "delete"    =>  true,
                    "success"   =>  true
                ));
            }
        }
    }

}
else if(isset($_POST["flag"]) && $_POST["flag"] == "add_skill")
{
    $skill_name =   $_POST["skill_name"];

    $status     =  (isset($_POST["status"])) ? $_POST["status"] : 0;

    $allSkills = R::getCol('SELECT name FROM skills');

// print_r($allSkills); exit;
    if(in_array($skill_name, $allSkills))
    {
        echo json_encode(array(
            "message"   =>  "This skill already exist",
            "save"       =>  true,
            "success"   =>  false
        ));
    }
    else
    {
        $skill          =   R::dispense("skills");
        $skill->name    =   $skill_name;
        if(isset($status))
        {
            $skill->status  =   $status;
        }
        else 
        {
            $skill->status  =   0;
        }

        if(R::store($skill))
        {
            echo json_encode(array(
                "message"   =>  "Skill added successfully",
                "save"      =>  true,
                "success"   =>  true
            ));
        }
    }
}

?>