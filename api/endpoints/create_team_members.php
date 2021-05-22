<?php

function create_team_members($request){

    $name = sanitize_text_field($request['name']);
    $email = sanitize_email($request['email']);
    $birthday = sanitize_text_field($request['birthday']);
    $gender = sanitize_text_field($request['gender']);

    $id = get_member_id_by_email($email);
    $post_found = get_post($id);

    if(empty($name) || empty($email) || empty($birthday) || empty($gender)){
        $response = new WP_Error('Error', "The fields name, email, birthday and gender can not be empty", array('status' => 403));
    }else {

        if (!$post_found) {

            $response = array(
                'post_type' => 'member',
                'post_title' => $name,
                'post_status' => 'publish',
                'meta_input' => array(
                    'name' => $name,
                    'email' => $email,
                    'birthday' => $birthday,
                    'gender' => $gender
                ),
            );

            $id_member = wp_insert_post($response);
            $response['id'] = get_post_field('post_name', $id_member);
        } else {
            $response = new WP_Error('Error', "This email is already registered", array('status' => 403));
        }
    }
        return rest_ensure_response($response);
}

function register_create(){
    register_rest_route('api', '/members', array(
        array(
            'methods' => WP_REST_Server::CREATABLE,
            'callback' => 'create_team_members'
        ),
    ));
}

add_action('rest_api_init', 'register_create');

