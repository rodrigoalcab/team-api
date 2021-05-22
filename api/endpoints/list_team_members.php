<?php

function list_team_members($request){

    $q = sanitize_text_field($request['q']) ? : '';
    $page = sanitize_text_field($request['page']) ? : 0;
    $limit = sanitize_text_field($request['limit']) ? : -1;

    $query = array(
        'post_type' => 'member',
        'post_status' => 'publish',
        'posts_per_page' => $limit,
        'paged' => $page,
        's' => $q,
        'orderby' => 'title',
        'order' => 'ASC'
    );

    $loop = new WP_Query($query);
    $posts = $loop->posts;

        $members = array();
        foreach ($posts as $key => $value) {
            $members[] = members_scheme($value->post_name);
        }

        if(empty($members)){
        $response = new WP_Error('Error', "Any member registered", array('status' => 404));
            return rest_ensure_response($response);
         }else{
            return rest_ensure_response($members);
        }
}

function register_index(){
    register_rest_route('api', '/members', array(
        array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => 'list_team_members'
        ),
    ));
}

add_action('rest_api_init', 'register_index');

