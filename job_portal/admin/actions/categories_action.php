<?php
include("../config.php");


if (isset($_POST["flag"]) && isset($_POST["category_id"])) 
{
    $flag           =   $_POST["flag"];
    $category_id    =   $_POST["category_id"];
    $category       =   R::findOne("categories", "WHERE id = ?", [$category_id]);

    

    if ($category) 
    {
        if ($flag == "view") 
        {
            echo json_encode(array(
                "category_name"     =>  $category->category_name,
                "status"            =>  $category->is_active,
                "view"              =>  true,
                "success"           =>  true
            ));
        } 
        else if ($flag == "delete") 
        {
            if(R::trash($category))
            {

                $jobs =   R::findAll("jobs", "WHERE category_id = ?", [$category_id]);
            
                if($jobs)
                {
                    foreach($jobs as $job)
                    {
                        // echo $job->category_id; exit;
                        $job->category_id = NULL;
                        R::store($job);
                    }
                }

                echo json_encode(array(
                    "message"   =>  $category->category_name . " deleted successfully",
                    "delete"    =>  true,
                    "success"   =>  true
                ));
            }
            else
            {
                echo json_encode(array(
                    "message"   =>  "Failed to delete " . $category->category_name,
                    "delete"    =>  true,
                    "success"   =>  false
                ));
            }
        }
        else if($flag == "edit")
        {
            $category_name      =   (isset($_POST["category-input"]))   ? strtolower(trim($_POST["category-input"]))  : null;
            $category_status    =   (isset($_POST["radio"]))            ? $_POST["radio"]                             : null;

            $duplicate_check    =   R::findOne("categories", "WHERE category_name = ?", [$category_name]);
            $duplicate_check_id =   (isset($duplicate_check->id)) ? $duplicate_check->id : NULL;
 

            if($duplicate_check && $category_id !== $duplicate_check_id)
            {
                echo json_encode(array(
                    "message"   =>  "This category already exist",
                    "edit"      =>  true,
                    "success"   =>  false
                ));
            }
            else
            {
                $category->is_active        =   $category_status;
                $category->category_name    =   $category_name;

                if(R::store($category))
                {
                    echo json_encode(array(
                        "message"   =>  "Changes Made Successfully",
                        "edit"      =>  true,
                        "success"   =>  true
                    ));
                }
                else
                {
                    echo json_encode(array(
                        "message"   =>  "Couldn't Make Changes",
                        "edit"      =>  true,
                        "success"   =>  false
                    ));
                }
            }
        }
    }
}
else if(isset($_POST["flag"]) && $_POST["flag"] == "add")
{
    $new_category   =   (isset($_POST["new-category"])) ?   strtolower(trim($_POST["new-category"]))    : NULL;
    $status         =   (isset($_POST["radio2"]))       ?   $_POST["radio2"]                            :   0;

    if($new_category)
    {
        $duplicate_check    =   R::findOne("categories", "WHERE category_name = ?", [$new_category]);
        if($duplicate_check)
        {
            echo json_encode(array(
                "message"   =>  "This category already exist",
                "add"       =>  true,
                "success"   =>  false
            ));
            exit;
        }
        else
        {
            $category                   =   R::dispense("categories");
            $category->is_active        =   $status;
            $category->category_name    =   $new_category;

            if(R::store($category))
            {
                echo json_encode(array(
                    "message"   =>  strtoupper($new_category) . " category added successfully",
                    "add"       =>  true,
                    "success"   =>  true
                ));
            }
            else
            {
                echo json_encode(array(
                    "message"   =>  "Couln't add new category",
                    "add"       =>  true,
                    "success"   =>  false
                ));
            }
        }
    }
}
?>  