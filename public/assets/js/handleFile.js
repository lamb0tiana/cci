function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

        // Only process image files.
        if (!f.type.match('image.*')) {
            continue;
        }

        var reader = new FileReader();

        // Closure to capture the file information.
        reader.onload = (function(theFile) {
            return function(e) {
                var preview =document.getElementById('img_preview_'+ (i-1));
                var meta = document.getElementById("meta_"+(i-1));
                preview.src=e.target.result
                preview.classList.remove("d-none");
                meta.classList.remove("d-none");

            };
        })(f);

        // Read in the image file as a data URL.
        reader.readAsDataURL(f);
    }
}

$(function(){
    document.getElementById('article_images_0_imageFile_file').addEventListener('change', handleFileSelect, false);

        $("#article_images").on("click",".delete_image_item",function(){
            var index = $(this).data("index");
            $("#img_preview_"+index).attr("src",null).addClass("d-none");
            $("#meta_"+index).addClass("d-none");
            });
})