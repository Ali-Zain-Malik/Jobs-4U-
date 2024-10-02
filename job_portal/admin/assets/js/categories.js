const edit_category_form    =   document.getElementById("edit-category-form");
const edits_save_btn        =   document.getElementById("edits-save-btn");
const category_input        =   document.getElementById("category-input");

const edit_buttons          =   document.querySelectorAll(".edit-category");
const delete_buttons        =   document.querySelectorAll(".delete-category");

const add_category_form     =   document.getElementById("add-category-form");
const add_category_btn      =   document.getElementById("add-category-btn");


var  flag                   =   "";
var category_id             =   null;

category_input.addEventListener("input",()=>
{
    if(category_input.value.trim() === "")
    {
        edits_save_btn.disabled = true;
    }
    else 
    {
        edits_save_btn.disabled = false;
    }
})


edit_category_form.addEventListener("submit",(event)=>
{
    event.preventDefault();
    const form_data     =   new FormData(edit_category_form);
    flag                =   "edit";

    form_data.append("flag", flag);
    form_data.append("category_id", category_id);

    AjaxCall(form_data);
    
});



edit_buttons.forEach(edit_btn =>
{
    edit_btn.addEventListener("click",()=>
    {
        category_id =   edit_btn.getAttribute("category-id");
        flag            =   "view"
        AjaxCall(category_id, flag);
    })
});



delete_buttons.forEach(delete_btn =>
{
    delete_btn.addEventListener("click",()=>
    {
        category_id =   delete_btn.getAttribute("category-id");
        flag            =   "delete";

        Swal.fire({
            title: "Are you sure?",
            text: "This category will permanently be deleted",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) 
            {
                AjaxCall(category_id, flag);
            }
          });

        
    })
});


// Disabling the save button if the input field is empty. 
if($("#new-category").val() == "")
{
    add_category_btn.disabled = true;
}

$("#new-category").on("input",()=>
{
    if($("#new-category").val().trim() === "")
    {
        add_category_btn.disabled = true;
    }
    else 
    {
        add_category_btn.disabled = false;
    }
})

add_category_form.addEventListener("submit",(event)=>
{
    event.preventDefault();
})


add_category_btn.addEventListener("click", ()=>
{
    // event.preventDefault();

    const form_data     =   new FormData(add_category_form);
    flag                =   "add";

    form_data.append("flag", flag);
    AjaxCall(form_data);
});




function AjaxCall(data, flag)
{
    if(data instanceof FormData)
    {
        $.ajax(
        {
            url         :   "actions/categories_action.php",
            type        :   "post",
            dataType    :   "json",
            data        :   data,
            processData :   false,
            contentType :   false,
            timeout     :   10000,
            beforeSend  :   function()
            {
                $(".loader").show();
            },
            success     :   function(response)
            {
                if(response.edit)
                {
                    if(response.success)
                    {
                        $.notify(response.message, {verticalAlign: "top", align: "right", color:"fff", background: "#20d67b"} );
                        setTimeout(() => 
                        {
                            location.reload();
                        }, 1200);
                    }
                    else
                    {
                        $.notify(response.message, {verticalAlign: "top", align: "right", color:"fff", background: "#ff4d4d"} );
                    }
                }
                else if(response.add)
                {
                    if(response.success)
                    {
                        $.notify(response.message, {verticalAlign: "top", align: "right", color:"fff", background: "#20d67b"} );
                        setTimeout(() => 
                        {
                            location.reload();
                        }, 1200);
                    }
                    else
                    {
                        $.notify(response.message, {verticalAlign: "top", align: "right", color:"fff", background: "#ff4d4d"} );
                    }
                }
            },
            complete    :   function()
            {
                $(".loader").hide();
            }
        });
    }
    else
    {
        $.ajax(
        {
            url         :   "actions/categories_action.php",
            type        :   "post",
            dataType    :   "json",
            data        :   
            {
                category_id :   data, // Here the data is category id.
                flag        :   flag
            },
            timeout         :   10000,
            beforeSend      :   function()
            {
                $(".loader").show();
            },
            success         :   function(response)
            {
                if(response.view && response.success)
                {
                    category_input.value    =   response.category_name;
                    if(response.status == 1)
                    {
                        $("#active").prop("checked", true); // Checking the active radio button which shows that the category is visible
                    }
                    else
                    {
                        $("#deactive").prop("checked", true);
                    }
                }
                else if(response.delete)
                {
                    if(response.success)
                    {
                        Swal.fire({
                            title: response.message,
                            text: "This category has been deleted",
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
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: response.message
                        });                    
                    }
                }
            },
            complete        :   function()
            {
                $(".loader").hide();
            }

        });
    }


}