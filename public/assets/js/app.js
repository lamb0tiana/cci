$(function()
{
    $("[data-isotope-nav] ul li").on("click",function(e){
        var description = $(this).find("span.categorie-description").html();
        $("#categorie-description").html(description);
    })
})