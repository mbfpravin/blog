<?php
$load_url = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
include $load_url[0] . 'wp-load.php';
global $wpdb;
    $table = $wpdb->prefix . "event";
    $data['userid']        = sanitize_text_field($_POST['usrid']);
    $data['postid']        = sanitize_text_field($_POST['postid']);
    $data['event_name']        = sanitize_text_field($_POST['event_name']);
    $data['name']        = sanitize_text_field($_POST['name']);
    $data['email']        = sanitize_text_field($_POST['email']);
    $data['phone']        = sanitize_text_field($_POST['phone']);
    $data['message']        = sanitize_text_field($_POST['message']);
    $format = array('%s','%s','%s','%s','%s','%s','%s');
    $err = 0;
    $insert_contact = $wpdb->insert($table, $data, $format);