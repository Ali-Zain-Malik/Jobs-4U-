// Determining screen width so we can set the limit of cards to display on our landing page. 
document.addEventListener("DOMContentLoaded", ()=>
{
    let screenWidth =   window.screen.width;
    let limit;
    if(screenWidth <= 768)
    {
        limit = 4;
    }
    else 
    {
        limit = 8;
    } 
    
    $.ajax(
    {
        url     :   "actions/sign_in_action.php",
        type    :   "post",
        data    : 
        {
            limit   :   limit
        }
    });
});

const email         =   document.getElementById("email");
const password      =   document.getElementById("password");
const check_box     =   document.getElementById("checkbox");
const signin_form   =   document.getElementById("signin_form");
const loader        =   document.querySelector(".loader");

signin_form.addEventListener("submit", function(event)
{
    event.preventDefault();
    if(validate(email.value, password.value))
    {
        AjaxCall(email.value.trim(), password.value.trim());    
    }
    
    
});



check_box.addEventListener("input", function()
{
    if(check_box.checked)
    {
        password.type   =   "text";
    }
    else
    {
        password.type   =   "password";
    }
});


function validate(email, password)
{
    if(email.trim() === "" || password.trim() === "")
    {
        setError("This field is required");
        return false;
    }
    else if(!(validateEmail(email.trim())))
    {
        $.notify("<p class='text-center m-0'>Invalid Email</p>", {verticalAlign: "top", align: "right", color:"#fff", background: "#ff4d4d"} );
        return false;
    }
    else if(!validatePassword(password.trim()))
    {
        $.notify("<p class='text-center m-0'>Invalid Password</p>", {verticalAlign: "top", align: "right", color:"#fff", background: "#ff4d4d"} );
        return false;
    }

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





function AjaxCall(email, password)
{
    $.ajax(
    {
        url         :   "actions/sign_in_action.php",
        type        :   "post",
        dataType    :   "json",
        timeout     :   10000,
        data        :   
        {
            email       :   email,
            password    :   password
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
                $.notify(`<p class='text-center m-0'>${response.message}</p>`, {verticalAlign: "top", align: "right", color:"#fff", background: "#32cd32"} );
                setTimeout(() => 
                {
                    location.href   =   "./landing_page.php";
                }, 1000);
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