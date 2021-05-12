<?php
// echo "this is working";

function project1_enqueue_scripts() {
    wp_enqueue_style( 'stylesheet', get_stylesheet_uri());
}
add_action( 'wp_enqueue_scripts', 'project1_enqueue_scripts' );

?>

