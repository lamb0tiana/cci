$(function()
{
    $("[data-isotope-nav] ul li").on("click",function(e){
        var description = $(this).find("span.categorie-description").html();
        $("#categorie-description").html(description);
    });

    var scrolling = false;
    $(window).on("scroll", function() {
        var scrollHeight = $(document).height();
        var scrollPosition = $(window).height() + $(window).scrollTop();
        if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
            // when scroll to bottom of the page
            if(scrolling) return false;
            scrolling = true;
            $.get(Routing.generate("content_categorie")).then(function(d){
               $("#isotope").append(d);
               scrolling = !scrolling;
            });
        }
    });
})