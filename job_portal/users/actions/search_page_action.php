<?php 
include("../config.php");
if(isset($_GET["keywords"]) || isset($_GET["city"]) || isset($_POST["category"]))
{
    $keyword        =   $_GET["keyword"]    ??  null;
    $city           =   $_GET["city"]       ??  null;
    $category       =   $_GET["category"]   ??  null;

    $current_date   =   date("Y-m-d");
    
    $is_expired     =   "'$current_date' <= expiry_date";
    $like           =   "(job_title LIKE '%$keyword%' OR job_description LIKE '%$keyword%')"; 

    $where          =   "WHERE $is_expired"; // Start with the common condition

    if (!empty($keyword)) 
    {
        $where .= " AND $like";
    }
    
    if (!empty($city)) 
    {
        $where .= " AND city_id = $city";
    }
    
    if (!empty($category)) 
    {
        $where .= " AND category_id = $category";
    }
    
    $where .= " LIMIT 12";
    


    $query  =   "SELECT * FROM jobs $where";
    $jobs   =   R::getAll($query);
    
    if($jobs)
    {
        foreach($jobs as $job)
        {
            /* Converting to object because the getAll() method return data in the form of an array. Meanwhile 
            other methods like find return object. */
            
            $job    =   (object) $job;
            echo searchResults($job); // Returning as html element.
        }
    }
    else 
    {
        echo "<p>No match found</p>";
    }

}

// SELECT * FROM jobs WHERE job_title LIKE '%android%' OR job_description LIKE '%android%';
// SELECT * FROM jobs WHERE job_title LIKE '%android%' OR job_description LIKE '%android%'
// SELECT * FROM jobs WHERE CONCAT(job_title, job_description) LIKE '%developer%' AND IFNULL(city_id = null, 1);
   

    // $jobs   =   R::getAll("SELECT * FROM jobs WHERE CONCAT(job_title, job_description) LIKE '%$keywords%' AND IFNULL(city_id = null, 1)");

    // echo json_encode($jobs);
?>











<!-- if(isset($keyword) && isset($city) && isset($category))
    {
        $where  =   "WHERE $like AND city_id = $city AND category_id = $category AND $is_expired LIMIT 12";
    }
    else if(isset($keyword) && isset($city))
    {
        $where  =   "WHERE $like AND city_id = $city AND $is_expired LIMIT 12";
    }
    else if(isset($keyword) && isset($category))
    {
        $where  =   "WHERE $like AND category_id = $category AND $is_expired LIMIT 12";
    }
    else if(isset($city) && isset($category))
    {
        $where  =   "WHERE city_id = $city AND category_id = $category AND $is_expired LIMIT 12";
    }
    else if(isset($keyword))
    {
        $where  =   "WHERE $like AND $is_expired LIMIT 12";
    }
    else if(isset($city))
    {
        $where  =   "WHERE city_id = $city AND $is_expired LIMIT 12";
    }
    else if(isset($category))
    {
        $where  =   "WHERE category_id = $category AND $is_expired LIMIT 12";
    }
    else if(empty($keyword) && empty($city) && empty($category))
    {   
        $where  =   "WHERE $is_expired LIMIT 12";
    } -->