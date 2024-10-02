document.addEventListener("DOMContentLoaded", function () 
{
    // Logic related to add/remove favoirte job starts here.
    const image1Src   = "assets/img/heart-regular.svg";
    const image2Src   = "assets/img/heart-solid.svg";

    var toast         = document.querySelector(".toast");
    var toastMessage  = document.querySelector(".toast-message");

    const favorites   = document.querySelectorAll(".favorite-image");

    function showToast (message) 
    {
        toastMessage.textContent    =   message;
        toast.classList.add("toast-toggle", "d-block");

        setTimeout(() => 
        {
            toast.classList.remove("toast-toggle", "d-block");
        }, 3000);
    }

    
    

    favorites.forEach(function(button) 
    {
        button.addEventListener("click", function() 
        {
            const currentSrc = this.getAttribute('src');

            const job_id     =  this.getAttribute("job-id");
            let newSrc       =  (currentSrc === image1Src) ? image2Src      : image1Src;
            let action       =  (currentSrc === image1Src) ? "add-favorite" : "remove-favorite";

            console.log(job_id);

            this.setAttribute('src', newSrc);

            $.ajax({
                url         :   "actions/common_actions.php",
                type        :   "post",
                dataType    :   "json",
                data        : 
                {
                    job_id  :   job_id,
                    "flag"  :   action
                },
                success: function(response) 
                {
                    showToast(response.message);
                },
                error: function() 
                {
                    showToast("An error occurred");
                }
            });
        });
    });
    // Logic related add/remove favorite jobs end here. 


    // Logic related to view/apply job starts here. 
    const view_btns     =   document.querySelectorAll(".view-btn");
    const apply_btns    =   document.querySelectorAll(".apply-btn");

    view_btns.forEach(function(view_btn)
    {
        view_btn.addEventListener("click", function()
        {
            let job_id      =   this.getAttribute("job-id");    
            let flag        =   "view-job";
            let dataType    =   "html";
            AjaxCall(job_id, flag, dataType);
        });
    });








    function AjaxCall(job_id, flag, dataType)
    {
        $.ajax(
        {
            url         :   "actions/common_actions.php",
            type        :   "post", 
            dataType    :   dataType,
            data        :   
            {
                flag    :   flag,
                job_id  :   job_id
            },
            success     :   function(response)
            {
                if(dataType === "html")
                {
                    console.log(response);
                    $(".job-summary").html(response);
                }
                
            }
        });
    }

});




$(document).ready(function()
{
    $("#city-selector, #category").select2({
        width:  "100%"
    });
});






function func()
{
    console.log("hellow ")
}


// const image1Src   = "assets/img/heart-regular.svg";
//     const image2Src   = "assets/img/heart-solid.svg";

//     var toast         = document.querySelector(".toast");
//     var toastMessage  = document.querySelector(".toast-message");

// function func()
// {
//     const favorites   = document.querySelectorAll(".favorite-image");

//     favorites.forEach(function(button) 
//     {
//         button.addEventListener("click", function() 
//         {
//             const currentSrc = this.getAttribute('src');

//             const job_id     =  this.getAttribute("job-id");
//             let newSrc       =  (currentSrc === image1Src) ? image2Src      : image1Src;
//             let action       =  (currentSrc === image1Src) ? "add-favorite" : "remove-favorite";

//             console.log(job_id);

//             this.setAttribute('src', newSrc);

//             $.ajax({
//                 url         :   "actions/common_actions.php",
//                 type        :   "post",
//                 dataType    :   "json",
//                 data        : 
//                 {
//                     job_id  :   job_id,
//                     "flag"  :   action
//                 },
//                 success: function(response) 
//                 {
//                     showToast(response.message);
//                 },
//                 error: function() 
//                 {
//                     showToast("An error occurred");
//                 }
//             });
//         });
//     }); 
// }



// function showToast (message) 
//     {
//         toastMessage.textContent    =   message;
//         toast.classList.add("toast-toggle", "d-block");

//         setTimeout(() => 
//         {
//             toast.classList.remove("toast-toggle", "d-block");
//         }, 3000);
//     }