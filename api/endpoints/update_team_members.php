<?php

function update_team_members($request){

        $name = sanitize_text_field($request['name']);
        $email = sanitize_email($request['email']);
        $birthday = sanitize_text_field($request['birthday']);
        $gender = sanitize_text_field($request['gender']);

        $id = get_member_id_by_email($email);
        $id = $id->ID;
        $post_found = get_post($id);

    if(empty($name) || empty($email) || empty($birthday) || empty($gender)){
        $response = new WP_Error('Error', "The fields name, email, birthday and gender can not be empty", array('status' => 403));
    }else {

        if ($post_found) {

            $response = array(
                'name' => $name,
                'email' => $email,
                'birthday' => $birthday,
                'gender' => $gender
            );

            wp_update_post($response);

            update_post_meta($id, 'name', $name);
            update_post_meta($id, 'birthday', $birthday);
            update_post_meta($id, 'gender', $gender);

        } else {
            $response = new WP_Error('Error', 'Member not found', array('status' => 404));
        }
    }

        return rest_ensure_response($response);
    }

function register_update(){
    register_rest_route('api', '/members', array(
        array(
            'methods' => WP_REST_Server::EDITABLE,
            'callback' => 'update_team_members'
        ),
    ));
}

add_action('rest_api_init', 'register_update');

