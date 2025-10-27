<?php
/*
Plugin Name: Student Api
Plugin URI: http://intelsofts.com/wordpress/student_api
Description: This is tutorial for student api in wordpress.
Author: batch66
Version: 0.0.1
Author URI: http://batch66/
*/

add_action('rest_api_init', function () {

    register_rest_route('student/v1', '/all', [
        'methods' => 'GET',
        'callback' => 'sdp_get_students',
        'permission_callback' => '__return_true'
    ]);
    register_rest_route('student/v1', '/create', [
        'methods' => 'POST',
        'callback' => 'sdp_create_students',
        'permission_callback' => '__return_true'
    ]);

});



function sdp_get_students($data) {
    global $wpdb;
    $table = $wpdb->prefix . 'students';
    $results = $wpdb->get_results("SELECT * FROM $table");
    return rest_ensure_response($results);
}


function sdp_create_students($data) {
    global $wpdb;
    $table = $wpdb->prefix . 'students';

    $name= $_POST["name"];
    $email= $_POST["email"];

    $results = $wpdb->insert($table, ["name"=>$name, "email"=>$email]);
    return rest_ensure_response($results);
}
