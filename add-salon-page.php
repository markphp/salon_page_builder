<?php
/**
* Plugin Name: WP Add Salon/Spa pages
* Plugin URI: https://github.com/markphp
* Description: A simple and easy way to add salon/spa pages in WordPress. A great development tool!
* Author: Mark
* Author URI: mark.org.ua
* Version: 1.5.0
* Text Domain: wp-add-salon-pages
* License: GPLv2
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

//add Button in admin menu
function add_salon_page() {
    add_pages_page( 'Add Salon', 'Add Salon', 'manage_options', 'my-unique-identifier', 'add_salon_page_options' );
}
add_action( 'admin_menu', 'add_salon_page' );


//add media provider
function enqueue_media_uploader()
{
    wp_enqueue_media();
}
add_action("admin_enqueue_scripts", "enqueue_media_uploader");

/**
* add js and css files for admin
*/
function for_admin_enqueue_p() {

    if(get_admin_page_title() == 'Add Salon'){

        wp_enqueue_style( 'style_to_add_page', plugin_dir_url( __FILE__ ) . 'css/style.css', false, '1.0.0' );

        wp_enqueue_script( 'jquery', plugin_dir_url( __FILE__ ) . 'js/jquery.js', array( 'jquery' ),'1.0.0' );
        
        wp_enqueue_script( 'jquery_valid', plugin_dir_url( __FILE__ ) .'js/jquery.valid.min.js' );
        
        wp_enqueue_script( 'script_to_add_page', plugin_dir_url( __FILE__ ) . 'js/script.js', array( 'jquery' ),'1.0.0' );
        
    }

}
add_action( 'admin_enqueue_scripts', 'for_admin_enqueue_p' );

