const viewJobs      =   document.querySelectorAll(".viewJob");
const deleteJobs    =   document.querySelectorAll(".deleteJob");
const approveToggle =   document.querySelectorAll(".approve-toggle");
const featureToggle =   document.querySelectorAll(".feature-toggle");
const modalTitle    =   document.querySelector(".modal-title");
const Jobstatus     =   document.querySelectorAll(".status");

// Setting the flag
var flag    =   "";


viewJobs.forEach(button =>
{
    button.addEventListener("click", ()=>
    {
        var jobId   =   button.getAttribute("job-id");
        flag        =   "view";

        AjaxCall(jobId, flag);
    })
});



approveToggle.forEach(button =>
{
    button.addEventListener("click", ()=>
    {
        var jobId   =   button.getAttribute("job-id");
        flag        =   "approve";

        AjaxCall(jobId, flag);
    })
});

featureToggle.forEach(button =>
{
    button.addEventListener("click", ()=>
    {
        var jobId   =   button.getAttribute("job-id");
        flag        =   "feature";

        AjaxCall(jobId, flag);
    })
});



deleteJobs.forEach(button =>
{
    button.addEventListener("click", ()=>
    {
        var jobId   =   button.getAttribute("job-id");
        flag        =   "delete";

        Swal.fire({
            title: "Are you sure?",
            text: "This job will permanently be deleted",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) 
            {
                AjaxCall(jobId, flag); 
            }
          });
    })
});



function AjaxCall(jobId, flag)
{
    $.ajax(
    {
        url         :   "actions/jobs_action.php",
        type        :   "post",
        dataType    :   "json",
        data        :
        {
            jobId   :   jobId,
            flag    :   flag
        },
        success     :   function(response)
        {
           if(response.view && response.success)
           {
                $(".job-title").text(response.job_title);
                $(".salary-amount").text(response.salary_amount);
                $(".salary-currency").text(response.salary_currency);
                $(".per-period").text(response.per_period);
                $(".company-name").text(response.company_name);
                $(".start-date").text(response.start_date);
                $(".expiry-date").text(response.expiry_date);
                $(".employement-type").text(response.employement_type);
                $(".location-type").text(response.location_type);
                $(".description-text").text(response.description);
           }
           else if(response.approve && response.success)
           {
                $(".status-"+jobId).text(response.message);
           }
           else if(response.delete && response.success)
           {
                Swal.fire({
                    title: "Deleted!",
                    text: "This job has been deleted",
                    icon: "success"
                }).then((result)=>
                {
                    if(result.isConfirmed)
                    {
                        location.reload();
                    }
                })
           }
        }
    });
}