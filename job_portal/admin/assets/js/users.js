const deleteUsers   =   document.querySelectorAll(".delete");
// const viewUsers     =   document.querySelectorAll(".view");

deleteUsers.forEach(button  =>
    button.addEventListener("click", function()
    {   
        const user_id   =   button.getAttribute("user-id");
        Swal.fire({
            title: "Are you sure to delete this user?",
            showCancelButton: true,
            confirmButtonText: "Confirm",
            confirmButtonColor: "red"
          }).then((result) => {
            if (result.isConfirmed) 
            {
                $.ajax(
                {
                    url         :   "actions/users_action.php",
                    type        :   "post",
                    dataType    :   "json",
                    data        :
                    {
                        user_id :   user_id
                    },
                    success     :   function(response)
                    {
                        if(response.success)
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
                });    
            }
          });
    })
);