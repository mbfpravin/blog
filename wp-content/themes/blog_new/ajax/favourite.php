<?php
$load_url = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
include $load_url[0] . 'wp-load.php';
global $wpdb;
    $table = $wpdb->prefix . "favourite";
    $data['usrid']        = sanitize_text_field($_POST['usrid']);
    $data['postid']        = sanitize_text_field($_POST['postid']);
    $format = array('%s','%s');
    $err = 0;
    $query = "SELECT * FROM ".$wpdb->prefix."favourite WHERE usrid=".$data['usrid']." AND postid=".$data['postid'];
    $results = $wpdb->get_row($query);
    if($results) {
        echo 2; 
        $query1="DELETE FROM ".$wpdb->prefix."favourite WHERE usrid=".$data['usrid']." AND postid=".$data['postid'];
        $delresult=$wpdb->query($query1);
    } else {
        echo 1; 
        $insert_contact = $wpdb->insert($table, $data, $format);
    }
    
    