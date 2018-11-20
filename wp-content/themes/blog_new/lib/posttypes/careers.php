<?php add_action('init', 'create_Events', 0);

function create_Events() {
    $labels = array(
        'name' => _x('Events', 'post type general name'),
        'singular_name' => _x('Events', 'post type singular name'),
        'add_new' => _x('Add Events', 'Events'),
        'add_new_item' => __('Add Events'),
        'edit_item' => __('Edit Events'),
        'new_item' => __('New Events'),
        'view_item' => __('View Events'),
        'search_items' => __('Search Events'),
        'not_found' => __('No Events found'),
        'not_found_in_trash' => __('No Events found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'Events','with_front' => FALSE,'pages'=>true),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('Events', $args);
    register_taxonomy("event_cat", "events", array("hierarchical" => true,
        "label" => "Events Categories",
        "singular_label" => "Events",
        'rewrite' => array('slug' => 'events','with_front' => FALSE,),
        "query_var" => true,
        "show_ui" => true
            )
    );

}
?>