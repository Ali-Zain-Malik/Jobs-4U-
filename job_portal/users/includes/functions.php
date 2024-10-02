<?php 
// function to check for duplicate email
function duplicateEmail($email)
{
    $duplicate  =   R::findOne("users", "WHERE email = ?", [$email]);

    return (isset($duplicate)) ? true : false;
}


function getUserId()
{
    $email  =   $_SESSION["email"] ?: null;
    if($email)
    {
        $user   =   R::findOne("users", "WHERE email = ?", [$email]);
        if($user)
        {
            return $user->id;
        }
    }
}


function getCategories()
{
    if(isset($_SESSION["limit"]))
    {
        $limit  =   $_SESSION["limit"];
    }

    $categories =   R::findAll("categories", "WHERE is_active = ? ORDER BY RAND() LIMIT ?", [1, $limit]);
    if($categories)
    {
        foreach ($categories as $category) 
        {
            $jobsCount  =   R::count("jobs", "WHERE category_id = ?", [$category->id]);
            ?>

                <div class="card shadow">
                    <h3 class="card-heading">
                        <?php echo $category->category_name; ?>
                    </h3>
                    <span class="jobs-number">
                        <?php echo $jobsCount; ?> Job(s) Available
                    </span>
                    <button class="explore-btn" category-id = "<?php echo $category->id ?>">
                        Explore
                    </button>
                </div>

            <?php
        }
    }
    else
    {
        echo "<p>No Categories Found</p>";
    }

}


function getAllCategories()
{
    $categories =   R::findAll("categories", "WHERE is_active = ?", [1]);
    if($categories)
    {
        foreach($categories as $category)
        {
            $jobsCount  =   R::count("jobs", "WHERE category_id = ?", [$category->id]);
            ?>

            <div class="card mb-3 border-0 shadow" style="width: 14rem; background-color: rgb(233, 234, 217);">
                <div class="card-body  text-center text-capitalize py-2">
                    <h5 class="card-title mb-0 fw-bold"><?php echo $category->category_name; ?></h5>
                    <p class="card-text mb-2"><?php echo $jobsCount; ?> job(s) Posted</p>
                    <button class="explore-btn my-0" category-id = "<?php echo $category->id ?>">
                        Explore
                    </button>
                </div>
            </div>

            <?php
        }
    }
    else
    {
        echo "<p class='mt-4'>No Categories Found</p>";
    }
}


function isFavorite($job_id)
{

    $is_favorite    =   R::findOne("favorites", "WHERE job_id = ? AND user_id = ?", [$job_id, getUserId()]);

    if($is_favorite)
    {
        return "heart-solid.svg";
    }
    else
    {
        return "heart-regular.svg";
    }
}


function getFeaturedJobs()
{

    if(isset($_SESSION["limit"]))
    {
        $limit  =   $_SESSION["limit"];
    }

    $current_date   =   date("Y-m-d");

    

    $featured_jobs  =   R::findAll("jobs", "WHERE is_featured = ? AND is_approved = ? AND '$current_date' <= expiry_date ORDER BY RAND() LIMIT ?", [1, 1, $limit]);
    if($featured_jobs)
    {
        foreach($featured_jobs as $featured_job)
        {
            $city           =   R::findOne("city", "WHERE id = ?", [$featured_job->city_id]);
            
            $expiry_date    =   $featured_job->expiry_date;

            $days_left      =   strtotime($expiry_date) - strtotime($current_date);

            ?>

                <div class="card2 col mb-4 cards">
                    <div class="main-div">
                        <div class="content">
                            <div class="image-div">
                                <img src="assets/img/Designer2.png" alt="">
                            </div>
                            <div class="info-div">
                                <div class="heading-content">
                                    <div class="company-name">
                                        <h4><?php echo $featured_job->company_name; ?></h4>
                                    </div>
                                    <div class="job-title">
                                        <h3><?php echo $featured_job->job_title; ?></h3>
                                    </div>
                                    <div class="location">
                                        <img src="assets/img/location.svg" alt="">
                                        <p><?php echo $city->city_name; ?></p>
                                        <div class="time">
                                            <img src="assets/img/clock-regular.svg" alt="">
                                            <span><?php echo $featured_job->start_date; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="favorite">
                            <img class="favorite-image" class="favorite-image" job-id = "<?php echo $featured_job->id; ?>" src="assets/img/<?php echo isFavorite($featured_job->id) ?>" alt="">
                        </div>
                    </div>
                    <div class="job-types">
                        <div class="employement-type">
                            <p><?php echo $featured_job->employement_type; ?></p>
                        </div>
                        <div class="location-type">
                            <p><?php echo $featured_job->location_type; ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="salary-info">
                        <span class="d-flex salary-span"><span class="currency me-1"><?php echo $featured_job->currency; ?></span><span class="fw-bold amount"><?php echo $featured_job->salary; ?></span><p>/</p><span class="period"><?php echo $featured_job->per_period; ?></span></span>
                        <span class="d-flex fw-500 remaining-period-span"><span class="remaining-days me-1"><?php echo $days_left/ (60 * 60 * 24) +1; ?></span><span> day(s) left to apply</span></span>
                    </div>
                </div>

            <?php
        }
    }
    else
    {
        echo "<p class='mt-4'>No Jobs Found</p>";
    }  
}



