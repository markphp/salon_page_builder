<?php
if(isset($_POST) && $_POST['key'] == 'true') {
    require ($_SERVER[DOCUMENT_ROOT].'/wp-load.php');
    
    global $wpdb;
    
    $table_name = $wpdb->prefix . "add_salon_page";
    
    $response = $wpdb->get_results("SELECT * FROM $table_name");
    
    foreach($response as $row){
        $isset = "test";
        foreach($row as $key =>$item){
            $POST[$key]=$item;
        }
        $content = add_salon_page_cont($POST);
        
        $table_name = $wpdb->prefix . "posts";
        
        $new['post_content'] =  str_replace("\\",'',preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); },$content));
        
        $where['ID'] = $POST['page_id'];
        
        $isset = $wpdb->get_results("SELECT ID FROM $table_name WHERE ID ='". $POST['page_id']."'")[0]->ID;
        
        if(strlen($isset)>0){
            
            $wpdb->update($table_name, $new, $where);
            
        }else{
            
        }
        
    }
 
    echo '1';
}