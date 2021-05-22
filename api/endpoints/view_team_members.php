<?php

function view_team_members($request){

    $response = members_scheme($request["slug"]);
    return rest_ensure_response($response);
}

function register_show(){
    register_rest_route('api', '/members/(?P<slug>[-\w]+)', array(
        array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => 'view_team_members'
        ),
    ));
}

add_action('rest_api_init', 'register_show');