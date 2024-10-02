const viewFeedback      =   document.querySelectorAll(".view");
const deleteFeedback    =   document.querySelectorAll(".delete");
const displayFeedback   =   document.querySelectorAll(".display-toggle-btn");

// When the user wants to view the comment of feedback. Only user id is passed.
viewFeedback.forEach(button =>
{
    button.addEventListener("click", function()
    {
        const user_id   =   button.getAttribute("user-id");
        $.ajax(
        {
            url         :   "actions/feedbacks_inner_action.php",
            type        :   "post",
            dataType    :   "json",
            data        :
            {
                user_id         :   user_id,
                viewFeedback    :   true
            },
            success     :   function(response) 
            {
               if(response.status) 
               {
                    Swal.fire({
                        text: response.feedback,
                      });
               }
            }
        })
        
    })
});



// When the user want to delete a particular feedback. Alongside user id deletefeedback is also passed which will 
// indicate that user is asking to delete. 
deleteFeedback.forEach(button =>
{
    button.addEventListener("click", function()
    {
        const user_id   =   button.getAttribute("user-id");
        Swal.fire({
            title: "Are you sure?",
            text: "This feedback will permanently be deleted",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if(result.isConfirmed)
            {
                $.ajax(
                {
                    url         :   "actions/feedbacks_inner_action.php",
                    type        :   "post",
                    dataType    :   "json",
                    data        :
                    {
                        user_id         :   user_id,
                        deleteFeedback  :   true
                    },
                    success     :   function(response) 
                    {
                        if(response.status)
                        {
                            Swal.fire(response.message, "", "success").then(()=>
                            {
                                location.reload();
                            })
                        }
                        else
                        {
                            Swal.fire(response.message, "", "error");
                        }
                    }
                })
            }
            
            })
        
        
    })
});



// When the user either wants to display or stop displaying a feedback on landing page.
displayFeedback.forEach(button =>
{
    button.addEventListener("click", function()
    {
        const user_id   =   button.getAttribute("user-id");
        
            $.ajax(
            {
                url         :   "actions/feedbacks_inner_action.php",
                type        :   "post",
                dataType    :   "json",
                data        :
                {
                    user_id                 :   user_id,
                    toggleFeedbackDisplay   :   true
                },
                success     :   function(response)
                {
                    if(response.status)
                    {
                        $.notify(response.message, {verticalAlign: "top", align: "right", background: "#3b9bf1"});
                    }
                }
            }) 
        
    })
});