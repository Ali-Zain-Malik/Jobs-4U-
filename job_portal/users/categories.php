<?php 
include("./config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/header.css">
    <title>Categories</title>
</head>
<style>
    .background-color
    {
        background-color: rgb(235, 235, 229);
    }

    .explore-btn
    {
        margin-top: 8px;
        border: none;
        outline: none;
        border-radius: 6px;
        cursor: pointer;
        background-color: transparent;
        transition: all 0.4s ease;
        color: orange;
    }

    .explore-btn:hover
    {
        text-decoration: underline;
        color: orangered;
    }
</style>

<body style="background-color: rgb(233, 234, 217);">
    <?php include("./header.php"); ?>

    <div class="container-lg py-4 background-color" style="margin-top: 60px; ">
        <h5 class="text-center fw-bold">Categories</h5>
        <div class="flex-wrap d-flex justify-content-evenly mt-4">
            <?php getAllCategories(); ?>
        </div>
    </div>

    <div class="footer-div w-100 bottom-0 background-color">
        <?php include("./footer.html") ?>
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>


<script>

    const explore_btn   =   document.querySelectorAll(".explore-btn");
    explore_btn.forEach(function(explore)
    {
        explore.addEventListener("click", function()
        {
            const category_id   =   this.getAttribute("category-id");
            location.href   =   `./search_page.php?keyword=&city=&category=${category_id}`;
        });
    });
    
</script>
</body>
</html>