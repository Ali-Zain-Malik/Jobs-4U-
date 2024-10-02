<?php 
// This will count the total number of signed up users excluding admin accounts. 
function countUsers()
{
    return R::count("users", "WHERE role != 2");
}


function countApplicantUsers() // Count the number of applicants
{
    return R::count("users", "WHERE role != 2 AND role != 1");
}


function countEmplyerUsers() // Count the number of employers
{
    return R::count("users", "WHERE role != 2 AND role != 0");
}


function countJobs()
{
    return R::count("jobs");
}

function countLiveJobs()
{
    return R::count("jobs", "WHERE is_approved = ? AND expiry_date >= ?", [1, date("Y-m-d")]);
}

function countPendingJobs()
{
    return R::count("jobs", "WHERE is_approved = ? AND expiry_date >= ?", [0, date("Y-m-d")]);
}


function countFeedbacks()
{
    return R::count("feedbacks");
}


function getAllCountries()
{
    $countries      =   R::findAll("country");

    if($countries)
    {
        foreach($countries as $country)
        {
            ?>
                <option value="<?php echo $country->id; ?>"><?php echo $country->country_name; ?></option>
            <?php
        }
    }
}


function getAllCities($country_id)
{
    $cities      =   R::findAll("city", "WHERE country_id = ?", [$country_id]);

    foreach($cities as $city)
    {
        ?>
            <option value="<?php echo $city->id; ?>"><?php echo $city->city_name; ?></option>
        <?php
    }
}


// Used to get info of a particular user
function getUserInfo($user_id)
{
    $userInfo       = R::findOne("users", "id = ?", [$user_id]) ?: NULL; 

    if($userInfo)   
    {
        $userExperience =   R::findOne("experience", "user_id = ?", [$user_id]) ?: NULL;
        $city           =   R::findOne("city", "id = ?", [$userInfo->city_id]) ?: NULL;

        /* Applying this check here because if the user has not initially set his city and country
        then in the city table the country_id(used as foreign key) will be empty or null and 
        this will create an error. */
        if(isset($city))
        {
            $country    =   R::findOne("country", "id = ?", [$city->country_id]);
        }

        /* Unsetting password meaning excluding password from my user info. This is because so that even
        mistakenly I cannot access user password in view_profile file even though it will be encrypted. */
        unset($userInfo["password"]); 

        // Atlast returing the json encoded array, which contains the objects, userinfo and userexperience.
        return (object) array(
            "userInfo"      =>  $userInfo,
            "experience"    =>  $userExperience,
            "city"          =>  $city,
            "country"       =>  (isset($country)) ? $country : NULL,
            "success"       =>  true 
            /* Similarly checking here if we have 
            city and country data then it should be sent as the same data but if not then null will 
            be sent, and we will be able to detect in the view_profile file. And we will display N/A inplace of it.*/
        );
    }
    else
    {
        return (object) array(
            "message"   =>  "No such user exists",
            "success"   =>  false
        );
    }
}




// Used to get all users to display in users.php
function getAllUsers()
{
    $users  =   R::findAll("users", "WHERE role != 2");
    foreach($users as $user)
    {
        $date           =   new DateTime($user->signup_date); // Date stored in database is like 2024 07 29
        $formatted_date =   $date->format("d F Y"); // Formatting date to represent it like 29 July 2024

        $userRole       =   ($user->role == 1)    ?   "Employer"  :   "Applicant";   


        echo "<tr>";
        echo "<td>" .   $user->name         .   "</td>";
        echo "<td>" .   $user->email        .   "</td>";
        echo "<td>" .   $formatted_date     .   "</td>";
        echo "<td>" .   $userRole           .   "</td>";
        // Displaying icons and list for action column
        echo "<td>";
        echo "<div class='action-div d-flex justify-content-center'>";
        echo "<div class='dropdown text-end'>";
        echo "<a href='#' class='d-block link-dark text-decoration-none dropdown-toggle action' data-bs-toggle='dropdown' aria-expanded='false'>";
        echo "<img src='assets/img/card-list.svg'>";
        echo "</a>";
        echo "<ul class='dropdown-menu text-small'>";
        echo "<li> <a class='dropdown-item pointer view' href='view_profile.php?id=".$user->id."'>View</a> </li>";
        echo "<li> <span class='dropdown-item pointer delete' user-id='$user->id'>Delete</span> </li>";
        echo "</ul>";
        echo "</div>";
        echo "</div>";
        echo "</td>";
        echo "</tr>";
        // Upto this point
    }
}



