<?php

include("../config.php");

// header("Content-Type: application/json");

if(isset($_POST["user_id"]))
{
    
    $user_id            =   $_POST["user_id"];
    $name               =   (isset($_POST["fullName"]))                                     ?   $_POST["fullName"]              :   NULL;
    $email              =   (isset($_POST["email"]))                                        ?   $_POST["email"]                 :   NULL;
    $delete_image       =   (isset($_POST["delete_image"]))                                 ?   $_POST["delete_image"]          :   NULL;
    $city_id            =   (isset($_POST["select-city"]))                                  ?   $_POST["select-city"]           :   NULL; 
    $role               =   (isset($_POST["role"]))                                         ?   $_POST["role"]                  :   NULL;
    $date_of_birth      =   (isset($_POST["date-of-birth"]))                                ?   $_POST["date-of-birth"]         :   NULL;
    $about              =   (!isset($_POST["about"])    ||  $_POST["about"]=="N/A")         ?   NULL                            :   $_POST["about"];
    $company            =   (!isset($_POST["company"])  ||  $_POST["company"] == "N/A")     ?   NULL                            :   $_POST["company"];
    $job_designation    =   (!isset($_POST["job"])      ||  $_POST["job"] == "N/A")         ?   NULL                            :   $_POST["job"];


    $top_employer       =   (isset($_POST["top-emp"])) ? $_POST["top-emp"] : null;


    $user               =   R::findOne("users", "id = ?", [$user_id]);
    $experience         =   R::findOne("experience", "user_id = ?", [$user_id]);
    
    if ($user) 
    {
        //Change Password mechanism starts from here. 
        if(isset($_POST["currentPassword"]) && isset($_POST["newPassword"]))
        {
            $currentPassword    =   $_POST["currentPassword"];
            $newPassword        =   $_POST["newPassword"];

            if(password_verify($currentPassword, $user->password))
            {
                if(password_verify($newPassword, $user->password))
                {
                    echo json_encode(array(
                        "message"   =>  "New and old passwords cannot be same",
                        "success"   =>  false
                    ));
                    exit;
                }
                else 
                {
                    $hashPassword   =   password_hash($newPassword, PASSWORD_DEFAULT);
                    $user->password =   $hashPassword;
                    echo json_encode(array(
                        "message"   =>  "Password changed successfully",
                        "success"   =>  true
                    ));
                    
                    R::store($user);
                    exit;
                }
            }
            else
            {
                echo json_encode(array(
                    "message"   =>  "Current password do not match",
                    "success"   =>  false
                ));

                exit;
            }
        }
        // Password change mechanism ends here
        


        $changesMade = false; // This will act as a flag. to check whether any change was made or not.


        // If the image is updated then storing the new one. 
        if(isset($_FILES["profile_pic"]))
        {
            $profile_pic    =   $_FILES["profile_pic"]["name"];
            $temp_name      =   $_FILES["profile_pic"]["tmp_name"];
            $directory      =   "../assets/uploads/";
            $target         =   $directory . basename($profile_pic); // storing image in the following path. 
    
            if(move_uploaded_file($temp_name, $target))
            {
                $user->profile_pic  =   $profile_pic; // But in database we are just storing image name.
                $changesMade    =   true;
            }
        }


        if($delete_image)
        {
            if($user->profile_pic)
            {
                unlink("../assets/uploads/". $user->profile_pic);
                $user->profile_pic  =   NULL;
                $changesMade        =   true;
            }
        }

        // Email update
        if (isset($email) && $user->email != $email) 
        {
            $duplicate_email_check = R::findOne("users", "email = ? AND id != ?", [$email, $user_id]);
            if ($duplicate_email_check) 
            {
                $response = array(
                    "message" => "This email already exists.",
                    "success" => false
                );

                echo json_encode($response);
                exit;
            } 
            else 
            {
                $user->email = $email;
                $changesMade = true;
            }
        }

        // Name update
        if (isset($name) && $user->name != trim($name)) 
        {
            $user->name = trim($name);
            $changesMade = true;
        }

        // About update
        if (isset($about)) 
        {
            if($user->about != trim($about))
            {
                $user->about = trim($about);
                $changesMade = true;
            }
        }
        else
        {
            $user->about    =   NULL;
            $changesMade    =   true;
        }


        // Company update
        if (isset($company)) 
        { 
            if($experience)
            {
                if($experience->company != trim($company))
                {
                    $experience->company    = trim($company);
                    $changesMade            = true;
                }
            }
            else
            {
                $experience             =   R::dispense("experience");
                $experience->user_id    =   $user_id;
                $experience->company    =   trim($company);
                $changesMade            =   true;
            }
        }


        // Job designation update
        if (isset($job_designation)) 
        {
            if($experience)
            {
                if($experience->designation != trim($job_designation))
                {
                    $experience->designation    = trim($job_designation);
                    $changesMade                = true;
                }
            }
            else
            {
                $experience                 =   R::dispense("experience");
                $experience->user_id        =   $user_id;
                $experience->designation    =   trim($job_designation);
                $changesMade                =   true;
            }
        }


        if(isset($date_of_birth))
        {
            if($date_of_birth !== $user->date_of_birth)
            {
                $user->date_of_birth    =   $date_of_birth;
                $changesMade            =   true;
            }
        }


        if(isset($city_id))
        {
            if($city_id !== $user->city_id)
            {
                $user->city_id  =   $city_id;
                $changesMade    =   true;
            }
        }


        if(isset($role))
        {
            if($role !== $user->role)
            {
                $user->role     =   $role;
                $changesMade    =   true;
            }
        }

        if(isset($top_employer))
        {
            if($top_employer !== $user->is_top)
            $user->is_top   =   $top_employer;
            $changesMade    =   true;
        }
        
        // Store changes if any were made. No link with password change.
        if ($changesMade) 
        {
            R::store($user);

            if($experience)
            {
                R::store($experience);
            }
            $response = array(
                "message" => "Changes Made Successfully",
                "success" => true
            );
        }
        else
        {
            $response = array(
                "message" => "No Changes Made",
                "success" => true
            );
        }
    }
    else
    {
        $response   =   array(
            "message"   =>  "Something went wrong. Try again",
            "success"   =>  false
        );
    }


    echo json_encode($response);
}
else if(isset($_POST["country_id"]))
{
    $country_id     =   $_POST["country_id"];

    $cities         =   R::findAll("city", "WHERE country_id = ?", [$country_id]);
    $cityCount      =   R::count("city", "WHERE country_id = ?", [$country_id]);

    $city_info = [];
    foreach($cities as $city)
    {
        $city_info[]    =   array(
            "city_id"   =>  $city->id,
            "city_name" =>  $city->city_name
        );
    }

    echo json_encode(array(
        "cityInfo"  =>  $city_info,
        "cityCount" =>  $cityCount,
        "success"   =>  true
    ));
}
else if(isset($_POST["flag"]) && $_POST["flag"] === "add")
{
    $company                =   (isset($_POST["company"]))              ?   ($_POST["company"])       :   null;
    $designation            =   (isset($_POST["designation"]))          ?   ($_POST["designation"])   :   null;
    $start_month            =   (isset($_POST["start-month"]))          ?   $_POST["start-month"]               :   null;
    $start_year             =   (isset($_POST["start-year"]))           ?   $_POST["start-year"]                :   null;
    $end_month              =   (isset($_POST["end-month"]))            ?   $_POST["end-month"]                 :   null;
    $end_year               =   (isset($_POST["end-year"]))             ?   $_POST["end-year"]                  :   null;
    $user_id                =   (isset($_POST["user-id"]))              ?   $_POST["user-id"]                   :   null;
    $employement_type       =   (isset($_POST["employement-type"]))     ?   $_POST["employement-type"]          :   null;
    $location_type          =   (isset($_POST["location-type"]))        ?   $_POST["location-type"]             :   null;
    $is_currently_working   =   (isset($_POST["currently-working"]))    ?   1   :   0;


    $start_date =   new DateTime("$start_year-$start_month-01");
    $start_date =   $start_date->format("Y-m-d");

    if(isset($end_month) && isset($end_year))
    {
        $end_date   =   new DateTime("$end_year-$end_month-01");
        $end_date   =   $end_date->format("Y-m-d");
    }

    if(isset($user_id))
    {
        $experience                         =   R::dispense("experience");
        $experience->user_id                =   $user_id;
        $experience->designation            =   $designation;
        $experience->company                =   $company;
        $experience->start_date             =   $start_date;
        $experience->employement_type       =   $employement_type;
        $experience->location_type          =   $location_type;
        $experience->end_date               =   (isset($end_date)) ? $end_date : null;
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
                "message"   =>  "Couldn't add experience",
                "success"   =>  false
            ));
        }
    }
    else
    {
        echo json_encode(array(
            "message"   => "Something went wrong. Try again.",
            "success"   =>  false
        )); 
    }

}
else if(isset($_POST["experience_id"]) && isset($_POST["flag"]) && ($_POST["flag"] === "edit-experience" || $_POST["flag"] === "view-experience"))
{
    $flag           =   $_POST["flag"];
    $experience_id  =   $_POST["experience_id"];
    $experience     =   R::findOne("experience", "WHERE id = ?", [$experience_id]);

    if($flag === "view-experience")
    {
        if($experience)
        {
            echo json_encode(array(
                "experience"    =>  $experience,
                "success"       =>  true
            ));
        }
    }
    else if($flag === "edit-experience")
    {
        if($experience)
        {
            $company                =   (isset($_POST["edit-company"]))              ?   $_POST["edit-company"]       :   null;
            $designation            =   (isset($_POST["edit-designation"]))          ?   $_POST["edit-designation"]   :   null;
            $start_month            =   (isset($_POST["edit-start-month"]))          ?   $_POST["edit-start-month"]               :   null;
            $start_year             =   (isset($_POST["edit-start-year"]))           ?   $_POST["edit-start-year"]                :   null;
            $end_month              =   (isset($_POST["edit-end-month"]))            ?   $_POST["edit-end-month"]                 :   null;
            $end_year               =   (isset($_POST["edit-end-year"]))             ?   $_POST["edit-end-year"]                  :   null;
            $employement_type       =   (isset($_POST["edit-employement-type"]))     ?   $_POST["edit-employement-type"]          :   null;
            $location_type          =   (isset($_POST["edit-location-type"]))        ?   $_POST["edit-location-type"]             :   null;
            $is_currently_working   =   (isset($_POST["edit-currently-working"]))    ?   1   :   0;


            $start_date =   new DateTime("$start_year-$start_month-01");
            $start_date =   $start_date->format("Y-m-d");

            if(isset($end_month) && isset($end_year))
            {
                $end_date   =   new DateTime("$end_year-$end_month-01");
                $end_date   =   $end_date->format("Y-m-d");
            }
    
            $experience->designation            =   $designation;
            $experience->company                =   $company;
            $experience->start_date             =   $start_date;
            $experience->employement_type       =   $employement_type;
            $experience->location_type          =   $location_type;
            $experience->end_date               =   (isset($end_date)) ? $end_date : null;
            $experience->is_currently_working   =   $is_currently_working;  
    
            if(R::store($experience))
            {
                echo json_encode(array(
                    "message"   =>  "Changes made successfull",
                    "success"   =>  true
                ));
            }
            else 
            {
                echo json_encode(array(
                    "message"   =>  "Couldn't make changes",
                    "success"   =>  false
                ));
            }
    
        }
    }

    
}
else if(isset($_POST["experience_id"]) && isset($_POST["flag"]) && $_POST["flag"] === "delete-experience")
{
    $experience_id  =   $_POST["experience_id"];
    $experience     =   R::findOne("experience", "WHERE id = ?", [$experience_id]);

    if($experience)
    {
        if(R::trash($experience))
        {
            echo json_encode(array(
                "success"   =>  true
            ));
        }
        else 
        {
            echo json_encode(array(
                "message"   =>  "Couldn't delete this experience",
                "success"   =>  false
            ));
        }
    }
    else 
        {
            echo json_encode(array(
                "message"   =>  "Something went wrong. Try again",
                "success"   =>  false
            ));
        }
}
else if(isset($_POST["flag"]) && $_POST["flag"] === "add-education")
{
    $user_id                =   (isset($_POST["user-id"]))              ?   $_POST["user-id"]           :   null;
    $program                =   (isset($_POST["program"]))              ?   $_POST["program"]           :   null;
    $major                  =   (isset($_POST["major"]))                ?   $_POST["major"]             :   null;
    $institute              =   (isset($_POST["institute"]))            ?   $_POST["institute"]         :   null;
    $start_month            =   (isset($_POST["edu-start-month"]))      ?   $_POST["edu-start-month"]    :   null;
    $start_year             =   (isset($_POST["edu-start-year"]))       ?   $_POST["edu-start-year"]    :   null;
    $end_month              =   (isset($_POST["edu-end-month"]))        ?   $_POST["edu-end-month"]     :   null;
    $end_year               =   (isset($_POST["edu-end-year"]))         ?   $_POST["edu-end-year"]      :   null;
    $grade                  =   (isset($_POST["grade"]))                ?   $_POST["grade"]             :   null;   
    $is_currently_studying  =   (isset($_POST["currently-studying"]))   ?   1                           :   0;


    $start_date =   new DateTime("$start_year-$start_month-01");
    $start_date =   $start_date->format("Y-m-d");

    if(isset($end_month) && isset($end_year))
    {
        $end_date   =   new DateTime("$end_year-$end_month-01");
        $end_date   =   $end_date->format("Y-m-d");
    }


    if(isset($user_id))
    {
        $education                          =   R::dispense("education");
        $education->user_id                 =   $user_id;
        $education->program                 =   $program;
        $education->major                   =   $major;
        $education->institute               =   $institute;
        $education->grade                   =   $grade;
        $education->start_date              =   $start_date;
        $education->end_date                =   (isset($end_date)) ? $end_date : null;
        $education->is_currently_studying   =   $is_currently_studying;  

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
                "message"   =>  "Couldn't add education",
                "success"   =>  false
            ));
        }
    }
    else
    {
        echo json_encode(array(
            "message"   => "Something went wrong. Try again.",
            "success"   =>  false
        )); 
    }


}
else if(isset($_POST["education_id"]) && isset($_POST["flag"]))
{
    $education_id   =   $_POST["education_id"];
    $flag           =   $_POST["flag"];
    $education      =   R::findOne("education", "WHERE id = ?", [$education_id]);

    if($flag === "view-education")
    {
        if($education)
        {
            echo json_encode(array(
                "education" =>  $education,
                "success"   =>  true
            ));
        }
        else 
        {
            echo json_encode(array(
                "message"   =>  "Something went wrong",
                "success"   =>  false
            ));
        }
    }
    else if($flag === "edit-education")
    {
        
        $program                =   (isset($_POST["edit-program"]))              ?   $_POST["edit-program"]           :   null;
        $major                  =   (isset($_POST["edit-major"]))                ?   $_POST["edit-major"]             :   null;
        $institute              =   (isset($_POST["edit-institute"]))            ?   $_POST["edit-institute"]         :   null;
        $start_month            =   (isset($_POST["edit-edu-start-month"])) ?   $_POST["edit-edu-start-month"]    :   null;
        $start_year             =   (isset($_POST["edit-edu-start-year"]))       ?   $_POST["edit-edu-start-year"]    :   null;
        $end_month              =   (isset($_POST["edit-edu-end-month"]))        ?   $_POST["edit-edu-end-month"]     :   null;
        $end_year               =   (isset($_POST["edit-edu-end-year"]))         ?   $_POST["edit-edu-end-year"]      :   null;
        $grade                  =   (isset($_POST["edit-grade"]))                ?   $_POST["edit-grade"]             :   null;   
        $is_currently_studying  =   (isset($_POST["edit-currently-studying"]))   ?   1                           :   0;


        $start_date =   new DateTime("$start_year-$start_month-01");
        $start_date =   $start_date->format("Y-m-d");

        if(isset($end_month) && isset($end_year))
        {
            $end_date   =   new DateTime("$end_year-$end_month-01");
            $end_date   =   $end_date->format("Y-m-d");
        }


        if($education)
        {
            $education->program                 =   $program;
            $education->major                   =   $major;
            $education->institute               =   $institute;
            $education->grade                   =   $grade;
            $education->start_date              =   $start_date;
            $education->end_date                =   (isset($end_date)) ? $end_date : null;
            $education->is_currently_studying   =   $is_currently_studying;  

            if(R::store($education))
            {
                echo json_encode(array(
                    "message"   =>  "Education updated successfully",
                    "success"   =>  true
                ));
            }
            else 
            {
                echo json_encode(array(
                    "message"   =>  "Couldn't update education",
                    "success"   =>  false
                ));
            }
        }
        else 
        {
            echo json_encode(array(
                "message"   =>  "Something went wrong",
                "success"   =>  false
            ));
        }
    }
    else if($flag === "delete-education")
    {
        if($education)
        {
            if(R::trash($education))
            {
                echo json_encode(array(
                    "success"   =>  true
                ));
            }
            else
            {
                echo json_encode(array(
                    "message"   =>  "Couldn't delete this education part",
                    "success"   =>  false
                ));
            }
        }
        else 
        {
            echo json_encode(array(
                "message"   =>  "Something went wrong",
                "success"   =>  false
            ));
        }
    }
}
else
{
    echo json_encode(array(
        "message"   => "Something went wrong. Try again.",
        "success"   =>  false
    )); 
}



?>