function getFavorites()
{

    $favorites  =   R::findAll("favorites", "WHERE user_id = ? ORDER BY id DESC", [getUserId()]);

    if($favorites)
    {
        foreach($favorites as $favorite)
        {
            $favorite_job   =   R::findOne("jobs", "WHERE id = ?", [$favorite->job_id]);
        
            $location       =   R::findOne("city", "WHERE id = ?", [$favorite_job->city_id]);
            $current_date   =   date("Y-m-d");
            $expiry_date    =   $favorite_job->expiry_date;
            $days_left      =   strtotime($expiry_date) - strtotime($current_date);
            $is_expired     =   ($current_date > $favorite_job->expiry_date) ? true : false;


            if($is_expired)
            {
                $btn_display    =   "d-none";
                $rem_days       =   "Expired";
            }
            else 
            {
                $btn_display    =   "";
                $rem_days       =   $days_left/ (60 * 60 * 24) +1 . " day(s) left to apply";
            }
            
            ?>

                <div class="card2 col">
                    <div class="main-div">
                        <div class="content">
                            <div class="image-div">
                                <img src="assets/img/R.jpg" alt="">
                            </div>
                            <div class="info-div">
                                <div class="heading-content">
                                    <div class="company-name">
                                        <h4><?php echo $favorite_job->company_name; ?></h4>
                                    </div>
                                    <div class="job-title">
                                        <h3><?php echo $favorite_job->job_title; ?></h3>
                                    </div>
                                    <div class="location">
                                        <img src="assets/img/location.svg" alt="">
                                        <p><?php echo $location->city_name; ?></p>
                                        <div class="time">
                                            <img src="assets/img/clock-regular.svg" alt="">
                                            <span><?php echo $favorite_job->start_date; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="view-apply-div">
                            <button class="view-btn <?php echo $btn_display; ?>" data-bs-toggle="modal" data-bs-target="#applyModal" job-id = "<?php echo $favorite_job->id; ?>">View</button>
                            <button class="apply-btn <?php echo $btn_display; ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop" job-id = "<?php echo $favorite_job->id; ?>">Apply</button>
                        </div>

                        <div class="favorite">
                            <img class="favorite-image"  job-id = "<?php echo $favorite_job->id; ?>" src="assets/img/<?php echo isFavorite($favorite_job->id); ?>" alt="">
                        </div>
                    </div>
                    <div class="job-types">
                        <div class="employement-type">
                            <p><?php echo $favorite_job->employement_type; ?></p>
                        </div>
                        <div class="location-type">
                            <p><?php echo $favorite_job->location_type; ?></p>
                        </div>
                        <!-- This div will be displayed when the screen size gets smaller -->
                        <div class="view-apply-div2">
                            <button class="view-btn" data-bs-toggle="modal" data-bs-target="#applyModal" job-id = "<?php echo $favorite_job->id; ?>">View</button>
                            <button class="apply-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop" job-id = "<?php echo $favorite_job->id; ?>">Apply</button>
                        </div>
                    </div>

                    <hr>

                    <div class="salary-info">
                        <span class="d-flex salary-span"><span class="currency me-1"><?php echo $favorite_job->currency; ?></span><span class="fw-bold amount"><?php echo $favorite_job->salary; ?></span><p>/</p><span class="period"><?php echo $favorite_job->per_period; ?></span></span>
                        <span class="d-flex fw-500 remaining-period-span"><span class="remaining-days fw-bold"><?php echo $rem_days; ?></span></span>
                    </div>
                </div>

            <?php
        }
    }
    else 
    {
        echo "<p class='mb-3 h5 fw-bold'>No Favorites Added Yet</p>";
    }
}