// Used to get all feedbacks in feedbacks_inner.php
function getFeedbacks()
{
    $feedbacks      =   R::findAll("feedbacks");
    if($feedbacks)
    {
        foreach ($feedbacks as $feedback)
        {
            $user_id        =   $feedback->user_id; // Getting the user id of user stored in feedbacks table as foreign key. 
            $user           =   R::findOne("users", "id = ?", [$user_id]); // Now using this id to get that user.
            $isChecked      =   ""; // This help us check that whether the toggle button is checked or not. 
            if($feedback->is_displayed == 1) 
            {
                $isChecked = "checked";
            }
            if($user)
            {
                $user_name      =   $user->name;
                $date           =   new DateTime($feedback->comment_date); // Date stored in database is like 2024 07 29
                $formatted_date =   $date->format("d F Y"); // Formatting date to represent it like 29 July 2024
        
                echo "<tr>";
                echo "<td>" . $user_name . "</td>";
                echo "<td>" . $formatted_date . "</td>";
                echo "<td>";
                // Toggle button  
                echo "<div class='form-check form-switch ms-4'>";
                echo "<input class='form-check-input approve-toggle display-toggle-btn pointer' $isChecked type='checkbox' role='switch' user-id='$user_id'>";
                echo "</div>";
                // Ending here
                echo "</td>";
        
                echo "<td>";
                // Icons and list for action column
                echo "<div class='action-div d-flex justify-content-center'>";
                echo "<div class='dropdown text-end'>";
                echo "<a href='#' class='d-block link-dark text-decoration-none dropdown-toggle action' data-bs-toggle='dropdown' aria-expanded='false'>";
                echo "<img src='assets/img/card-list.svg'>";
                echo "</a>";
                echo "<ul class='dropdown-menu text-small'>";
                echo "<li> <span class='dropdown-item view pointer' user-id='$user_id'>View</span> </li>";
                echo "<li> <span class='dropdown-item delete pointer' user-id='$user_id'>Delete</span> </li>";
                echo "</ul>";
                echo "</div>";
                echo "</div>";
                // Ending up here
                echo "</td>";
                echo "</tr>";
            }
            
        }
    }
    
}



