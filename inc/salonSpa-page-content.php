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
            $images = split(',',$POST['images']);
        //for Content:
            $text = $POST['text'];
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
                             <p style="line-height: 24px; margin: 0;"><span class="pink">'.substr($page_heading,0,4).$copon.'</span> to get HK$'.$copon.' off any beauty treatment booked at '.$page_heading.' through BloomMe!</p>
                        </div>
            
                    </div>
            
                    <div class="row col-xs-12 col-sm-6 col-md-5 spa-slide-wrp">
            
                        <div id="spa-slide" class="owl-spa-slide">';
            
                            foreach ($images as $image) { 
                                                
                            $content .= '<div class="item" style=" background-image: url('.$image.');background-size: cover; background-position: 20% 0%;"><!-- Carusel item --> <img class="img-responsive spa-slide-img" src="/wp-content/plugins/salon_page_builder/img/clear400x400.jpg" alt="" style="display: block; width: 100%; -webkit-transform-style: preserve-3d;transform-style: preserve-3d; visibility: hidden;" /></div>';
                            
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
                	    <span style="text-align:right; display: block;font-size: 20px;color: #696969;"> Get $'.$copon.' off any booking at '.$page_heading.'!<br>Sign up with BloomMe with Code: </span>
                	</div>
                	
                    <div class="coupon_section col-xs-12 col-sm-3"><span class=" ">'.substr($page_heading,0,4).$copon.'</span></div>
                    
                    <div class="col-xs-12 col-sm-4">
                            <div class="col-xs-6"><a href="https://bnc.lt/Vz5k/s7jvU8u9dt"><img class="img-responsive" src="/wp-content/themes/vouchers/img/app-store-btn.png" alt="" style="max-width:165px;" width="165" height="53"/></a></div>
                            <div class="col-xs-6"><a href="https://bnc.lt/Vz5k/7lt2vIpaet"><img class="img-responsive" src="/wp-content/themes/vouchers/img/play-market-btn.png" alt="" style="max-width:165px;" width="165" height="53"/></a></div>
                    </div>
                    </div>
                </div>
            </div>
            
            <div class="page-wrapper light-yellow"><div class="container"><div class="row txt-wrapper"><div class="">'.$map_code.'</div></div></div></div>';
            
            //end of content
        return $content;
        }
    }
}
            