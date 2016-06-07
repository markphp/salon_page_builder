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
        
        $('.search_in').bind('input propertychange',function(){
    		setTimeout(function() {
    		    
    			get_all();
    			
    		}, 1000);
    	});
	    
	    $('#url_edit').click(function(){
	        $('#page_url').removeAttr('readonly').attr('required');
	    });
	    
	    $('.dashicons-trash').click(function(){
	        var page_id = $('#page_id').val();
	        var id = $('#ID').val();
	        //console.log(page_id);
	        //console.log(id);
	        alert('You want del page!');
	        //del_page(page_id,id);
	    });
	    
	    $('.dashicons-external').click(function(){
	        window.location='/'+$('#page_url').val();
	    });
    });	 
    get_all();
	
})(jQuery)

function start_new(){
    
    jQuery('#add_salon').fadeIn();
    jQuery('.edit_page_url').fadeOut();
    
    
    
    jQuery('#ID').val('');
    jQuery('.edit_page_url').val('');
    jQuery('#page_id').val('');
    jQuery('#page_heading').val('');
    jQuery('#address').val('');
    jQuery('#copon').val('');
    jQuery('#images').val('');
    jQuery('#map_code').val('');
    jQuery('#services').val('');
    jQuery('#text').val('');
    jQuery('#text_muted').val('');
    
    jQuery('#action_button').html('<input type="submit" id="submit" value="Add Page">');
}

function open_media_uploader_multiple_images(){
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
                
                    var image_url = attachment[i].url;
                    var image_caption = attachment[i].caption;
                    var image_title = attachment[i].title;
                    if(i < attachment.length-1){
                        images.value += image_url+",";
                    }else{
                        images.value += image_url;
                    }
                
            }
        
        //console.log(result);
        //images.velue
    });

    media_uploader.open();
    
}

function get_all(){
    
    var msg = jQuery("#form").serialize();
	jQuery.ajax({
		type: "POST",
		url: '/wp-content/plugins/salon_page_builder/inc/get_all.php',
		data: msg,
		/*beforeSend: function( xhr){
			add_load();
		},*/
		success: function(data) {

			jQuery("#postbyedit").html(data);
			//alert(data);

		},
		error:  function(xhr, str){
			alert("Error!");
			jQuery('.load').remove();
		}
	});

}

function get_row(id,t_name){ //Ajax

	var msg = jQuery("#form").serialize();
	jQuery.ajax({
		type: "POST",
		url: '/wp-content/plugins/salon_page_builder/inc/get_row.php',
		data: msg,
		success: function(data) {

			var jsonObj = jQuery.parseJSON('[' + data + ']');
			//console.log(jsonObj);
			if( jsonObj != null){
			    jQuery('#ID').val(jsonObj[0].ID);
			    jQuery('#page_id').val(jsonObj[0].page_id);
			    jQuery('#page_heading').val(jsonObj[0].page_heading);
			    jQuery('#page_url').val(jsonObj[0].page_url);
			    jQuery('#address').val(jsonObj[0].address);
			    jQuery('#copon').val(jsonObj[0].copon);
			    jQuery('#images').val(jsonObj[0].images);
			    jQuery('#map_code').val(jsonObj[0].map_code);
			    jQuery('#services').val(jsonObj[0].services);
			    jQuery('#text').val(jsonObj[0].text);
			    jQuery('#text_muted').val(jsonObj[0].text_muted);
			    
			    jQuery('#action_button').html('<input type="button" id="update" value="Update" onclick="update_page()">');
			    
			    jQuery('.edit_page_url').fadeIn();
                jQuery('#add_salon').fadeIn();
                jQuery('.dashicons-external').fadeIn();
                jQuery('.dashicons-trash').fadeIn();
			}
			

		},
		error:  function(xhr, str){
			alert("Error!");
			
		}
	});

}

function update_page(){
var msg = jQuery("#add_salon").serialize();
	jQuery.ajax({
		type: "POST",
		url: '/wp-content/plugins/salon_page_builder/inc/update_page.php',
		data: msg,
		success: function(data) {

			
			var ansver = data;
			if(ansver == "11"){
			    alert("All new data insert and update!");
			    
			    /*jQuery('#ID').val(0);
			    jQuery('#page_id').val(0);
			    jQuery('#page_heading').val('');
			    jQuery('#address').val('');
			    jQuery('#copon').val(0);
			    jQuery('#images').val('');
			    jQuery('#map_code').val('');
			    jQuery('#services').val('');
			    jQuery('#text').val('');
			    jQuery('#text_muted').val('');*/
			    
			    location.reload();
			}
			if(ansver == "00"){
			    alert("Nothing changed!");
			}
			if(ansver == "01"){
			    alert("Changed only local data! The page didn't chang!");
			    location.reload();
			}
			if(ansver == "10"){
			     alert("Changed only page! The local data didn't chang!");
			     location.reload();
			}

		},
		error:  function(xhr, str){
			alert("Error!");
			
		}
	});
}

function all_update(){
    var msg = {'key':'true'};
    jQuery.ajax({
		type: "POST",
		url: '/wp-content/plugins/salon_page_builder/inc/all_update.php',
		data: msg,
		success: function(data) {
			var ansver = data;
			//jQuery('.debug').html(data);
			if(ansver == "1"){
			    alert("All new data insert and update!");
			    
			    location.reload();
			}

		},
		error:  function(xhr, str){
			alert("Error!");
			
		}
	});
}

function del_page(page_id,id){
    var msg = {'page_id':page_id,'ID':id};
    jQuery.ajax({
		type: "POST",
		url: '/wp-content/plugins/salon_page_builder/inc/del_page.php',
		data: msg,
		success: function(data) {
			var ansver = data;
			//jQuery('.debug').html(data);
			if(ansver == "da"){
			    alert("The page was removed!");		    
			    location.reload();
			}
			

		},
		error:  function(xhr, str){
			alert("Error!");
			
		}
	});
}