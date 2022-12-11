<?php
function create_post_type() {
  register_post_type( 'items',
    array(
      'labels' => array(
        'name' => 'Объекты',
        'singular_name' => 'Объект'
      ),
      'public' => true,
      'has_archive' => true,
      'hierarchical' => true,
      'show_in_rest' => false,
      'rewrite' => array( 'slug' => 'board/%board%', 'with_front' => true ),
      'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    )
  );
}

add_action( 'init', 'create_post_type' );