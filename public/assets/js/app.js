$(function()
{
    $("[data-isotope-nav] ul li").on("click",function(e){
        var description = $(this).find("span.categorie-description").html();
        $("#categorie-description").html(description);
    });
    let wrapper = document.querySelector( ".description_article" );
    let options = {
        // Options go here
        height: 250
    };
    // new Dotdotdot( wrapper, options );
})