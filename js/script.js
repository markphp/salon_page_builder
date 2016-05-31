(function($){
    $(document).ready(function(){
        var media_uploader = null;
        //var result = null;
        jQuery("input").click(function(){
            jQuery(".form-active").removeClass("form-active");
            jQuery(this).parent().addClass("form-active");
        });
        jQuery("textarea").click(function(){
            jQuery(".form-active").removeClass("form-active");
            jQuery(this).parent().addClass("form-active");
        });
        
    });
})(jQuery)

function open_media_uploader_multiple_images()
        {
            media_uploader = wp.media({
                frame:    "post", 
                state:    "insert", 
                multiple: true 
            });
        
            media_uploader.on("insert", function(){
        
                var attachment = media_uploader.state().get("selection").toJSON();
                images.value="";
                //console.log(attachment[0].height);
                
                    for(var i = 0; i < attachment.length; i++)
                    {
                        if(attachment[i].height < 99 || attachment[i].height > 801 || attachment[i].width < 99 || attachment[i].width > 801 ){
                            images.value="";
                            alert("Image size is not correct!");
                            break;
                        }else{
                            var image_url = attachment[i].url;
                            var image_caption = attachment[i].caption;
                            var image_title = attachment[i].title;
                            if(i < attachment.length-1){
                                images.value += image_url+",";
                            }else{
                                images.value += image_url;
                            }
                        }
                    }
                
                //console.log(result);
                //images.velue
            });
        
            media_uploader.open();
            
        }