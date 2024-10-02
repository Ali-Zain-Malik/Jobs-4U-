const profile_pic           =   document.querySelector(".profile-image-input");
const camera_icon           =   document.getElementById("camera-icon");
const name_pencil           =   document.getElementById("name-pencil");
const user_name             =   document.getElementById("name");
const seeMore               =   document.querySelector(".seeMore");
const description           =   document.querySelector(".description-text");
const description_pencil    =   document.getElementById("description-pencil");
const desc_save_btn         =   document.getElementById("desc-save-btn");
const skills_selector       =   document.getElementById("skills");
const skills_save_btn       =   document.getElementById("skills-save-btn");
const loader                =   document.querySelector(".loader");


// Triggering the click event of input type file.
camera_icon.addEventListener("click", function()
{
    profile_pic.click();
});





name_pencil.addEventListener("click", function()
{
    if (user_name.isContentEditable) 
    {
        user_name.contentEditable = "false";
        user_name.classList.remove('editable');
        name_pencil.classList.remove("bx-check", "fs-3");
        name_pencil.classList.add("bxs-pencil");
        // When user has edited name and clicked the check icon call ajax but not before checks
        if(user_name.textContent.trim() === "")
        {
            error("Name is required");
            // As name is empty, so the check icon and editable area should remain there.
            user_name.contentEditable = "true";
            user_name.classList.add('editable');
            name_pencil.classList.remove("bxs-pencil");
            name_pencil.classList.add("bx-check","fs-3");
            return;
        } 
        else
        {
            const flag  =   "edit-name";
            AjaxCall(flag, user_name.textContent.trim());
        }
    } 
    else 
    {
        user_name.contentEditable = "true";
        user_name.classList.add('editable');
        name_pencil.classList.remove("bxs-pencil");
        name_pencil.classList.add("bx-check","fs-3");
    }
});











if(description.textContent.length > 400)
{
    seeMore.classList.remove("d-none");
}

seeMore.addEventListener("click", function()
{
    if(description.style.maxHeight == "65px")
    {
        description.style.maxHeight =   "none";
        description.style.overflow  =   "none";
        seeMore.textContent         =   "See Less";
    }
    else
    {
        description.style.maxHeight =   "65px";
        description.style.overflow  =   "hidden";
        seeMore.textContent         =   "...See More";
    }
});




description_pencil.addEventListener("click", function()
{
    if (description.isContentEditable) 
    {
        description.classList.remove('editable');
        description.contentEditable =   "false";
        description.style.maxHeight =   "65px";
        description.style.overflow  =   "hide";
        seeMore.textContent         =   "...See More"
        desc_save_btn.classList.add("d-none");
    } 
    else 
    {
        description.classList.add('editable');
        description.contentEditable =   "true";
        description.style.maxHeight =   "none";
        description.style.overflow  =   "none";
        seeMore.textContent         =   "";
        desc_save_btn.classList.remove("d-none");
    }
});


desc_save_btn.addEventListener("click", function()
{
    let flag    =   "edit-description";
    AjaxCall(flag, description.textContent.trim());
});



/*
As we have used Select2 library, so we cannot use event listener as we use in default methods. 
We first target the select with its id, then using on method of jquery which attach the eventlistener
we attach event listeners 'select' and 'unselect' to any thing which is in select2. 
*/
$('#skills').on('select2:select select2:unselect', function (e) 
{
    skills_save_btn.classList.remove("d-none");
});


skills_save_btn.addEventListener("click", function()
{
    let flag    =   "edit-skills";
    AjaxCall(flag, $("#skills").val()); // Using this to get the array of all selected skills.
});


$(document).ready(function()
{
    if($("#currently-working").prop("checked"))
    {
        $(".end-date-div").removeClass("d-flex");
        $(".end-date-div").addClass("d-none");
        $("#end-month, #end-year").prop("disabled", true);
    }
    else
    {
        $(".end-date-div").removeClass("d-none");
        $(".end-date-div").addClass("d-flex");
        $("#end-month, #end-year").prop("disabled", false);
    }

    if($("#currently-studying").prop("checked"))
    {
        $(".edu-end-date-div").removeClass("d-flex");
        $(".edu-end-date-div").addClass("d-none");
        $("#edu-end-month, #end-year").prop("disabled", true);
    }
    else
    {
        $(".edu-end-date-div").removeClass("d-none");
        $(".edu-end-date-div").addClass("d-flex");
        $("#edu-end-month, #end-year").prop("disabled", false);
    }
})



$("#currently-working").click(function()
{
    if($("#currently-working").prop("checked"))
    {
        $(".end-date-div").removeClass("d-flex");
        $(".end-date-div").addClass("d-none");
        $("#end-month, #end-year").prop("disabled", true);
    }
    else
    {
        $(".end-date-div").removeClass("d-none");
        $(".end-date-div").addClass("d-flex");
        $("#end-month, #end-year").prop("disabled", false);
    }
});

$("#currently-working").click(function()
{
    if($("#currently-working").prop("checked"))
    {
        $(".end-date-div").removeClass("d-flex");
        $(".end-date-div").addClass("d-none");
        $("#end-month, #end-year").prop("disabled", true);
    }
    else
    {
        $(".end-date-div").removeClass("d-none");
        $(".end-date-div").addClass("d-flex");
        $("#end-month, #end-year").prop("disabled", false);
    }
});

