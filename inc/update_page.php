<?php/** * This the main file to do request in $wpdb */if(isset($_POST) && $_POST!= NULL) {        $ipaddress = '';    if (getenv('HTTP_CLIENT_IP'))        $ipaddress = getenv('HTTP_CLIENT_IP');    else if(getenv('HTTP_X_FORWARDED_FOR'))        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');    else if(getenv('HTTP_X_FORWARDED'))        $ipaddress = getenv('HTTP_X_FORWARDED');    else if(getenv('HTTP_FORWARDED_FOR'))        $ipaddress = getenv('HTTP_FORWARDED_FOR');    else if(getenv('HTTP_FORWARDED'))       $ipaddress = getenv('HTTP_FORWARDED');    else if(getenv('REMOTE_ADDR'))        $ipaddress = getenv('REMOTE_ADDR');    else        $ipaddress = 'UNKNOWN';        require ($_SERVER[DOCUMENT_ROOT].'/wp-load.php');            $ID = $_POST['ID'];    $page_heading = $_POST['page_heading'];    $text_muted = $_POST['text_muted'];    $services = $_POST['services'];    $copon = $_POST['copon'];    $images = $_POST['images'];    $text = $_POST['text'];    $map_code = $_POST['map_code'];    $address = $_POST['address'];    $page_id = $_POST['page_id'];    $page_url = $_POST['page_url'];        global $wpdb;         /**     * For insert new data in page     */    $content = add_salon_page_cont($_POST);    $guid = 'http://bloomme.com.hk/'.$page_url;        $table_name = $wpdb->prefix . "posts";        $new['post_content'] =  str_replace("\\",'',preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); },$content));    $new['post_title'] =  str_replace("\\",'',preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); },$page_heading));    $new['post_name'] = str_replace("\\",'',preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); },$page_url));    $new['guid'] = str_replace("\\",'',preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); },$page_url));          $where['ID'] = $page_id;         echo $wpdb->update($table_name, $new, $where);    /**     * End     */        /**     * Start updade local table     */    $table_name = $wpdb->prefix . "add_salon_page";        $set;    foreach($_POST as $key => $data){        if($key != 'ID'){            $set[$key] = str_replace("\\",'',preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); },$data));        }    }        $set['last_modif'] = date("F j, Y, g:i a");    $set['client_ip'] = $ipaddress;        echo $wpdb->update($table_name, $set, array('ID' => $ID	));    /**     * End     */}