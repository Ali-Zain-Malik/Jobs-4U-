const add_new_user_form = document.getElementById("add-new-user-form");

add_new_user_form.addEventListener("submit", (event) => {
    event.preventDefault();
    const form_data         =   new FormData(add_new_user_form);
    if(validations(form_data))
    {
        AjaxCall(form_data);
    }

});





function is_validEmail(emailInput) 
{
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
    return emailRegex.test(emailInput);
}


function is_validPassword(passwordInput)
{
    const Passwordregex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return Passwordregex.test(passwordInput)
}


function validations(form_data)
{
    const email             =   form_data.get("email");
    const name              =   form_data.get("name");
    const password          =   form_data.get("password");
    const confirmPassword   =   form_data.get("confirm-password");

    // Helper function for displaying notifications
    const notify = (message) => 
    {
        $.notify(message, { align: "right", verticalAlign: "top", background: "#da706a" });
    };

    // Validate all fields are not empty
    for (const value of form_data.values()) 
    {
        if (value.trim() === "") 
        {
            notify("All fields must be filled!");
            return false;
        }
    }

    // Validate email format
    if (!is_validEmail(email)) 
    {
        notify("Invalid Email Format!");
        return false;
    }

    if(name.trim().length <= 2)
    {
        notify("Invalid Name");
        return false;
    }

    // Validate password format
    if (!is_validPassword(password)) 
    {
        notify("Invalid Password Format!");
        return false;
    }

    // Validate passwords match
    if (password !== confirmPassword) 
    {
        notify("Passwords do not match!");
        return false;
    }

// If all the validations have passed then return true so we can proceed further.
return true;
}


// Function which will create an ajax call each time a request is received or sent.
function AjaxCall(form_data)
{
    $.ajax(
    {
        url         :   "actions/add_user_action.php",
        type        :   "post",
        dataType    :   "json",
        data        :   form_data,
        processData :   false, 
        contentType :   false,
        success     :   function(response)
        {
            if(response.success)
            {
                $.notify(response.message, { align: "right", verticalAlign: "top", background: "#20d67b" });
                setTimeout(() => 
                {
                    window.location.href    =   "./users.php";
                }, 1200);
            }
            else
            {
                $.notify(response.message, { align: "right", verticalAlign: "top", background: "#da706a" });
            }
        }
    });
}


$('#role').select2({
    width: "100%"
});

// Hide and undhide password.
const eyes   =   document.querySelectorAll(".eye");
eyes.forEach(eye =>
{
    eye.addEventListener("click", ()=>
    {
        const targetInput = document.querySelector(eye.getAttribute("data-target"));
        
        if (targetInput) 
        {
            eye.classList.toggle("ri-eye-off-fill");
            const currentType = targetInput.getAttribute("type");
            targetInput.setAttribute("type", currentType === "password" ? "text" : "password");
        }
    })
});