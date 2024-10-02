document.addEventListener("DOMContentLoaded",()=>
{
    // Form data used to change or edit user info.
    const   fullName              =   document.getElementById("fullName");
    const   email                 =   document.getElementById("Email");
    const   saveEditChangesBtn    =   document.getElementById("save-changes-btn");
    const   editForm              =   document.getElementById("edit-form");

    // form data which will be used to changed the user password. Starting from line 77
    const   currentPassword       =   document.getElementById("currentPassword");
    const   newPassword           =   document.getElementById("newPassword");
    const   renewPassword         =   document.getElementById("renewPassword");
    const   changePasswordForm    =   document.getElementById("change-password-form");
    const   savePassChngBtn       =   document.getElementById("save-pass-chng-btn");


    var     user_id               =   saveEditChangesBtn.getAttribute("user-id");

    var     city                  =   document.getElementById("select-city");     

    var     deleteImage           =   false;
    const   deleteImageBtn        =   document.getElementById("delete-image");
    const   image                 =   document.getElementById("image");

    deleteImageBtn.addEventListener("click", ()=>
    {
        image.setAttribute("src", "assets/img/card.jpg");
    });



    $("#upload-btn").on("click", function(event)
    {
        event.preventDefault();
        $("#file-input").click();
    })

    $("#file-input").on("change", function(event)
    {

        file  =   this.files[0];
        if(file)
        {
            const reader    =    new FileReader;
            reader.onload   =   function(event)
            {
                document.getElementById("image").src    =   event.target.result;
            }

            reader.readAsDataURL(file);
        }

    })


    saveEditChangesBtn.addEventListener("click", ()=>
    {
        if(fullName.value == "" || email.value == "")
        {
            $.notify("Name and Email cannot be empty", {verticalAlign : "top", align:"right", background: "#ff5555"});
        }
        else if(!is_validEmail(email.value))
        {
            $.notify("Invalid Email", {verticalAlign : "top", align:"right", background: "#ff5555"});
        }
        else if(!is_validName(fullName.value))
        {
            $.notify("Name must be greater than 2 characters", {verticalAlign : "top", align:"right", background: "#ff5555"});
        }
        // else if(city.value == "")
        // {
        //     $.notify("City cannot be empty", {verticalAlign : "top", align:"right", background: "#ff5555"});
        // }
        else
        {
            const formData          =   new FormData(editForm);
            formData.append("user_id", user_id);
            if(image.getAttribute("src") == "assets/img/card.jpg")
            {
                deleteImage =   true;
                formData.append("delete_image", deleteImage);
            }

            $.ajax(
            {
                url         :   "actions/view_profile_action.php",
                type        :   "post",
                dataType    :   "json",
                data        :   formData,
                processData :   false,
                contentType :   false,
                success     :   function(response)
                {
                    $.notify(response.message, {verticalAlign : "top", align:"right", background: "#87CEEB"});

                    setTimeout(() => 
                    {
                        location.reload();
                    }, 1200);
                }
            });
        }
        
    })



    function is_validEmail(emailInput) 
    {
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
        return emailRegex.test(emailInput);
    }


    function is_validName(nameInput)
    {
        nameInput   =   nameInput.trim();
        return (nameInput.length > 2);
    }




    // Passowrd Change code starting from here. 
    savePassChngBtn.addEventListener("click", function()
    {
        if(!is_validPassword(currentPassword.value) || !is_validPassword(newPassword.value) || !is_validPassword(renewPassword.value))
        {
            $.notify("Any field cannot be INVALID or EMPTY", {verticalAlign : "top", align:"right", background: "#ff5555"});
        }
        else if(newPassword.value !== renewPassword.value)
        {
            $.notify("New and Renew passwords do not match", {verticalAlign : "top", align:"right", background: "#ff5555"});
        }
        else
        {
            $.ajax(
            {
                url         :   "actions/view_profile_action.php",
                type        :   "post",
                dataType    :   "json",
                data        :
                {
                    user_id         :   user_id,
                    currentPassword :   currentPassword.value,
                    newPassword     :   newPassword.value
                },
                success     :   function(response)
                {
                    if(response.success)
                    {
                        $.notify(response.message, {verticalAlign : "top", align:"right", background: "#87CEEB"});

                        setTimeout(() => 
                        {
                            // location.reload();
                        }, 1300);
                    }
                    else
                    {
                        $.notify(response.message, {verticalAlign : "top", align:"right", background: "#ff5555"});
                        currentPassword =   NULL;
                        newPassword     =   NULL;
                        renewPassword = NULL;
                    }
                }

            });
        }
    });

    function is_validPassword(passInput)
    {
        let passRegex   =   /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@!#$%^&*()_+[\]{}|;:',.<>?]).{8,}$/;
        return passRegex.test(passInput.trim());
    }



    $('#select-country, #select-city').select2(
    {
        width : "100%"
    });

// Using another library 
    $('#start-month, #start-year, #end-month, #end-year, #employement-type, #location-type, #edit-start-month, #edit-start-year, #edit-end-month, #edit-end-year, #edit-employement-type, #edit-location-type, #program, #grade, #edu-start-month, #edu-start-year, #edu-end-month, #edu-end-year, #edit-program, #edit-edu-start-month, #edit-edu-start-year, #edit-edu-end-month, #edit-edu-end-year, #edit-grade').selectize();


    $("#select-country").on("input", function()
    {
        var country_id  =   $("#select-country").val();
       
        $.ajax(
        {
            url         :   "actions/view_profile_action.php",
            type        :   "post",
            dataType    :   "json",
            data        :   
            {
                country_id  :   country_id
            },
            success         :   function(response)
            {
                if(response.success)
                {
                    $("#select-city").val("");
                    $("#select-city").text("");

                    $("#select-city").append(new Option("Select City", ""));

                    for (let i = 0; i < response.cityCount; i++) 
                    {
                        $("#select-city").append(new Option(response.cityInfo[i].city_name, response.cityInfo[i].city_id));
                    }

                }
            }
        });
    });
    



    // Processes regarding experience section in profile page starting from here.
    const currently_checked     =   document.getElementById("currently-working");
    const end_date_div          =   document.querySelector(".end-date-div");
    const add_experience_form   =   document.getElementById("add-experience-form");
    const experience_save_btn   =   document.querySelector(".experience-save-btn");
    const start_exp_month       =   document.getElementById("start-month");
    const start_exp_year        =   document.getElementById("start-year");
    const end_exp_month         =   document.getElementById("end-month");
    const end_exp_year          =   document.getElementById("end-year");

    const edit_currently_checked    =   document.getElementById("edit-currently-working");
    // Disabling end month and end year input so that when form is submitted while they are not 
    // not required then these should not be submitted.
    end_exp_month.disabled   = true;
    end_exp_year.disabled    = true;

    $("#edit-end-month").prop("disabled", true);
    $("#edit-end-month").prop("disabled", true);

    currently_checked.addEventListener("input", ()=>
    {
        if(currently_checked.checked)
        {
            end_date_div.classList.remove("d-flex");
            end_date_div.classList.add("d-none");  

            end_exp_month.disabled   =  true;
            end_exp_year.disabled    =  true;
        }
        else 
        {
            end_date_div.classList.remove("d-none");
            end_date_div.classList.add("d-flex");

            end_exp_month.disabled   = false;
            end_exp_year.disabled    = false;
        }
    });


    edit_currently_checked.addEventListener("input", ()=>
    {
        if(edit_currently_checked.checked)
        {
            document.querySelector(".edit-end-date-div").classList.remove("d-flex");
            document.querySelector(".edit-end-date-div").classList.add("d-none");  

            $("#edit-end-month").prop("disabled", true);
            $("#edit-end-year").prop("disabled", true);
        }
        else 
        {
            document.querySelector(".edit-end-date-div").classList.remove("d-none");
            document.querySelector(".edit-end-date-div").classList.add("d-flex");

            $("#edit-end-month").prop("disabled", false);
            $("#edit-end-year").prop("disabled", false);
        }
    });



    experience_save_btn.addEventListener("click", ()=>
    {
        const form_data     =   new FormData(add_experience_form);
        const user_id       =   experience_save_btn.getAttribute("user-id");

        for (const [key, value] of form_data.entries()) 
        {
           if(value.trim() === "")
           {
                $.notify("Please fill all fields !", {verticalAlign : "top", align:"right", background: "#ff5555"});
                return;
           }
           else if(key === "end-month" || key === "end-year") // Check further only if the end month and end year are enabled. 
           {
                if(end_exp_month.value < start_exp_month.value && end_exp_year.value <= start_exp_year.value)
                { 
                    $.notify("End date can’t be earlier than start date !", {verticalAlign : "top", align:"right", background: "#ff5555"});
                    return;
                }
                else if(end_exp_year.value < start_exp_year.value)
                {
                    $.notify("End date can’t be earlier than start date !", {verticalAlign : "top", align:"right", background: "#ff5555"});
                    return;
                }
           }
        }

        form_data.append("flag", "add");
        form_data.append("user-id", user_id);
        AjaxCall(form_data);
        
    })

    
    function AjaxCall(form_data)
    {
        $.ajax(
        {
            url         :   "actions/view_profile_action.php",
            type        :   "post",
            dataType    :   "json",
            data        :   form_data,
            processData :   false,
            contentType :   false,
            success     :   function(response)
            {
                if(response.success)
                {
                    $.notify(response.message, {verticalAlign : "top", align:"right", background: "#87CEEB"});
                    setTimeout(()=>
                    {
                        location.reload();
                    }, 1200);
                }
                else
                {
                    $.notify(response.message, {verticalAlign : "top", align:"right", background: "#ff5555"});
                }
            }
        });
    }






    var experience_id   =   "";
    const pencil_icons  =   document.querySelectorAll(".pencil-icon");

    pencil_icons.forEach(pencil_icon =>
    {
        pencil_icon.addEventListener("click", ()=>
        {
            experience_id   =   pencil_icon.getAttribute("experience-id");
            $.ajax(
            {
                url         :   "actions/view_profile_action.php",
                type        :   "post",
                dataType    :   "json",
                data        :
                {
                    flag            :   "view-experience",
                    experience_id   :   experience_id
                },
                success     :   function(response)
                {
                    if(response.success)
                    {
                        let checked             =   (response.experience.is_currently_working == 1) ? true : false; 
                        let start_dateString    =   response.experience.start_date;
                        let start_date          =   new Date(start_dateString);
                        let start_month         =   start_date.getMonth() + 1;// Adding 1 bcoz getMonth function starts from 0.
                        let start_year          =   start_date.getFullYear();
                        let end_dateString      =   response.experience.end_date;
                        let end_date            =   new Date(end_dateString);
                        let end_month           =   end_date.getMonth() + 1;// Adding 1 bcoz getMonth function starts from 0.
                        let end_year            =   end_date.getFullYear();

                        $("#edit-company").val(response.experience.company);
                        $("#edit-designation").val(response.experience.designation);

                        // To update value in select using selectize library we need this function
                        $.map($("#edit-employement-type"), function(item) 
                        { 
                            item.selectize.setValue(response.experience.employement_type);
                        });
                        $.map($("#edit-location-type"), function(item) 
                        { 
                            item.selectize.setValue(response.experience.location_type);
                        });

                        $.map($("#edit-start-month"), function(item)
                        {
                            item.selectize.setValue(start_month);
                        });

                        $.map($("#edit-start-year"), function(item)
                        {
                            item.selectize.setValue(start_year);
                        });


                        $.map($("#edit-end-month"), function(item)
                        {
                            item.selectize.setValue(end_month);
                        });

                        $.map($("#edit-end-year"), function(item)
                        {
                            item.selectize.setValue(end_year);
                        });



                        $("#edit-currently-working").prop("checked", checked);

                        // Making sure that if the user is currently working there then the end date div should not be displayed.
                        if(!edit_currently_checked.checked)
                        {
                            document.querySelector(".edit-end-date-div").classList.remove("d-none");
                            document.querySelector(".edit-end-date-div").classList.add("d-flex");
                    
                            $("#edit-end-month").prop("disabled", false);
                            $("#edit-end-year").prop("disabled", false);
                        }
                    }
                }

            });

        });
    });










    const experience_edit_btn   =   document.querySelector(".experience-edit-btn");
    const edit_experience_form  =   document.getElementById("edit-experience-form");

    const edit_start_exp_month       =   document.getElementById("edit-start-month");
    const edit_start_exp_year        =   document.getElementById("edit-start-year");
    const edit_end_exp_month         =   document.getElementById("edit-end-month");
    const edit_end_exp_year          =   document.getElementById("edit-end-year");

    experience_edit_btn.addEventListener("click", ()=>
        {
            const form_data     =   new FormData(edit_experience_form);
    
            for (const [key, value] of form_data.entries()) 
            {
               if(value.trim() === "")
               {
                    $.notify("Please fill all fields !", {verticalAlign : "top", align:"right", background: "#ff5555"});
                    return;
               }
               else if(key === "edit-end-month" || key === "edit-end-year") // Check further only if the end month and end year are enabled. 
               {
                    if(edit_end_exp_month.value < edit_start_exp_month.value && edit_end_exp_year.value <= edit_start_exp_year.value)
                    { 
                        $.notify("End date can’t be earlier than start date !", {verticalAlign : "top", align:"right", background: "#ff5555"});
                        return;
                    }
                    else if(edit_end_exp_year.value < edit_start_exp_year.value)
                    {
                        $.notify("End date can’t be earlier than start date !", {verticalAlign : "top", align:"right", background: "#ff5555"});
                        return;
                    }
               }
            }
    
            form_data.append("flag", "edit-experience");
            form_data.append("experience_id", experience_id);
            AjaxCall(form_data);
            
        })
  
        





        const basket_icons  =   document.querySelectorAll(".basket-icon");
        basket_icons.forEach(basket_icon =>
        {
            basket_icon.addEventListener("click",()=>
            {
                experience_id   =   basket_icon.getAttribute("experience-id");
                let flag        =   "delete-experience";

                Swal.fire({
                    title: "Are you sure?",
                    text: "This experience will permanently be deleted",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) 
                    {
                        $.ajax(
                        {
                            url         :   "actions/view_profile_action.php",
                            type        :   "post",
                            dataType    :   "json",
                            data        :
                            {
                                flag            :   flag,
                                experience_id   :   experience_id
                            },
                            success     :   function(response)
                            {
                                if(response.success)
                                {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "This experience has been deleted",
                                        icon: "success"
                                    }).then((result)=>
                                    {
                                        if(result.isConfirmed)
                                        {
                                            location.reload();
                                        }
                                    })
                                }
                                else
                                {
                                    $.notify(response.message, {verticalAlign : "top", align:"right", background: "#ff5555"});
                                }
                               
                            }
                        });
                    }
                });
            })
        });



        // Process regarding experience in profile page ending here. 




        // Process regarding education in profile page starting from here
        const education_save_btn    =   document.querySelector(".education-save-btn");
        const currently_studying    =   document.getElementById("currently-studying");
        const edu_start_month       =   document.getElementById("edu-start-month");
        const edu_start_year        =   document.getElementById("edu-start-year");
        const edu_end_month         =   document.getElementById("edu-end-month");
        const edu_end_year          =   document.getElementById("edu-end-year");
        const edu_end_date_div      =   document.querySelector(".edu-end-date-div");
        const add_edu_form          =   document.getElementById("add-education-form");
        const grade_div             =   document.querySelector(".grade-div");
        const grade                 =   document.getElementById("grade");
        edu_end_month.disabled      =   true;
        edu_end_year.disabled       =   true;
        grade.disabled              =   true;

        currently_studying.addEventListener("input", ()=>
        {
            if(edu_end_date_div.classList.contains("d-none") && grade_div.classList.contains("d-none"))
            {
                edu_end_date_div.classList.remove("d-none");
                edu_end_date_div.classList.add("d-flex");

                edu_end_month.disabled  =   false;
                edu_end_year.disabled   =   false;


                grade_div.classList.remove("d-none");
                grade_div.classList.add("d-flex");

                grade.disabled  =   false;
                grade.disabled  =   false;
            }
            else 
            {
                edu_end_date_div.classList.remove("d-flex");
                edu_end_date_div.classList.add("d-none");

                edu_end_month.disabled  =   true;
                edu_end_year.disabled   =   true;


                grade_div.classList.remove("d-flex");
                grade_div.classList.add("d-none");

                grade.disabled  =   true;
                grade.disabled  =   true;
            }
        });


        education_save_btn.addEventListener("click", ()=>
        {
            const form_data     =   new FormData(add_edu_form);
            const user_id       =   education_save_btn.getAttribute("user-id");
    
            for (const [key, value] of form_data.entries()) 
            {
               if(value.trim() === "")
               {
                    $.notify("Please fill all fields !", {verticalAlign : "top", align:"right", background: "#ff5555"});
                    return;
               }
               else if(key === "edu-end-month" || key === "edu-end-year") // Check further only if the end month and end year are enabled. 
               {
                    if(edu_end_month.value < edu_start_month.value && edu_end_year.value <= edu_start_year.value)
                    { 
                        $.notify("End date can’t be earlier than start date !", {verticalAlign : "top", align:"right", background: "#ff5555"});
                        return;
                    }
                    else if(edu_end_year.value < edu_start_year.value)
                    {
                        $.notify("End date can’t be earlier than start date !", {verticalAlign : "top", align:"right", background: "#ff5555"});
                        return;
                    }
               }
            }


            form_data.append("flag", "add-education");
            form_data.append("user-id", user_id);
            AjaxCall(form_data);
        })


        // Editing and displaying education information

        const edit_currently_studying    =   document.getElementById("edit-currently-studying");

        edit_currently_studying .addEventListener("input", ()=>
        {
            if(edit_currently_studying.checked)
            {
                document.querySelector(".edit-edu-end-date-div").classList.remove("d-flex");
                document.querySelector(".edit-edu-end-date-div").classList.add("d-none");  
                document.querySelector(".edit-grade-div").classList.remove("d-flex");
                document.querySelector(".edit-grade-div").classList.add("d-none");

                $("#edit-edu-end-month").prop("disabled", true);
                $("#edit-edu-end-year").prop("disabled", true);
                $("#edit-grade").prop("disabled", true);

            }
            else 
            {
                document.querySelector(".edit-edu-end-date-div").classList.remove("d-none");
                document.querySelector(".edit-edu-end-date-div").classList.add("d-flex");
                document.querySelector(".edit-grade-div").classList.remove("d-none");
                document.querySelector(".edit-grade-div").classList.add("d-flex");
    
                $("#edit-edu-end-month").prop("disabled", false);
                $("#edit-edu-end-year").prop("disabled", false);
                $("#edit-grade").prop("disabled", false);
            }
        });


        var education_id        =   "";
        const edu_pencil_icons  =   document.querySelectorAll(".edu-pencil-icon");
        
        edu_pencil_icons.forEach(pencil =>
        {
            pencil.addEventListener("click", ()=>
            {
                education_id  =   pencil.getAttribute("education-id");
                let flag            =   "view-education";
    
                $.ajax(
                {
                    url         :   "actions/view_profile_action.php",
                    type        :   "post",
                    dataType    :   "json",
                    data        :
                    {
                        education_id    :   education_id,
                        flag            :   flag
                    },
                    success     :   function(response)
                    {
                        if(response.success)
                        {
                            let checked             =   (response.education.is_currently_studying == 1) ? true : false; 
                            let start_dateString    =   response.education.start_date;
                            let start_date          =   new Date(start_dateString);
                            let start_month         =   start_date.getMonth() + 1;// Adding 1 bcoz getMonth function starts from 0.
                            let start_year          =   start_date.getFullYear();
                            let end_dateString      =   response.education.end_date;
                            let end_date            =   new Date(end_dateString);
                            let end_month           =   end_date.getMonth() + 1;// Adding 1 bcoz getMonth function starts from 0.
                            let end_year            =   end_date.getFullYear();
    
                            $("#edit-institute").val(response.education.institute);
                            $("#edit-major").val(response.education.major);
    
                            // To update value in select using selectize library we need this function
                            $.map($("#edit-program"), function(item) 
                            { 
                                item.selectize.setValue(response.education.program);
                            });
    
                            $.map($("#edit-edu-start-month"), function(item)
                            {
                                item.selectize.setValue(start_month);
                            });
    
                            $.map($("#edit-edu-start-year"), function(item)
                            {
                                item.selectize.setValue(start_year);
                            });
    
    
                            $.map($("#edit-edu-end-month"), function(item)
                            {
                                item.selectize.setValue(end_month);
                            });
    
                            $.map($("#edit-edu-end-year"), function(item)
                            {
                                item.selectize.setValue(end_year);
                            });
    
                            $.map($("#edit-grade"), function(item)
                            {
                                item.selectize.setValue(response.education.grade);
                            });
    
    
    
                            $("#edit-currently-studying").prop("checked", checked);

                            // Making sure that if currently studying is on then user shall not see the end date and grade divs.
                            if(edit_currently_studying.checked)
                            {
                                $("#edit-edu-end-month").prop("disabled", true);
                                $("#edit-edu-end-year").prop("disabled", true);
                                $("#edit-grade").prop("disabled", true);
                    
                                document.querySelector(".edit-edu-end-date-div").classList.remove("d-flex");
                                document.querySelector(".edit-edu-end-date-div").classList.add("d-none");  
                                document.querySelector(".edit-grade-div").classList.remove("d-flex");
                                document.querySelector(".edit-grade-div").classList.add("d-none");
                    
                                
                            }
                            else 
                            {
                                $("#edit-edu-end-month").prop("disabled", false);
                                $("#edit-edu-end-year").prop("disabled", false);
                                $("#edit-grade").prop("disabled", false);
                    
                                document.querySelector(".edit-edu-end-date-div").classList.remove("d-none");
                                document.querySelector(".edit-edu-end-date-div").classList.add("d-flex");
                                document.querySelector(".edit-grade-div").classList.remove("d-none");
                                document.querySelector(".edit-grade-div").classList.add("d-flex");
                            }
                        
                        }
                    }
                });
            });
            
        });



        // Now saving the edits made in education
        const edu_edit_btn  =   document.querySelector(".education-edit-btn");
        const edit_edu_form =   document.getElementById("edit-education-form");


        
        edu_edit_btn.addEventListener("click", ()=>
        {
            const form_data =   new FormData(edit_edu_form);

            for (const [key, value] of form_data.entries()) 
            {
                if(value.trim() === "")
                {
                    $.notify("Please fill all fields !", {verticalAlign : "top", align:"right", background: "#ff5555"});
                    return;
                }    
                else if(key === "edit-edu-end-month" || key === "edit-edu-end-year")
                {
                    if($("#edit-edu-end-month").val() < $("#edit-edu-start-month").val() && $("#edit-edu-end-year").val() <= $("#edit-edu-start-year").val())
                    {
                        $.notify("End date can’t be earlier than start date !", {verticalAlign : "top", align:"right", background: "#ff5555"});
                        return;
                    }
                    else if($("#edit-edu-end-year").val() < $("#edit-edu-start-year").val())
                    {
                        $.notify("End date can’t be earlier than start date !", {verticalAlign : "top", align:"right", background: "#ff5555"});
                        return;
                    }
                }
            }

            form_data.append("flag", "edit-education");
            form_data.append("education_id", education_id);
            AjaxCall(form_data);
        })




        // Delete education part
        const edu_basket_icons  =   document.querySelectorAll(".edu-basket-icon");

        edu_basket_icons.forEach(basket =>
        {
            
            basket.addEventListener("click", ()=>
            {
                education_id    =   basket.getAttribute("education-id");
                let flag        =   "delete-education"; 

                Swal.fire({
                    title: "Are you sure?",
                    text: "This education part will permanently be deleted",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) =>
                {
                    if (result.isConfirmed) 
                    {
                        $.ajax(
                        {
                            url         :   "actions/view_profile_action.php",
                            type        :   "post",
                            dataType    :   "json",
                            data        :
                            {
                                education_id    :   education_id,
                                flag            :   flag
                            },
                            success     :   function(response)
                            {
                                if(response.success)
                                {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "This education has been deleted",
                                        icon: "success"
                                    }).then((result)=>
                                    {
                                        if(result.isConfirmed)
                                        {
                                            location.reload();
                                        }
                                    })
                                }
                                else
                                {
                                    $.notify(response.message, {verticalAlign : "top", align:"right", background: "#ff5555"});
                                }
                            }
                        });
                    }

                });
                
            })
        });
//End of domloaded event listener    
});
