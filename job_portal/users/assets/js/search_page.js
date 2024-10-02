/*
This block of code has two parts. The first one gets the attribute data-job-title from the apply buttons in the page
and the second one gets the attribute from the view buttons. This then title will be used to display on the modal header where
user will be applying for the job. 

View button is used here because only apply button was not enough. Though it worked fine for the apply buttons but when the 
user clicks on the view button and then from this pop up he clicks apply button there appeared bugs. If view button was clicked 
first then the modal header was blank and if apply button first then each modal header appeared same on clicking view. 
*/

// const description = document.getElementById("floatingTextarea");

// const applyButtons = document.querySelectorAll('.apply-btn');
// // Add click event listener to each apply button
// applyButtons.forEach(button => 
// {
//   button.addEventListener('click', function() 
//   {
//     // Get the job title from the data attribute
//     var jobTitle = this.getAttribute('data-job-title');
//     // Update the modal title
//     var modalTitle = document.getElementById('staticBackdropLabel');
//     modalTitle.textContent = `Applying for ${jobTitle}`;

//     // Making Description text area empty when ever user clicks button for any other job.
//     if(description.value !== "")
//     {
//       description.value = null;
//     }

//   });
// });

// // Getting all view buttons 
// const viewButtons = document.querySelectorAll(".view-btn");
// viewButtons.forEach(button =>
// {
//   button.addEventListener("click", function()
//   {
//     var jobTitle = this.getAttribute('data-job-title');
//     var modalTitle = document.getElementById("staticBackdropLabel");
//     modalTitle.textContent = `Applying for ${jobTitle}`;


//     // Making Description text area empty when ever user clicks button for any other job.
//     if(description.value !== "")
//     {
//       description.value = null;
//     }


//   })
// });





const loader    = document.querySelector(".loader");

const keywords  = document.getElementById("search-input");
const city      = document.getElementById("city-selector");
const category  = document.getElementById("category");

const searchBtn = document.querySelector(".search-btn");
searchBtn.addEventListener("click", ()=>
{
  AjaxCall(keywords.value.trim(), city.value, category.value);
})

// This method is used to get the params from the query string.
const params          = new URLSearchParams(window.location.search);
const param_city      = params.get("city");
const param_keyword   = params.get("keyword");
const param_category  = params.get("category");

$(document).ready(function()
{
  AjaxCall(param_keyword, param_city, param_category);
  keywords.value  = param_keyword;
  city.value      = param_city;
  category.value  = param_category;
});




function AjaxCall(keyword, city, category)
{
  $.ajax(
  {
    url       : "actions/search_page_action.php",
    type      : "get",
    dataType  : "html",
    timeout   : 10000,
    data      : 
    {
      keyword   : keyword,
      city      : city,
      category  : category
    }, 
    beforeSend  : function()
    {
      addLoader();
    },
    complete    : function()
    {
      removeLoader();
    },
    success   : function(response)
    {
      $(".column1").html(response);
      params.set("keyword", keyword);
      params.set("city", city);
      params.set("category", category);


      const newUrl = `${window.location.pathname}?${params.toString()}`;
      window.history.replaceState(null, '', newUrl);
      
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