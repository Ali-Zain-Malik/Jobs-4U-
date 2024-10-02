const email         =   document.getElementById("email");
const password      =   document.getElementById("password");
const login_btn     =   document.querySelector(".login-submit-btn");
const form          = document.getElementById("login-form");

login_btn.addEventListener("click",()=>
{
    loginAction();
});

form.addEventListener("keydown", (event)=>
{
    if(event.key === "Enter")
    {
        loginAction();
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



function loginAction()
{
    if(email.value === "" || password.value === "")
    {
        $.notify("Please fill out both fields", {align:"right", verticalAlign:"middle", background: "#da706a"});
    }
    else if(!(is_validEmail(email.value)))
    {
        $.notify("Invalid Email !", {align:"right", verticalAlign:"middle", background: "#da706a"});
    }
    else if(!(is_validPassword(password.value)))
    {
        $.notify("Invalid Password !", {align:"right", verticalAlign:"middle", background: "#da706a"});
    }  
    else
    {
        $.ajax(
        {
            url: "actions/login_action.php",
            type: "post",
            dataType: "json",
            data: 
            {
                email       :   email.value,
                password    :   password.value
            },
            success:function(response)
            {
                if(response)                
                {
                    $.notify("Logging you in", {verticalAlign: "middle", align: "right", color:"fff", background: "#20d67b"} );
                    setTimeout(() => 
                    {
                        location.href   =   "./index.php";
                    }, 1000);

                    /* After user has logged in successfully, clearing the email and password 
                    values, so that if user moves back the fields are empty. */ 
                    email.value = null;
                    password.value = null;
                }
                else
                {
                    $.notify("Incorrect Email or Password", {align:"right", verticalAlign:"middle", background: "#da706a"});
                }
            }
        }); // Ajax ending here
    }
}