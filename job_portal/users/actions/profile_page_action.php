<?php 

include("../config.php");
// include("../classes/user_class.php");

if(isset($_POST["flag"]))
{
    $flag       =   $_POST["flag"];
    $user_id    =   getUserId();

    $user       =   R::findOne("users", "WHERE id = ?", [$user_id]);

    if($user)
    {
        if($flag === "edit-name")
        {
            $name   =   $_POST["data"]  ??  NULL;
    
            if($name)
            {
                $user->name =   $name;
                if(R::store($user))
                {
                    echo json_encode(array(
                        "message"   =>  "Name updated successfully",
                        "success"   =>  true
                    ));
                }
                else
                {
                    echo json_encode(array(
                        "message"   =>  "Couldn't update name",
                        "success"   =>  false
                    ));
                }
            }
        }
        else if($flag === "edit-description")
        {
            $description        =   $_POST["data"]  ??  NULL;
         
            $user->description  =   $description;
            
            if(R::store($user))
            {
                echo json_encode(array(
                    "message"   =>  "Description updated successfully",
                    "success"   =>  true
                ));
            }
            else
            {
                echo json_encode(array(
                    "message"   =>  "Couldn't update description",
                    "success"   =>  false
                ));
            }
            
        }
        else if($flag === "edit-skills")
        {
            $skill_ids      =   [];
            $skill_ids      =   $_POST["data"]  ??  NULL;

            $insert_query   =   "INSERT INTO user_skills (user_id, skill_id) VALUES (:user_id, :skill_id)";
            $delete_query   =   "DELETE FROM user_skills WHERE user_id = :user_id";

            if($skill_ids)
            {
                $is_updated =   false;

                /*  Deleting all skills from database before inserting new ones. Using this we don't 
                    need to check for duplicate skills addition, and also if the user eleminates any 
                    skill we don't need to worry about it too. Because all skills will be deleted first
                    and added again. So no worries if he deletes a skill or not. 
                */  
                $is_updated =   R::exec($delete_query, [":user_id"=>getUserId()]);

                if($is_updated)
                {
                    foreach($skill_ids as $skl_id)
                    {
                        $is_updated =   R::exec($insert_query, [":user_id" => getUserId(), ":skill_id" => $skl_id]);
                    }
                }

                if($is_updated)
                {
                    echo json_encode(array(
                        "message"   =>  "Skills updated successfully",
                        "success"   =>  true
                    ));
                }
                else
                {
                    echo json_encode(array(
                        "message"   =>  "Couldn't update skills",
                        "success"   =>  false
                    ));
                }
            }
        }
        else if($flag === "add-exp")
        {
            $data_array =   $_POST["data"] ?? NULL;
            if($data_array)
            {
                $designation            =   $data_array["designation"];
                $company                =   $data_array["company"];
                $start_month            =   $data_array["start-month"];
                $start_year             =   $data_array["start-year"];
                $end_month              =   $data_array["end-month"]    ??  NULL;
                $end_year               =   $data_array["end-year"]     ??  NULL;
                $location_type          =   $data_array["location-type"];
                $employement_type       =   $data_array["employement-type"];
                $is_currently_working   =   $data_array["currently-working"];

                $start_date =   new DateTime("$start_year-$start_month-01");
                $start_date =   $start_date->format("Y-m-d");

                if($is_currently_working == 1)
                {
                    $end_date   = NULL;
                }
                else
                {
                    $end_date   =   new DateTime("$end_year-$end_month-01");
                    $end_date   =   $end_date->format("Y-m-d");
                }


                if(getUserId() != null)
                {
                    $experience                         =   R::dispense("experience");
                    $experience->user_id                =   getUserId();
                    $experience->designation            =   $designation;
                    $experience->company                =   $company;
                    $experience->start_date             =   $start_date;
                    $experience->end_date               =   $end_date;
                    $experience->employement_type       =   $employement_type;
                    $experience->location_type          =   $location_type;
                    $experience->is_currently_working   =   $is_currently_working;

                    if(R::store($experience))
                    {
                        echo json_encode(array(
                            "message"   =>  "Experience added successfully",
                            "success"   =>  true
                        ));
                    }
                    else
                    {
                        echo json_encode(array(
                            "message"   =>  "Failed to add experience",
                            "success"   =>  false
                        ));
                    }
                }
            }
        }
        else if($flag === "add-edu")
        {
            $data_array =   $_POST["data"]  ??  null;
            if($data_array)
            {
                $program                =   $data_array["program"];
                $major                  =   $data_array["major"];
                $institute              =   $data_array["institute"];
                $start_month            =   $data_array["start-month"];
                $start_year             =   $data_array["start-year"];
                $end_month              =   $data_array["end-month"]    ??  null;
                $end_year               =   $data_array["end-year"]     ??  null;
                $is_currently_studying  =   $data_array["currently-studying"];

                $start_date             =   new DateTime("$start_year-$start_month-01");
                $start_date             =   $start_date->format("Y-m-d");

                if($is_currently_studying == 1)
                {
                    $end_date   = NULL;
                }
                else
                {
                    $end_date   =   new DateTime("$end_year-$end_month-01");
                    $end_date   =   $end_date->format("Y-m-d");
                }


                if(getUserId() !== null)
                {
                    $education                         =   R::dispense("education");
                    $education->user_id                =   getUserId();
                    $education->major                  =   $major;
                    $education->program                =   $program;
                    $education->start_date             =   $start_date;
                    $education->end_date               =   $end_date;
                    $education->institute              =   $institute;
                    $education->is_currently_studying  =   $is_currently_studying;

                    if(R::store($education))
                    {
                        echo json_encode(array(
                            "message"   =>  "Education added successfully",
                            "success"   =>  true
                        ));
                    }
                    else
                    {
                        echo json_encode(array(
                            "message"   =>  "Failed to add education",
                            "success"   =>  false
                        ));
                    }
                }

            }
        }
    }

}




?>