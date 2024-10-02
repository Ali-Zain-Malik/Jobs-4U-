<?php 
include("../config.php");

if(isset($_POST["jobId"]) && isset($_POST["flag"]))
{
    $job_id     =   $_POST["jobId"];
    $flag       =   $_POST["flag"];
    $job        =   R::findOne("jobs", "id = ?", [$job_id]);

    if($job)
    {
        if($flag == "approve")
        {
            $job->is_approved   =   ($job->is_approved == 1) ? 0 : 1;
            if(R::store($job))   
            {
                echo json_encode(array(
                    "approve"    =>  true,
                    "message"   =>  ($job->is_approved == 1) ? "Live" : "Pending",
                    "success"   =>  true
                ));
            }
        }
        else if($flag == "feature")
        {
            $job->is_featured   =   ($job->is_featured == 1) ? 0 : 1;
            R::store($job);
        }
        else if($flag == "view")
        {
            echo  json_encode(array(
                "view"              =>  true,
                "job_title"         =>  $job->job_title,
                "start_date"        =>  (new DateTime($job->start_date))->format("d F Y"),
                "expiry_date"       =>  (new DateTime($job->expiry_date))->format("d F Y"),
                "salary_amount"     =>  $job->salary,
                "salary_currency"   =>  $job->currency,
                "per_period"        =>  $job->per_period,
                "company_name"      =>  $job->company_name,
                "employement_type"  =>  $job->employement_type,
                "location_type"     =>  $job->location_type,
                "description"       =>  $job->job_description,
                "success"           =>  true
            ));
        }            
        else if($flag == "delete")
        {
            if(R::trash($job))
            {
                echo json_encode(array(
                    "delete"    =>  true,
                    "success"   =>  true
                ));
            }
        }
    }
    
}

?>