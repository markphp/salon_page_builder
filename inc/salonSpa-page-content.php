<?php
function add_salon_page_cont($POST) {

    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }else{
        if( isset($POST['page_heading']) && isset($POST['text_muted'])){
        //for Title:
            $page_heading = $POST['page_heading'];
            $text_muted = $POST['text_muted'];
        //for Description:
            $services = $POST['services'];
            $address = $POST['address'];
            $copon = $POST['copon'];
        //for Slider:
            $images = split(',',$_POST['images']);
        //for Content:
            $text = $POST['text'];
        //for app Link:
            $ios=get_option('ios_link');
            $adr=get_option('android_link');
        //for Map:
            $map_code= $POST['map_code'];
            
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
        return $content;
        }
    }
}
            