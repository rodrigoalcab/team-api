<?php


function register_member(){
    register_post_type('member', array(
        'label' => 'Members',
        'description' => 'Members',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'member', 'with_front' => true),
        'query_var' => true,
        'supports' => array('custom-fields'),
        'publicly_queryable' => true

    ));
}

add_action('init', 'register_member');

?>
