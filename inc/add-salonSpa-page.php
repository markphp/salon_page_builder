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
            $ios=get_option('ios_link');
            $adr=get_option('android_link');
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
                            <p style="line-height: 24px; margin: 0;"><span class="pink">Ayur'.$copon.'</span> to get HK$'.$copon.' off any beauty treatment booked at '.$page_heading.' through BloomMe!</p>
                        </div>
            
                    </div>
            
                    <div class="row col-xs-12 col-sm-6 col-md-5 spa-slide-wrp">
            
                        <div id="spa-slide" class="owl-spa-slide">';
            
                            foreach ($images as $image) { 
                                                
                            $content .= '<div class="owl-item">
                                            <div class="item"><!-- Carusel item --><img class="img-responsive spa-slide-img" src="'.$image.'" alt="" /></div>
                                        </div>';
                            
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
            
            <div class="page-wrapper light-yellow">
                <div class="container">
                    <div class="row txt-wrapper">
                        <div class="visible-xs ">
                            <p class="links-app-desc">Download BloomMe for iPhones and Android Devices!</p>
                            <div class="col-xs-6"><a href="'.$ios.'"><img class="img-responsive" src="/wp-content/themes/vouchers/img/app-store-btn.png" alt="" /></a></div>
                            <div class="col-xs-6"><a href="'.$adr.'"><img class="img-responsive" src="/wp-content/themes/vouchers/img/play-market-btn.png" alt="" /></a></div>
                        </div>
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
    echo get_admin_page_title();

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
                <label>Images for slider:<span class="mast_be">*</span></label>
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