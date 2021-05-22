<?php

$template_directory = get_template_directory();

require_once ($template_directory . "/custom-post-type/member.php");

require_once ($template_directory . "/endpoints/create_team_members.php");
require_once ($template_directory . "/endpoints/list_team_members.php");
require_once ($template_directory . "/endpoints/delete_team_members.php");
require_once ($template_directory . "/endpoints/update_team_members.php");
require_once ($template_directory . "/endpoints/view_team_members.php");


function get_member_id_by_slug($slug){

    $query = new WP_Query(array(
        'name' => $slug,
        'post_type' => 'member',
        'numberposts' => 1,
        'fields' => 'ids'
    ));
    $posts = $query->get_posts();

    return array_shift($posts);
}

function get_member_id_by_email($email){

    $query = new WP_Query(array(
        'post_type' => 'member',
        'meta_key' => 'email',
        'meta_value' => $email
    ));
    $posts = $query->get_posts();

    return array_shift($posts);
}


function members_scheme($slug){
    $id_member = get_member_id_by_slug($slug);

    if($id_member){
        $post = get_post($id_member);
        $post_meta = get_post_meta($id_member);

        $response = array(
            'Id' => $id_member,
            'name' => $post_meta['name'][0],
            'email' => $post_meta['email'][0],
            'birthday' => $post_meta['birthday'][0],
            'gender' => $post_meta['gender'][0],
            'slug' => $post->post_name,
        );
    }else{
        $response = new WP_Error('Error','Member not found.', array('status' => 404));
    }
    return $response;
}