function getAllJobs()
{
    ob_start();
    $jobs   =   R::findAll("jobs");
    
    foreach($jobs as $job) 
    {
        $is_checked     =   "";
        $disabled       =   "";
        $is_featured    =   "";

        if($job->is_approved == 1)
        {
            $is_checked     =   "checked";
        }

        if($job->is_featured == 1)
        {
            $is_featured    =   "checked";
        }

        $expired    =   ($job->expiry_date);
        $current    =   date("Y-m-d"); 
        $status     =   "";

        if($current <= $expired && $job->is_approved == 1)
        {
            $status =   "Live";
        }
        else if($current <= $expired && $job->is_approved == 0)
        {
            $status =   "Pending";
        }
        else if($current > $expired)
        {
            $status             =   "Expired";
            $disabled           =   "disabled"; 
            $job->is_expired    =   1;
        }

        $employer   =   R::findOne("users", "id = ?", [$job->employer_id]);

        $date           =   new DateTime($job->creation_date);
        $formatted_date =   $date->format("d F Y");

    ?>

        <tr>
            <td class="viewJob pointer viewJobFromTitle" job-id="<?php echo $job->id; ?>" data-bs-toggle="modal" data-bs-target="#exampleModal"><?php echo $job->job_title; ?></td>
            <td class="pointer"><a class="employer-name" style="color:black;" href="view_profile?id=<?php echo $employer->id; ?>"><?php echo $employer->name; ?></a></td>
            <td class="d-flex justify-content-center">
                <div class="form-check form-switch">
                    <input class="form-check-input approve-toggle pointer" <?php echo  $is_checked . " " . $disabled;?> job-id="<?php echo $job->id; ?>" type="checkbox" role="switch">
                    <label class="form-check-label" for="approve-toggle"></label>
                </div>
            </td>
            <td>
                <div class="form-check form-switch">
                    <input class="form-check-input feature-toggle pointer" <?php echo  $is_featured . " " . $disabled;?> job-id="<?php echo $job->id; ?>" type="checkbox" role="switch">
                    <label class="form-check-label" for="approve-toggle"></label>
                </div>
            </td>
            <td><?php echo $formatted_date; ?></td>
            <td class="status-<?php echo $job->id; ?>"><?php echo $status; ?></td>
            <td class="d-flex justify-content-center">
                <div class="action-div d-flex justify-content-center">
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle action" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="assets/img/card-list.svg" alt="">
                    </a>

                    <ul class="dropdown-menu text-small">
                        <li><a class="dropdown-item pointer viewJob" data-bs-toggle="modal" data-bs-target="#exampleModalJobs" job-id="<?php echo $job->id; ?>">View</a></li>
                        <li><span class="dropdown-item pointer deleteJob" job-id="<?php echo $job->id; ?>">Delete</span></li>
                    </ul>
                </div>
            </td>
        </tr>

    <?php
    }
    $output = ob_get_contents();
    
    ob_end_clean();
    return $output;
}


function getSkills()
{
    $skills =   R::findAll("skills");

    foreach($skills as $skill)
    {
        $status =   ($skill->status == 1) ? "Active" : "Inactive";

        ?>
            <tr>
                <td class="text-capitalize skill-name"><?php echo $skill->name; ?></td>
                <td class="status"><?php echo $status; ?></td>
                <td class="d-flex justify-content-center">
                    <div class="action-div d-flex justify-content-center">
                    <div class="dropdown text-start">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle action" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="assets/img/card-list.svg" alt="">
                        </a>

                        <ul class="dropdown-menu text-small">
                            <li><span class="dropdown-item pointer edit-skill" data-bs-toggle="modal" data-bs-target="#staticBackdrop" skill-id="<?php echo $skill->id; ?>">Edit</span></li>
                            <li><span class="dropdown-item pointer delete-skill" skill-id="<?php echo $skill->id; ?>">Delete</span></li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php
    }
}




function getCategories()
{
    $categories =   R::findAll("categories");

    foreach($categories as $category)
    {
        $jobsCount  =   R::count("jobs", "WHERE category_id = ?", [$category->id]);

        $status     =   ($category->is_active == 1) ? "Active" : "Inactive";   

        ?>
            <tr>
                <td class="text-capitalize category-name"><?php echo $category->category_name; ?></td>
                <td class="jobsCount"><?php echo $jobsCount; ?></td>
                <td class="jobsCount"><?php echo $status; ?></td>
                <td class="d-flex justify-content-center">
                    <div class="action-div d-flex justify-content-center">
                    <div class="dropdown text-start">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle action" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="assets/img/card-list.svg" alt="">
                        </a>

                        <ul class="dropdown-menu text-small">
                            <li><span class="dropdown-item pointer edit-category" data-bs-toggle="modal" data-bs-target="#staticBackdrop" category-id="<?php echo $category->id; ?>">Edit</span></li>
                            <li><span class="dropdown-item pointer delete-category" category-id="<?php echo $category->id; ?>">Delete</span></li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php
    }
}






