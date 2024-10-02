const adminBtn = document.getElementById("admin-btn");
const applicantBtn = document.getElementById("applicant-btn");
const heading = document.getElementById("h3");
const optionsContainer = document.querySelector(".options");

let adminClickCount = 0; // Track admin button click count
let applicantClickCount = 0; // Track applicant button click count

/* Function to handle panel state change and create "Go Back" button
This will also help to store the role in session as employer or an applicant which will be 
later accessed by signup.js file inorder to findout that whether the user is employer or applicant. */
function switchPanel(panelName) 
{
    adminBtn.textContent = "Sign Up"; // Content of buttons will be changed dynamically
    applicantBtn.textContent = "Sign In";
    heading.textContent = panelName;
    sessionStorage.setItem("role", panelName); // Save the panel state

    /* When the user has clicked to be an applicant or employer then a back div is created first
    in the options class in index.html and then in that back div a back button is created. On clicking
    that back button session value will be destroyed and hence the user will be able to see the default 
    values set in the employer button and applicant button. This will act as a go back button. 
     */
    const back = document.createElement("div");
    back.classList.add("job-seek");
    optionsContainer.appendChild(back);

    const backBtn = document.createElement("button");
    backBtn.textContent = "Go Back";
    backBtn.classList.add("back");
    back.appendChild(backBtn);

    backBtn.addEventListener("click", () => 
    {
        sessionStorage.removeItem("role");
        location.reload(true); // After clicking button will be deleted and page will be refreshed to view changes.
    });
}

/* Here we will create a variable through which we will check that whether there is any 
value stored in session storage or not. If it is then the changes made in buttons contents
will not be able to undo on refresh. They will only me made if user clicks go back and hence
session will be removed so the changes will be undone. */
const savedPanel = sessionStorage.getItem("role");
if (savedPanel) 
{
    switchPanel(savedPanel);
}

/* Here we will check if the user is clicking the buttons first time or second time. Because when the 
user is clicking buttons for the first time we want only the text content to be updated. When the text is 
updated and user is seeing sign up and sign in, now we want user to be redirected to these pages so we
will increement the counter which will move it to else part and hence sign up or sign in page will be opened.
 */
adminBtn.addEventListener("click", () => 
{
    if(adminClickCount === 0)
    {
        switchPanel("Employer Panel");
        adminClickCount++;
        applicantClickCount++;
    }
    else
    {
        window.location.href = "sign_up.html";
    }
});

applicantBtn.addEventListener("click", () => 
{
    if(applicantClickCount === 0)
    {
        switchPanel("Applicant Panel");
        applicantClickCount++;
        adminClickCount++;
    }
    else
    {
        window.location.href = "sign_in.html";
    }
});