$("#currently-studying").click(function()
{
    if($("#currently-studying").prop("checked"))
    {
        $(".edu-end-date-div").removeClass("d-flex");
        $(".edu-end-date-div").addClass("d-none");
        $("#edu-end-month, #edu-end-year").prop("disabled", true);
    }
    else
    {
        $(".edu-end-date-div").removeClass("d-none");
        $(".edu-end-date-div").addClass("d-flex");
        $("#edu-end-month, #edu-end-year").prop("disabled", false);
    }
});



$("#exp-save-btn").click(function()
{
    if($("#designation").val().trim() === "" || $("#company").val().trim() === "" || $("#start-month").val() === "" || $("#start-year").val() === "" || (($("#end-month").val() === "" || $("#end-year").val() === "") && !$("#end-month, #end-year").prop("disabled")))
    {
        $(".error-msg").removeClass("d-none");
    } // .val function of jquery gets the value of input field even if the field is disabled. That's why checking for it also. 
    else if(!$("#end-month, #end-year").prop("disabled") && ($("#end-year").val() < $("#start-month").val() && $("#end-year").val() <= $("#start-year").val()))
    {
        errorMsg("End date can't be earlier than start date");
    }
    else if(!$("#end-month, #end-year").prop("disabled") && ($("#end-year").val() < $("#start-year").val()))
    {
        errorMsg("End date can't be earlier than start date");
    }
    else
    {
        let data_array      =   {
            "designation"       :   $("#designation").val().trim(),
            "company"           :   $("#company").val().trim(),
            "start-month"       :   $("#start-month").val(),
            "start-year"        :   $("#start-year").val(),
            "currently-working" :   $("#currently-working").prop("checked") ? 1 : 0,
            "end-month"         :   $("#end-month").prop("disabled")    ? null : $("#end-month").val(),
            "end-year"          :   $("#end-year").prop("disabled")     ? null : $("#end-year").val(),
            "employement-type"  :   $("#employement-type").val(),
            "location-type"     :   $("#location-type").val()
        }

        AjaxCall("add-exp", data_array);
    }
});



$("#edu-save-btn").click(function()
{
    if($("#program").val() === "" || $("#major").val().trim() === "" || $("#institute").val().trim() === "" || $("#edu-start-month").val() === "" || $("#edu-start-year").val() === "" || (($("#edu-end-month").val() === "" || $("#edu-end-year").val() === "") && !$("#edu-end-month, #edu-end-year").prop("disabled")))
    {
        $(".error-msg").removeClass("d-none");
    } // .val function of jquery gets the value of input field even if the field is disabled. That's why checking for it also. 
    else if(!$("#edu-end-month, #edu-end-year").prop("disabled") && ($("#edu-end-year").val() < $("#edu-start-month").val() && $("#edu-end-year").val() <= $("#edu-start-year").val()))
    {
        errorMsg("End date can't be earlier than start date");
    }
    else if(!$("#edu-end-month, #edu-end-year").prop("disabled") && ($("#edu-end-year").val() < $("#edu-start-year").val()))
    {
        errorMsg("End date can't be earlier than start date");
    }
    else
    {
        let data_array      =   {
            "program"               :   $("#program").val(),
            "major"                 :   $("#major").val().trim(),
            "institute"             :   $("#institute").val().trim(),
            "start-month"           :   $("#edu-start-month").val(),
            "start-year"            :   $("#edu-start-year").val(),
            "currently-studying"    :   $("#currently-studying").prop("checked")    ? 1         : 0,
            "end-month"             :   $("#edu-end-month").prop("disabled")        ?   null    : $("#edu-end-month").val(),
            "end-year"              :   $("#edu-end-year").prop("disabled")         ?   null    :   $("#edu-end-year").val()
        }

        AjaxCall("add-edu", data_array);
    }
});




function AjaxCall(flag, data)
{
    $.ajax(
    {
        url         :   "actions/profile_page_action.php",
        type        :   "post",
        dataType    :   "json",
        timeout     :   10000,
        data        :   
        {
            flag    :   flag,
            data    :   data
        },
        beforeSend  :   function()
        {
            addLoader();
        },
        complete    :   function()
        {
            removeLoader();
        },
        success     :   function(response)
        {
            if(response.success)
            {
                successMsg(response.message);

                setTimeout(() => 
                {
                    location.reload();
                }, 1200);
            }
            else
            {
                errorMsg(response.message);
            }
        },
        error       :   function()
        {
            errorMsg("Some thing went wrong 🙁");
        }
    });
}


function errorMsg(message)
{
    $.notify(`<p class='text-center m-0'>${message}</p>`, {verticalAlign: "top", align: "right", color:"#fff", background: "#ff4d4d"} );
}

function successMsg(message)
{
    $.notify(`<p class='text-center m-0'>${message}</p>`, {verticalAlign: "top", align: "right", color:"#fff", background: "#32cd32"} );
}



function addLoader()
{
    loader.classList.remove("d-none");
    loader.classList.add("d-flex");
}

function removeLoader()
{
    loader.classList.remove("d-flex");
    loader.classList.add("d-none");
}
// document.addEventListener("DOMContentLoaded", function()
// {
//     $.ajax(
//     {
//         url         :   "actions/profile_page_action.php",
//         type        :   "post",
//         dataType    :   "json",
//         data        :   
//         {
//             // ********* Resume work from here *********
//         }
//     });
// });