function getExperience($user_id)
{
    $experiences    =   R::findAll("experience", "WHERE user_id = ? ORDER BY is_currently_working DESC, id DESC", [$user_id]);

    if($experiences)
    {
        foreach($experiences as $experience)
        {
            $start_date =   new DateTime($experience->start_date);
            $formatted_start_date   =   $start_date->format("F Y"); // Just to display month and year only
            
            if($experience->end_date)
            {
                $end_date   =   new DateTime($experience->end_date);
                $formatted_end_date =   $end_date->format("F Y");
            }
            else
            {
                $formatted_end_date =   null;
            }
            ?>

                <div class="card">
                    <div class="d-flex justify-content-between align-items-center card-header pb-0">
                        <h5 class="fw-bold"><?php echo $experience->designation; ?></h5>
                        <span class="pe-1"><i class="bx bxs-pencil fs-5 pointer pencil-icon" experience-id = "<?php echo $experience->id; ?>" data-bs-toggle="modal" data-bs-target="#editViewModal"></i> <i class="ri ri-delete-bin-5-line basket-icon fs-5 pointer" experience-id = "<?php echo $experience->id; ?>"></i></span>
                    </div>
                    <div class="card-body mt-3">
                        <h5 class="card-title"><?php echo $experience->company; ?></h5>
                        <p class="card-text fs-6 d-flex align-items-center gap-2">
                            <span><i class="bx bx-calendar"></i></span>
                            <span style="font-size: 14px;"><?php echo $formatted_start_date; ?></span> - 
                            <span style="font-size: 14px;"><?php echo (isset($formatted_end_date)) ? $formatted_end_date : "Present"; ?></span>
                        </p>

                        <p class="card-text">
                            <span class="me-3 bg-info rounded-pill px-3 py-1 text-white fw-bold text-capitalize"><?php echo (isset($experience->employement_type)) ? $experience->employement_type : "N/A"; ?></span>
                            <span class="bg-info rounded-pill px-3 py-1 text-white fw-bold text-capitalize"><?php echo (isset($experience->location_type)) ? $experience->location_type : "N/A"; ?></span>
                        </p> 
                    </div>
                </div>

            <?php
        }
    }
    else // This will be displayed if we have no experience added yet.
    {
        ?>
            <h5 class="d-flex justify-content-center">Not Added Yet</h5>
        <?php 
    }
}



function getEducation($user_id)
{
    $educations    =   R::findAll("education", "WHERE user_id = ? ORDER BY is_currently_studying DESC, id DESC", [$user_id]);

    if($educations)
    {
        foreach($educations as $education)
        {
            $start_date =   new DateTime($education->start_date);
            $formatted_start_date   =   $start_date->format("F Y"); // Just to display month and year only
            
            if($education->end_date)
            {
                $end_date   =   new DateTime($education->end_date);
                $formatted_end_date =   $end_date->format("F Y");
            }
            else
            {
                $formatted_end_date =   null;
            }
            ?>

                <div class="card">
                    <div class="d-flex justify-content-between align-items-center card-header pb-0">
                        <h5 class="fw-bold"><?php echo $education->major; ?></h5>
                        <span class="pe-1"><i class="bx bxs-pencil fs-5 pointer edu-pencil-icon" education-id = "<?php echo $education->id; ?>" data-bs-toggle="modal" data-bs-target="#editEducation"></i> <i class="ri ri-delete-bin-5-line edu-basket-icon fs-5 pointer" education-id = "<?php echo $education->id; ?>"></i></span>
                    </div>
                    <div class="card-body mt-3">
                      <h5 class="card-title mb-0"><?php echo $education->institute; ?></h5>
                        <h5 class="text-capitalize" style="font-size: 16px;"><?php echo $education->program; ?></h5>
                        <p class="card-text fs-6 d-flex align-items-center gap-2">
                            <span><i class="bx bx-calendar"></i></span>
                            <span style="font-size: 14px;"><?php echo $formatted_start_date; ?></span> - 
                            <span style="font-size: 14px;"><?php echo (isset($formatted_end_date)) ? $formatted_end_date : "Currently Enrolled"; ?></span>
                        </p>

                        <p class="card-text">
                            <span class="me-3 bg-info rounded-pill px-3 py-1 text-white fw-bold text-capitalize"><?php echo (isset($education->grade)) ? $education->grade : "N/A" ; ?></span>
                        </p> 
                    </div>
                </div>


            <?php
        }
    }
    else // This will be displayed if we have no experience added yet.
    {
        ?>
            <h5 class="d-flex justify-content-center">Not Added Yet</h5>
        <?php 
    }
}
?>


