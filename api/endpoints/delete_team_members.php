<?php

function delete_team_members($request){

    $slug = $request["slug"];
    $id_member = get_member_id_by_slug($slug);

    $post_found = get_post($id_member);
    if($post_found) {

        $response = wp_delete_post($id_member, true);
    }else{
        $response = new WP_Error('Error', 'Member not found', array('status' => 404));
    }

    return rest_ensure_response($response);
}

function register_destroy(){
    register_rest_route('api', '/members/(?P<slug>[-\w]+)', array(
        array(
            'methods' => WP_REST_Server::DELETABLE,
            'callback' => 'delete_team_members'
        ),
    ));
}

add_action('rest_api_init', 'register_destroy');


