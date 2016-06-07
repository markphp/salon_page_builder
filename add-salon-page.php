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

/**
*install function
*/

//echo get_client_ip(); 
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


//add Button in admin menu
function add_salon_page() {
    add_pages_page( 'Add Salon', 'Add Salon', 'manage_options', 'add-salon', 'add_salon_page_options' );
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

/**
* add core files
*/
require_once realpath(__DIR__) . "/inc/db_manager.php";
require_once realpath(__DIR__) . "/inc/salonSpa-page-content.php";



function add_salon_page_options() {
    create_table ("add_salon_page");
    
    if ( /*!current_user_can('edit_post' 'manage_options' )*/ false )  {
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
            
            $content = add_salon_page_cont($_POST);
            
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
            
            /**
             *Save data in DB 
             */
            global $wpdb;
            
            $response = $wpdb->get_results("SELECT ID,post_name FROM $wpdb->posts WHERE post_type='page' AND post_status='publish' AND post_title='".$page_heading."'");
            
            $page_id = $response[0]->ID;
            $post_url = $response[0]->post_name;
            
            $value = array(
                'page_heading'  => $page_heading,
        	  	'text_muted'    => $text_muted,
        	  	'services'      => $services,
        	  	'address'       => $address,
        	  	'copon'         => $copon,
        	  	'images'        => $_POST['images'],
        	  	'text'          => $text,
        	  	'map_code'      => $map_code,
        	  	'page_id'       => $page_id,
        	  	'page_url'      => $post_url,
        	  	'last_modif'    => date("F j, Y, g:i a"),
        	  	'client_ip'     => get_client_ip()
                );
            add_row("add_salon_page",$value);
        } ?>
        
<div class="wrap main_container">
    <div class="top_section">    
        <div>
            <h1>Here You can add new Spa/Salon.</h1>
            <h2>Add A New Spa/Salon Page</h2>
        </div>
        
      
        <div class="main_actions">
            <span class="button page-title-action" onclick="start_new()">Add New</span>
            <div class="search">
            
            <form id="form" method="post" action="javascript:void(0);" onsubmit="get_row()">
            
                <span>Select:</span><select size="1" name="editpost" id="postbyedit"> </select>
                
                <span>OR:</span><input type="text" name="search_in" class="search_in" value="" placeholder="Search" spellcheck="true"/>
                
                <input type="submit" name="send" class="button button-primary send" value="EDIT">
                <span class="dashicons dashicons-undo" onclick="location.reload();" title="Reset"></span>
                <span class="dashicons dashicons-external" style="display:none" title="Go on page"></span>
                <span class="dashicons dashicons-trash" style="display:none" title="Delet the page!"></span>
                <span class="dashicons dashicons-update" title="All update" onclick="all_update()"></span>
                

            </form>
            
            </div>
        </div>
    </div>
    
    <form  method="post" id="add_salon">           
            <input name="ID" type="nomber" id="ID" value="" hidden >
            <input name="page_id" type="nomber" id="page_id" value="" hidden >
        <div class="form-group">
            <label>Tipe Title:<span class="mast_be">*</span></label>
            <span class="example">Example: Ayurveda Day Spa</span>
            <input name="page_heading" type="text" id="page_heading" required>
        </div>
        <div class="form-group edit_page_url">
            <label>Edit URL:<span class="mast_be">*</span></label>
            <span class="example">Example: ayurveda-day-spa</span>
            <input name="page_url" type="text" id="page_url" readonly>
            <span class="dashicons dashicons-edit" id="url_edit" title="Edit url"></span>
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
            <span onClick="JavaScript:open_media_uploader_multiple_images()" id="add_image">Choose images</span>
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
        <div class="form-group" id="action_button">
            <input type="submit" id="submit" value="Add Page">
        </div>
    </form>
    <div class="debug"></div>
</div>    
    <?php
    }
}