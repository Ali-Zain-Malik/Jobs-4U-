document.addEventListener("DOMContentLoaded", ()=>
{
    const skill_input       =   document.getElementById("skill-input");
    const active            =   document.getElementById("active");
    const deactive          =   document.getElementById("deactive");
    const edits_save_btn    =   document.getElementById("edits-save-btn");
    const add_skill_btn     =   document.getElementById("add-skill-btn");
    const add_skill         =   document.getElementById("add-skill");
    
    const edit_skill        =   document.querySelectorAll(".edit-skill");
    const delete_skill      =   document.querySelectorAll(".delete-skill");
    
    var flag                =   "";
    var skill_id            =   null;
    

    edit_skill.forEach(button =>
    {
        button.addEventListener("click",()=>
        {   
            skill_id    =   button.getAttribute("skill-id");
            flag            =   "view";
            AjaxCall(skill_id, flag);
        })
    });
    
    
    
    edits_save_btn.addEventListener("click", ()=>
    {
        /* Setting flag to edit here is because when the user clicks on the save button the 
        flag is changed to save and if the user has entered the same skill which already exist
        in the database then the modal remains there. And now the save button will not work because
        the flag is save now and if condition will fail. So just for this.   */
        if(flag == "save")
        {
            flag = "view";
        }
        if(skill_id && flag == "view")
        {
            flag    =   "save";
            AjaxCall(skill_id, flag);
        }
    });
    
    
    
    delete_skill.forEach(button =>
    {
        button.addEventListener("click", ()=>
        {
            skill_id    =   button.getAttribute("skill-id");
            flag            =   "delete";
    
            Swal.fire({
                title: "Are you sure?",
                text: "This skill will permanently be deleted",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
              }).then((result) => {
                if (result.isConfirmed) 
                {
                    AjaxCall(skill_id, flag); 
                }
              });
    
        })
    });
    
    
    

    function getRadioValue(radio) 
    {
        const radios = document.getElementsByName(radio);
        for (const radio of radios) 
        {
            if (radio.checked)
            {
                return radio.value;
            }
        }
    }
          
    
    
    
    function AjaxCall(skill_id, flag)
    {
        $.ajax(
        {
            url         :   "actions/skills_action.php",
            type        :   "post",
            dataType    :   "json",
            data        :   
            {
                skill_id    :   skill_id,
                flag        :   flag,
                status      :   getRadioValue("radio"),
                skill_input :   skill_input.value.trim().toLowerCase()
            },
            success         :   function(response)
            {
                if(response.success && response.edit)
                {
                    skill_input.value   =   response.skill;
                    if(response.status == 1)
                    {
                        active.checked  =   true;
                    }
                    else
                    {
                        deactive.checked    =   true;
                    }
                }
                else if(response.success && response.save)
                {
                    $.notify(response.message, {verticalAlign: "top", align: "right", color:"fff", background: "#20d67b"} );
                    setTimeout(() => 
                    {
                        location.reload();
                    }, 1200);
                }
                else if(response.success && response.delete)
                {
                    Swal.fire({
                        title: response.message,
                        text: "This skill has been deleted",
                        icon: "success"
                    }).then((result)=>
                    {
                        if(result.isConfirmed)
                        {
                            location.reload();
                        }
                    })
                }
                else if(!response.success)
                {
                    $.notify(response.message, {verticalAlign: "top", align: "right", color:"fff", background: "#ff4d4d"} );
                }
            }
        });
    }
    

    
    skill_input.addEventListener("input", ()=>
    {
        if(skill_input.value.trim() === "")
        {
            edits_save_btn.disabled =   true;
        }
        else
        {
            edits_save_btn.disabled =   false;;
        }
    });



    if($("#new-skill").val() == "")
    {
        add_skill_btn.disabled  = true;
    }

    $("#new-skill").on("input", function()
    {
        if($("#new-skill").val() == "")
        {
            add_skill_btn.disabled  =   true;
        }
        else
        {
            add_skill_btn.disabled  =   false;
        }
    })



add_skill_btn.addEventListener("click",()=>
{
    flag = "add_skill";
    $.ajax(
    {
        url         :   "actions/skills_action.php",
        type        :   "post",
        dataType    :   "json",
        data        :   
        {
            skill_name  :   $("#new-skill").val().toLowerCase(),
            status      :   getRadioValue("radio2"),
            flag        :   flag
        },
        success         :   function(response)
        {
            if(response.save && response.success)
            {
                $.notify(response.message, {verticalAlign: "top", align: "right", color:"fff", background: "#20d67b"} );

                setTimeout(() => 
                {
                    location.reload();
                }, 1200);
            }
            else if(!response.success)
            {
                $.notify(response.message, {verticalAlign: "top", align: "right", color:"fff", background: "#ff4d4d"} );
            }
        }
    });
})
 
});