function searchResults($job)
{
    if($job)
    {
        $city           =   R::findOne("city", "WHERE id = ?", [$job->city_id]);
        $current_date   =   date("Y-m-d");
        $expiry_date    =   $job->expiry_date;
        $days_left      =   strtotime($expiry_date) - strtotime($current_date);
        $is_expired     =   ($current_date > $job->expiry_date) ? true : false;

        if($is_expired)
        {
            $btn_display    =   "d-none";
            $rem_days       =   "Expired";
        }
        else 
        {
            $btn_display    =   "";
            $rem_days       =   $days_left/ (60 * 60 * 24) + 1 . " day(s) left to apply";
        }

        ?>

            <div class="card2 col">
                <div class="main-div">
                    <div class="content">
                        <div class="image-div">
                            <img src="assets/img/R.jpg" alt="">
                        </div>
                        <div class="info-div">
                            <div class="heading-content">
                                <div class="company-name">
                                    <h4><?php echo $job->company_name; ?></h4>
                                </div>
                                <div class="job-title">
                                    <h3><?php echo $job->job_title; ?></h3>
                                </div>
                                <div class="location">
                                    <img src="assets/img/location.svg" alt="">
                                    <p><?php echo $city->city_name; ?></p>
                                    <div class="time">
                                        <img src="assets/img/clock-regular.svg" alt="">
                                        <span><?php echo $job->start_date; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="view-apply-div">
                        <button class="view-btn" data-bs-toggle="modal" data-bs-target="#applyModal" data-job-title="Laravel Expert">View</button>
                        <button class="apply-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-job-title="Laravel Expert">Apply</button>
                    </div>

                    <div class="favorite">
                        <img class="favorite-image" onclick="func()" job-id = "<?php echo $job->id; ?>" src="assets/img/<?php echo isFavorite($job->id); ?>" alt="">
                    </div>
                </div>
                <div class="job-types">
                    <div class="employement-type">
                        <p><?php echo $job->employement_type; ?></p>
                    </div>
                    <div class="location-type">
                        <p><?php echo $job->location_type; ?></p>
                    </div>
                    <div class="view-apply-div2">
                        <button class="view-btn" data-bs-toggle="modal" data-bs-target="#applyModal" data-job-title="Laravel Expert">View</button>
                        <button class="apply-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-job-title="Laravel Expert">Apply</button>
                    </div>
                </div>

                <hr>

                <div class="salary-info">
                    <span class="d-flex salary-span"><span class="currency me-1"><?php echo $job->currency; ?></span><span class="fw-bold amount"><?php echo $job->salary; ?></span>
                        <p>/</p><span class="period">Month</span>
                    </span>
                    <span class="d-flex fw-500 remaining-period-span"><span class="remaining-days me-1"><?php echo $rem_days; ?></span>
                </div>
            </div>

        <?php
    }
}



// Get all cities
function getCities()
{
    $cities =   R::findAll("city");
    if($cities)
    {
        foreach($cities as $city)
        {
            ?>

            <option value="<?php echo $city->id; ?>"><?php echo $city->city_name; ?></option>

            <?php 
        }
    }
}


function categoriesForFilter()
{
    $categories =   R::findAll("categories", "WHERE is_active = 1");
    if($categories)
    {
        foreach($categories as $category)
        {
        ?>

        <option value="<?php echo $category->id; ?>"><?php echo $category->category_name; ?></option>

        <?php
        }
    }
}



function getTopEmployers()
{
    // meaning the user is an employer plus top employer
    $top_employers  =   R::findAll("users", "WHERE is_top = 1 AND role = 1 AND emp_company != 'NULL' ORDER BY RAND() LIMIT 10");
    // echo json_encode($top_employers); exit;
    if($top_employers)
    {
        foreach($top_employers as $top)
        {
            $jobs_count =   R::count("jobs", "WHERE employer_id = ?", [$top->id]);
            $location   =   R::findOne("city", "WHERE id = ?", [$top->city_id]);
            $jobs_count =   $jobs_count ?? 0;
            ?>

                <div class="col mb-3">
                    <div class="card2">
                        <div class="main-div">
                            <div class="content">
                                <div class="image-div">
                                    <img src="assets/img/Designer2.png" alt="">
                                </div>
                                <div class="info-div">
                                    <div class="heading-content">
                                        <div class="company-name">
                                            <h4><?php echo $top->emp_company; ?></h4>
                                        </div>

                                        <div class="posts-number-div">
                                             <p><span class="posts-number"><?php echo $jobs_count; ?></span> Job(s) Posted</p>
                                        </div>
                                        
                                        <div class="location">
                                            <img src="assets/img/location.svg" alt="">
                                            <p><?php echo $location->city_name ?? "N/A"; ?></p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
        }
    }
    else
    {
        echo "<p>No top employer added yet</p>";
    }
}





