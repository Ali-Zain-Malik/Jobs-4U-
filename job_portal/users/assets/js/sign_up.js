const loader        =   document.querySelector(".loader");
const sign_up_form  =   document.getElementById("sign-up-form");
const role_selector =   document.getElementById("role");
const emp_company   =   document.querySelector(".emp-company-div");

sign_up_form.addEventListener("submit", (event) =>
{
    event.preventDefault();
    const form  =   new FormData(sign_up_form);
    if(validate(form))
    {
        AjaxCall(form);
    }
    
});


if(role_selector.value == 0)
{
    emp_company.classList.add("d-none");
    emp_company.disabled    =   true;
}
else
{
    emp_company.classList.remove("d-none");
    emp_company.disabled    =   false;
}


role_selector.addEventListener("input", function()
{
    if(this.value == 0)
    {
        emp_company.classList.add("d-none");
        emp_company.disabled    =   true;
    }
    else
    {
        emp_company.classList.remove("d-none");
        emp_company.disabled    =   false;
    }
});

function validate(form)
{
    let passwordValue   =   "";
    for (const [key, value] of form.entries()) 
    {   
        if(value.trim() === "")
        {
            // $.notify("<p class='text-center m-0'>Please fill all fields</p>", {verticalAlign: "top", align: "right", color:"#fff", background: "#ff4d4d"} );
            setError("This field is required !!");
            return false;
        }
        else if(key === "email")
        {
            if(!validateEmail(value))
            {
                $.notify("<p class='text-center m-0'>Invalid Email</p>", {verticalAlign: "top", align: "right", color:"#fff", background: "#ff4d4d"} );
                return false;
            }
        }
        else if(key === "password")
        {
            passwordValue   =   value;
            if(!validatePassword(value))
            {
                $.notify("<p class='text-center m-0'>Invalid Password. Make it strong</p>", {verticalAlign: "top", align: "right", color:"#fff", background: "#ff4d4d"} );
                return false;
            } 
        }
        else if(key === "confirm-password")
        {
            if(passwordValue !== value)
            {
                $.notify("<p class='text-center m-0'>Passwords Donot Match</p>", {verticalAlign: "top", align: "right", color:"#fff", background: "#ff4d4d"} );
                return false;
            }
        }
    }

    // If all the inputs are OK then return true to proceed further
    return true;
}


function validateEmail(email)
{
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
    return emailRegex.test(email);
}

function validatePassword(password)
{
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return passwordRegex.test(password);
}




// This block of code will check if something is entered in the input field or not
// If entered then error message will be removed otherwise displayed again.

const inputs    =   document.querySelectorAll(".input"); // This is not input but input div. 
inputs.forEach(function(input)
{
    let msg         =   input.getElementsByTagName("small")[0]; // Getting the small tag where error message will be displayed
    let inputField  =   input.getElementsByTagName("input")[0]; // Getting the input field itselt inside the div with class input.

    input.addEventListener("input", function()
    {
        if(inputField.value !== "")
        {
            msg.textContent =   "";
            msg.classList.remove("error");
        }
        else
        {
            msg.textContent =   "This field is required !!";
            msg.classList.add("error");
        }
    });
});



function setError(message)
{
    // Calling by tag name. 
    let small = document.querySelectorAll("small");
    small.forEach(msg =>
    {
        msg.innerText   =   message;
        msg.classList.add("error");
    });  
}



function AjaxCall(form)
{
    // Setting flag so that we can check in action file that a request is received.
    form.append("flag", "flag");

    $.ajax(
    {
        url         :   "actions/sign_up_action.php",
        type        :   "post",
        dataType    :   "json",
        data        :   form,
        processData :   false,
        contentType :   false,
        timeout     :   10000,
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
                $.notify(`<p class='text-center m-0'>${response.message}</p>`, {verticalAlign: "top", align: "right", color:"#fff", background: "#32cd32"} );
                setTimeout(() => 
                {
                    location.href   =   "sign_in.html";
                }, 1200);
            }
            else
            {
                $.notify(`<p class='text-center m-0'>${response.message}</p>`, {verticalAlign: "top", align: "right", color:"#fff", background: "#ff4d4d"} );
            }
        },
        error       :   function()
        {
            $.notify(`<p class='text-center m-0'>Something went wrong 🙁</p>`, {verticalAlign: "top", align: "right", color:"#fff", background: "#ff4d4d"} );
        }
    });
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