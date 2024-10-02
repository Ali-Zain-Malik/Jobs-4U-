// Using select 2 library initializers here. 
$(".simple-select").select2()

$(".major").select2(
{
    tags: true,
    placeholder: "Major" 
});


$(".currency").select2(
{
    placeholder: "Currency" 
});



$(".skills").select2(
{
    tags: true,
    placeholder: "Friendly, Javascript ..."
});


// Setting the date to the current date. So that user cannot select date from past while posting a job.
const today = new Date().toISOString().slice(0, 10);
const start_date = document.getElementById("start-date");
const end_date = document.getElementById("end-date");

start_date.setAttribute("min", today); 
end_date.disabled = true; // end date will remain disable until the user select start date.

start_date.addEventListener("change", ()=>
{
    end_date.disabled = false; // After selecting start date end date will be enabled.
    
    // Checking if the user has entered the end date which will come first than the start date. 
    // This can happen if the user has selected the start date and end date first and then he 
    // changed the start date again. 
    if (Date.parse(end_date.getAttribute("min")) < Date.parse(start_date.value)) 
    {
        end_date.value = null;
    }
    
    // keeping the value of end date equal to start date so that the user cannot select end date from past. 
    end_date.setAttribute("min", start_date.value);
});