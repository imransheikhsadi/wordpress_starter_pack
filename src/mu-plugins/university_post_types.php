<?php

function university_post_types(){
  // campus post type
  register_post_type('campus',array(
      'supports' => array('title','editor','excerpt'),
      'has_archive' => true,
      'public' => true,
      'labels' => array(
          'name' => 'Campuses',
          'add_new_item' => 'Add New Campus',
          'edit_item' => 'Edit Campus',
          'all_items' => 'All Campuses',
          'singular_name' => 'Campus'
      ),
      'rewrite' => array(
        'slug' => 'campuses'
      ),
      'menu_icon' => 'dashicons-location-alt'
  ));


    // Event post type
    register_post_type('event',array(
	'supports' => array('title','editor','excerpt'),
	'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event'
        ),
      	'rewrite' => array(
      		'slug' => 'events'
      	),
        'menu_icon' => 'dashicons-calendar'
    ));

    // Program post type
    register_post_type('program',array(
        'supports' => array('title'),
        'has_archive' => true,
            'public' => true,
            'labels' => array(
                'name' => 'Programs',
                'add_new_item' => 'Add New Program',
                'edit_item' => 'Edit Program',
                'all_items' => 'All Programs',
                'singular_name' => 'Program'
            ),
        'rewrite' => array(
            'slug' => 'programs'
        ),
            'menu_icon' => 'dashicons-awards'
        ));

      // Professor post type
    register_post_type('professor',array(
        'supports' => array('title','editor','thumbnail'),
            'public' => true,
            'labels' => array(
                'name' => 'Professors',
                'add_new_item' => 'Add New Professor',
                'edit_item' => 'Edit Professor',
                'all_items' => 'All Professors',
                'singular_name' => 'Professor'
            ),
            'menu_icon' => 'dashicons-welcome-learn-more'
        ));

}
add_action('init','university_post_types');
?>
