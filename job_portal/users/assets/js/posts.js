const buttons = document.querySelectorAll(".action-btns");

buttons.forEach(button =>
    button.addEventListener("click", function()
    {
        var jobTitle = this.getAttribute("job-title");
        console.log(jobTitle);
        sessionStorage.setItem("job-title", jobTitle);
    })
);