function getUserInfo($user_id, $flag)
{
    $user   =   R::findOne("users", "WHERE id = ?", [$user_id]);
    if($user)
    {
        if($flag == "getName")
        {
            return $user->name;
        }
        else if($flag == "getDescription")
        {
            return $user->description;
        }
    }
    else
    {
        echo "<p>User not found</p>";
    }
}




function getSkills($user_id)
{
    $user_skills    =   R::findAll("user_skills", "WHERE user_id = ?", [$user_id]);
    $skills         =   R::findAll("skills", "WHERE status = 1");
    

    if($skills)
    {
        foreach($skills as $sk)
        {
            $is_selected    =   ""; 

            foreach($user_skills as $usk)
            {

                if($sk->id == $usk->skill_id)
                {
                    $is_selected    =   "selected";
                    break;
                }
            }

            ?>
                <option <?php echo $is_selected; ?> value="<?php echo $sk->id; ?>"><?php echo $sk->name; ?></option>
            <?php
        }
        
    }
}



function getExperience($user_id)
{
    $experiences     =   R::findAll("experience", "WHERE user_id = ?", [$user_id]);

    if($experiences)
    {
        foreach($experiences as $exp)
        {
            ?>

                <div class="card col-lg-5">
                    <div class="d-flex justify-content-between align-items-center card-header pb-0">
                        <h5 class="fw-bold"><?php echo $exp->designation; ?></h5>
                        <span class="pe-1 d-flex gap-3"><i class="bx bxs-pencil fs-5 pointer exp-pencils" title="Edit Experience" experience-id = "<?php // $experience->id; ?>" data-bs-toggle="modal" data-bs-target="#editViewModal"></i> <i class="bx bxs-trash fs-5 pointer edu-baskets" title="Delete Experience" experience-id = "<?php //echo $experience->id; ?>"></i></span>
                    </div>
                    <div class="card-body mt-2">
                        <h5 class="card-title"><?php echo $exp->company; ?></h5>
                        <p class="card-text fs-6 d-flex align-items-center gap-2">
                            <span><i class="bx bx-calendar"></i></span>
                            <span style="font-size: 14px;">20 August 2024</span> - 
                            <span style="font-size: 14px;">Present</span>
                        </p>

                        <p class="card-text">
                            <span class="me-3 bg-info rounded-pill px-3 py-1 text-white fw-bold text-capitalize"><?php echo $exp->employement_type; ?></span>
                            <span class="bg-info rounded-pill px-3 py-1 text-white fw-bold text-capitalize"><?php echo $exp->location_type; ?></span>
                        </p> 
                    </div>
                </div>

            <?php
        }
    }
    else
    {
        echo "<p>Not added yet</p>";
    }
}



function getEducation($user_id)
{
    $education     =   R::findAll("education", "WHERE user_id = ?", [$user_id]);

    if($education)
    {
        foreach($education as $edu)
        {
            ?>

                <div class="card col-lg-5">
                    <div class="d-flex justify-content-between align-items-center card-header pb-0">
                        <h5 class="fw-bold"><?php echo $edu->major; ?></h5>
                        <span class="pe-1 d-flex gap-3"><i class="bx bxs-pencil fs-5 pointer edu-pencils" title="Edit Experience" experience-id = "<?php // $experience->id; ?>" data-bs-toggle="modal" data-bs-target="#editViewModal"></i> <i class="bx bxs-trash fs-5 pointer edu-baskets" title="Delete Experience" experience-id = "<?php //echo $experience->id; ?>"></i></span>
                    </div>
                    <div class="card-body mt-2">
                        <h5 class="card-title my-0"><?php echo $edu->institute; ?></h5>
                        <h6 class="mt-0"><?php echo $edu->program; ?></h6>
                        <p class="card-text fs-6 d-flex align-items-center gap-2">
                            <span><i class="bx bx-calendar"></i></span>
                            <span style="font-size: 14px;">20 August 2024</span> - 
                            <span style="font-size: 14px;">Present</span>
                        </p>

                        <p class="card-text">
                            <span class="me-3 bg-info rounded-pill px-3 py-1 text-white fw-bold text-capitalize"><?php echo $edu->grade ?? "N/A"; ?></span>
                        </p> 
                    </div>
                </div>

            <?php
        }
    }
    else
    {
        echo "<p>Not added yet</p>";
    }
}
?>