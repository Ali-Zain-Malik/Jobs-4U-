const find_jobs_link    =   document.querySelectorAll(".find-jobs");

find_jobs_link.forEach(function(link)
{
    link.addEventListener("click", function()
    {
        location.href   =   "./search_page.php?keyword=&city=&category=";
    });
})