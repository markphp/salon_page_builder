<?php
if(isset($_POST) && $_POST != null) {
    require ($_SERVER[DOCUMENT_ROOT].'/wp-load.php');
    
    $table_name =  "add_salon_page";
    
    wp_delete_post($_POST["page_id"]);
    del_row($table_name,$_POST["ID"]);
    
    
}