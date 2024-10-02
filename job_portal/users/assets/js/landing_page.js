const searchBtn =   document.querySelector(".search-btn");
const keyword   =   document.getElementById("search-input");
const city      =   document.getElementById("city-selector");
const category  =   document.getElementById("category");

searchBtn.addEventListener("click", function()
{
    const keywordValue    =   (keyword.value.trim() !== "")   ?   keyword.value.trim()    :   "";
    const cityValue       =   (city.value !== "")             ?   city.value              :   "";
    const categoryValue   =   (category.value !== "")         ?   category.value          :   "";
    
    
    location.href   =   `./search_page.php?keyword=${keywordValue}&city=${cityValue}&category=${categoryValue}`;
});



const explore_btn   =   document.querySelectorAll(".explore-btn");

explore_btn.forEach(function(explore)
{
    explore.addEventListener("click", function()
    {
        const category_id   =   this.getAttribute("category-id");
        location.href   =   `./search_page.php?keyword=&city=&category=${category_id}`;
    });
});