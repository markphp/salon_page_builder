<?phpif(isset($_POST)) {    require realpath(__DIR__) . "/db_manager.php";        $t_name = "add_salon_page";    $search = $_POST['search_in'];        $pages = search_by($t_name,$search);                $select = '';        foreach($pages as  $val){             $select .= '<option value="'.$val->ID.'">'.$val->page_heading.'</option>';                    }         //var_dump( $_POST['search_in']);        echo $select;}