<?php
/*
Plugin Name: Student Api
Plugin URI: http://intelsofts.com/wordpress/student_api
Description: This is tutorial for student api in wordpress.
Author: batch66
Version: 0.0.1
Author URI: http://batch66/
*/


require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/includes/class-jwt-handler.php';

add_action('rest_api_init', function () {

  register_rest_route('student/v1', '/login', [
        'methods' => 'POST',
        'callback' => 'sdp_login_user',
        'permission_callback' => '__return_true'
    ]);

    register_rest_route('student/v1', '/all', [
        'methods' => 'GET',
        'callback' => 'sdp_get_students',
        'permission_callback' => 'api_check_token'
    ]);
   
    register_rest_route('student/v1', '/create', [
        'methods' => 'POST',
        'callback' => 'sdp_create_students',
        'permission_callback' => '__return_true'
    ]);

});


function sdp_login_user($request) {
    $username = sanitize_text_field($request['username']);
    $password = sanitize_text_field($request['password']);

    $user = wp_authenticate($username, $password);

    if (is_wp_error($user)) {
        return new WP_Error('invalid', 'Invalid username or password', ['status' => 403]);
    }

    $token = \StudentAPI\JWT_Handler::generate_token($user->ID);

    return rest_ensure_response([
        'token' => $token,
        'user_id' => $user->ID,
        'username' => $user->user_login,
        'email' => $user->user_email
    ]);
}


 function api_check_token($request)
    {
        $auth_header = $request->get_header('authorization');

        if (!$auth_header || !preg_match('/Bearer\s(\S+)/', $auth_header, $matches)) {
            return false;
        }

        $token = $matches[1];
        $user_id = \StudentAPI\JWT_Handler::validate_token($token);

        if ($user_id) {
            wp_set_current_user($user_id);
            return true;
        }

        return false;
    }



function sdp_get_students($data) {
    global $wpdb;
    $table = $wpdb->prefix . 'students';
    $results = $wpdb->get_results("SELECT * FROM $table");
    return rest_ensure_response($results);
}


function sdp_create_students() {
    global $wpdb;
    $table = $wpdb->prefix . 'students';

    $name= $_POST["name"];
    $email= $_POST["email"];

    $results = $wpdb->insert($table, ["name"=>$name, "email"=>$email]);
    return rest_ensure_response($_POST);
}
