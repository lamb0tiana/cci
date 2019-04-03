$(function()
{
    $a = $("<a>");
    $a.text("Lire la suite...");
    $a.css("position","absolute");
    $(".description_article").each(function()
    {
        $a = $("<a>");
        $a.attr("href","dev");
        $a.text("Lire la suite...");
        $a.css("position","absolute");
        var position = $(this).offset();
        position.left = 0 ;
        $a.offset(position);
        $(this).append($a);
        $
    })
})