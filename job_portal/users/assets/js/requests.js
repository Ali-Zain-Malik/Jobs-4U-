const heading = document.querySelector(".heading");
const jobTitle = sessionStorage.getItem("job-title");

if(jobTitle)
{
    heading.textContent = `Applicants for ${jobTitle}`;
    sessionStorage.clear("job-title");
}