function add_salon_page_options() {
    
	if ( !current_user_can( 'manage_options' ) )  {
	    
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		
	}else{
	    
	    if( isset($_POST['page_heading']) && isset($_POST['text_muted'])){
	    //for Title:
    	    $page_heading = $_POST['page_heading'];
            $text_muted = $_POST['text_muted'];
        //for Description:
            $services = $_POST['services'];
            $address = $_POST['address'];
            $copon = $_POST['copon'];
        //for Slider:
            $images = split(',',$_POST['images']);
        //for Content:
            $text = $_POST['text'];
        //for app Link:
            $ios = get_option('ios_link');
            $adr = get_option('android_link');
        //for Map:
            $map_code= $_POST['map_code'];
            
        //the contant formirating:
            
            $content = '<div class="page-wrapper">
                <div class="container">
                    <div class="row txt-wrapper col-xs-12 col-sm-6 col-md-7">
                        <div class=" title-wrapp">
                            <h2 class="page-heading" style="text-align: left;">'.$page_heading.'</h2>
                            <span class="text-muted cstm" style="text-align: left;">'.$text_muted.'</span>
                        </div>
            
                        <div class="page-description ">
                            <h3 class="section-heading purple " style="text-align: left; font-size: 36px; color: #ca696e;">Services Offered:</h3>
                            <p style="line-height: 24px; margin: 0;">'.$services.'</p>
            
                            <h3 class="section-heading purple " style="text-align: left; font-size: 36px; color: #ca696e;">Address:</h3>
                            <p style="line-height: 24px; margin: 0;">'.$address.'</p>
            
                            <h3 class="section-heading purple " style="text-align: left; font-size: 36px; color: #ca696e;">Coupon:</h3>
                            <p style="line-height: 24px; margin: 0;"><span class="pink">'.substr($page_heading,0,4).$copon.'</span> to get HK$'.$copon.' off any beauty treatment booked at '.$page_heading.' through BloomMe!</p>
                        </div>
            
                    </div>
            
                    <div class="row col-xs-12 col-sm-6 col-md-5 spa-slide-wrp">
            
                        <div id="spa-slide" class="owl-spa-slide">';
            
                            foreach ($images as $image) { 
                                                
            $content .= '<div class="item"><!-- Carusel item --><img class="img-responsive spa-slide-img" src="'.$image.'" alt="" width="400" height="400"/></div>';
                            
                            }
            
            $content .= '</div>
            
                    </div>
                </div>
            </div>
            
            <div class="page-wrapper color-white">
                <div class="container">
                    <div class="row txt-wrapper">
                        <div class="page-description col-xs-12 col-sm-12"><p>'.
                                $text
                        .'</p></div>
                    </div>
                </div>
            </div>
            
            <div class="how-it-works-front slide" id="how-it-works-front">
                <div class="container ">
                	<div class="row block-inner-wrp">
                		<div class="col-xs-12 col-sm-12 col-md-12 title-wrapp">
                			<h2 class="section-heading">How it Works</h2>
                			<span class="text-muted">BloomMe connects you to top spas & salons to ensure you find the right one for you at the right time.</span>
                		</div>
                		<div class="col-xs-12 col-sm-12 col-md-12 showcase-wrapp">
                			<!-- Nav tabs -->
                			<ul class="nav nav-pills nav-justified tabStyle " id="myTabs1">
                				<li class="button secondary url"><a href="#step1" class="st1" style="padding: 1px 20px;min-height:31px;line-height: 31px;"><i class="step-icon"></i><span style="font-size: 13px;">Choose your Category</span></a></li>
                				<li class="button secondary url"><a href="#step2" class="st2" style="padding: 1px 20px;min-height:31px;line-height: 31px;"><i class="step-icon"></i><span style="font-size: 13px;">Select your Spa</span></a></li>
                				<li class="button secondary url"><a href="#step3" class="st3" style="padding: 1px 20px;min-height:31px;line-height: 31px;"><i class="step-icon"></i><span style="font-size: 13px;">Select Time and Date</span></a></li>
                				<li class="button secondary url"><a href="#step4" class="st4" style="padding: 1px 20px;min-height:31px;line-height: 31px;"><i class="step-icon"></i><span style="font-size: 13px;">Confirm / Review</span></a></li>
                			</ul>
                			<div id="myTabs1Content" class="tab-content owl-spa-slide">
                				<div class="tab-pane active " data-hash="step1"><div class="row col-xs-7 col-sm-6 col-md-6 desc-wrp "><div class="row step-text"><div class="row col-xs-12"><span class="ttl" style="font-size: 20px;"><i class="fa fa-check"></i>Pick the category </span></div><p class="col-xs-12 col-sm-12" style="font-size: 15px;line-height: 24px;"> With 9 beauty categories, BloomMe is there for all your beauty and pampering needs! Daily discounts are always on offer to give our BloomMe Girls something to look forward to! </p></div><div class="row step-text"><div class="row col-xs-12"><span class="ttl" style="font-size: 20px;"><i class="fa fa-check"></i>Variety, convenience & discounts </span></div><p class="col-xs-12 col-sm-12" style="font-size: 15px;line-height: 24px;"> Decisions, decisions! With over 200 spas to choose from you’ll find the perfect spot at the right time! </p></div></div><div class="row col-xs-5 col-sm-6 col-md-6 image-wrp"><img class="app-image img-responsive" src="/wp-content/themes/vouchers/img/SP_HiW_step1.png" alt="Generic placeholder image" width="375" height="444" style="width:70%"></div></div>
                				<div class="tab-pane" data-hash="step2"><div class="row col-xs-6 col-sm-6 col-md-6 desc-wrp "><div class="row step-text"><div class="row col-xs-12"><span class="ttl" style="font-size: 20px;"><i class="fa fa-check"></i>Find the spa that fits you</span></div><p class="col-xs-12 col-sm-12" style="font-size: 15px;line-height: 24px;"> Location, location location. Spas & salons are sorted by location and availability to help you find the closest and most convenient places. Real user reviews help with the decision process. </p></div><div class="row step-text"><div class="row col-xs-12"><span class="ttl"style="font-size: 20px;"><i class="fa fa-check"></i>Fully booked Spa? No problem!</span></div><p class="col-xs-12 col-sm-12" style="font-size: 15px;line-height: 24px;"> Spa fully booked? Our "Notify Me" feature allows you to browse the fully booked spa\'s menu and notifies the BloomMe Team to help arrange a booking. </p></div></div><div class="row col-xs-6 col-sm-6 col-md-6 image-wrp"><img class="app-image img-responsive" src="/wp-content/themes/vouchers/img/SP_HiW_step2.png" alt="Generic placeholder image" width="375" height="444" style="width:70%"></div></div>
                				<div class="tab-pane" data-hash="step3"><div class="row col-xs-7 col-sm-6 col-md-6 desc-wrp "><div class="row step-text"><div class="row col-xs-12"><span class="ttl" style="font-size: 20px;"><i class="fa fa-check"></i>Spa Details</span></div><p class="col-xs-12 col-sm-12" style="font-size: 15px;line-height: 24px;"> Get a spa’s essential info quickly & easily including location, interior photos & user reviews </p></div><div class="row step-text"><div class="row col-xs-12"><span class="ttl"style="font-size: 20px;"><i class="fa fa-check"></i>Pick your treatment, date and time</span></div><p class="col-xs-12 col-sm-12" style="font-size: 15px;line-height: 24px;"> Select your treatment and a time that is convenient for you from the selected spa. Discounts will be automatically applied and can be used in conjunction to BloomMe Cash Vouchers! </p></div></div><div class="row col-xs-5 col-sm-6 col-md-6 image-wrp"><img class="app-image img-responsive" src="/wp-content/themes/vouchers/img/SP_HiW_step3.png" alt="Generic placeholder image" width="375" height="444" style="width:70%"></div></div>
                				<div class="tab-pane" data-hash="step4"><div class="row col-xs-7 col-sm-6 col-md-6 desc-wrp "><div class="row step-text"><div class="row col-xs-12"><span class="ttl" style="font-size: 20px;"><i class="fa fa-check"></i>Review your order and pay!</span></div><p class="col-xs-12 col-sm-12" style="font-size: 15px;line-height: 24px;"> Review your order, any discounts will be visably deducted and shown. Payment is quick, easy, effeciant and securely processed via Paypal or credit card. </p></div><div class="row step-text"><div class="row col-xs-12"><span class="ttl"style="font-size: 20px;"><i class="fa fa-check"></i>Leave tips and reviews for other BloomMe Girls!</span></div><p class="col-xs-12 col-sm-12" style="font-size: 15px;line-height: 24px;"> Pampered to perfection? After your treatment, review the spa to help other BloomMe Girls enjoy the experience! </p></div></div><div class="row col-xs-5 col-sm-6 col-md-6 image-wrp"><img class="app-image img-responsive" src="/wp-content/themes/vouchers/img/SP_HiW_step4.png" alt="Generic placeholder image" width="375" height="444" style="width:70%"></div></div>
                			</div>
                		</div>
                	</div>
                	<div class="row txt-wrapper">
                	<div class="col-xs-12 col-sm-5">
                	    <span style="text-align:right; display: block;font-size: 20px;color: #696969;"> Get $'.$copon.' off any booking at '.$page_heading.'!<br>Sing up with BloomMe with Code: </span>
                	</div>
                	
                    <div class="coupon_section col-xs-12 col-sm-3"><span class=" ">'.
                            substr($page_heading,0,4).$copon
                    .'</span></div>
                    
                    <div class="col-xs-12 col-sm-4">
                            <div class="col-xs-6"><a href="https://bnc.lt/Vz5k/s7jvU8u9dt"><img class="img-responsive" src="/wp-content/themes/vouchers/img/app-store-btn.png" alt="" style="max-width:165px;" width="165" height="53"/></a></div>
                            <div class="col-xs-6"><a href="https://bnc.lt/Vz5k/7lt2vIpaet"><img class="img-responsive" src="/wp-content/themes/vouchers/img/play-market-btn.png" alt="" style="max-width:165px;" width="165" height="53"/></a></div>
                    </div>
                    </div>
                </div>
            </div>
                    

            <div class="page-wrapper light-yellow">
                <div class="container">
                    <div class="row txt-wrapper">
                        
                        <div class="">'.
                            $map_code
                        .'</div>
                    </div>
                </div>
            </div>';
            
            //end of content
            
            $post = array(
              'post_author' => $user_ID,
              'post_content' => $content,
              'post_name' =>  $page_heading,
              'post_status' => 'publish',
              'post_title' => $page_heading,
              'post_type' => 'page',
              'post_parent' => 0,
              'menu_order' => 0,
              'to_ping' =>  '',
              'pinged' => '',
            );
            wp_insert_post($post);
        }
        
	echo '<div class="wrap">';
	echo '<H1>Here You can add new Spa/Salon.</h1>';
	echo '</div>';
	
	$form .= '<h1>Add A New Spa/Salon Page</h1>
            <form  method="post" id="add_salon">
            <div class="form-group">
                <label>Tipe Title:<span class="mast_be">*</span></label>
                <span class="example">Example: Ayurveda Day Spa</span>
                <input name="page_heading" type="text" id="page_heading" required>
            </div>
            <div class="form-group">
                <label>Sub Title:<span class="mast_be">*</span></label>
                <span class="example">Example: Instant Bookings Available Through The BloomMe App</span>
                <textarea name="text_muted" type="text" id="text_muted" required></textarea>
            </div>
            <div class="form-group">
                <label>Services:<span class="mast_be">*</span></label>
                <span class="example">Example: Massage, Facial, Manicure, Pedicure, Waxing.</span>
                <input name="services" type="text" id="services" required>
            </div>
            <div class="form-group">
                <label>Address:<span class="mast_be">*</span></label>
                <span class="example">Example: 49 Elgin Street, Soho, Central, Hong Kong.</span>
                <input name="address" type="text" id="address" required>
            </div>
            <div class="form-group">
                <label>Copon value:<span class="mast_be">*</span></label>
                <span class="example">Example: 200</span>
                <input name="copon" type="number" id="copon" required>
            </div>
            <div class="form-group">
                <label>Images for slider(add 2 or more images and size like 450px x 400px):<span class="mast_be">*</span></label>
                <span class="example">Example: /wp-content/themes/vouchers/img/thumbs/ayurveda-spa-02-400x400.jpg,/wp-content/themes/vouchers/img/thumbs/ayurveda-spa-03-400x400.jpg</span>
                <button onClick="JavaScript:open_media_uploader_multiple_images()" id="add_image">Choose images</button>
                <input name="images" type="text" id="images" velue=media_uploader required>
            </div>
            <div class="form-group">
                <label>Text for page:<span class="mast_be">*</span></label>
                <span class="example">Example:Ayurveda – A touch of ancient healing.
				Located in the hectic heart of central, Ayurveda offers you the chance of complete serenity in Soho, located on Elgin Street. Here, you will discover a profound potential for health and well-being offered by a time proven, harmonious, and holistic health....</span>
                <textarea name="text" type="text" id="text" required></textarea>
            </div>
            <div class="form-group">
                <label>Insert generated shortcode forom Google Maps Easy plagins:<span class="mast_be">*</span></label>
                <span class="example">Example: [google_map_easy id="1"]</span>
                <input name="map_code" type="text" id="map_code" required>
            </div>
            <div class="form-group">
                <input type="submit" id="submit" value="Add Page">
            </div>
            </form>';
            
    echo $form;
	}
}

