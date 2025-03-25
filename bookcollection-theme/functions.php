<?php
// Enqueue Styles & Scripts
function bc_enqueue_assets() {
    wp_enqueue_style('bc-style', get_stylesheet_uri());
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Open+Sans&display=swap');
}
add_action('wp_enqueue_scripts', 'bc_enqueue_assets');

// Enqueue Font Awesome for social icons
function bc_enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'bc_enqueue_font_awesome');

// Add Customizer Settings
function bc_customize_register($wp_customize) {
    // Add Section
    $wp_customize->add_section('bc_featured_books_section', [
        'title' => __('Homepage Books', 'bookcollection'),
        'priority' => 30,
    ]);

    // Add Setting: Number of Books
    $wp_customize->add_setting('bc_books_per_slider', [
        'default' => 6,
        'sanitize_callback' => 'absint',
    ]);

    // Add Control: Number Input
    $wp_customize->add_control('bc_books_per_slider', [
        'label' => __('Books in Slider', 'bookcollection'),
        'section' => 'bc_featured_books_section',
        'type' => 'number',
        'input_attrs' => [
            'min' => 1,
            'max' => 20,
        ],
    ]);
}
add_action('customize_register', 'bc_customize_register');

// Enqueue Swiper.js (modern slider library)
function bc_enqueue_slider_assets() {
    wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper@8/swiper-bundle.min.css');
    wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper@8/swiper-bundle.min.js', [], null, true);
}
add_action('wp_enqueue_scripts', 'bc_enqueue_slider_assets');

// Register Navigation Menu
function bc_register_menus() {
    register_nav_menus([
        'primary' => __('Primary Menu', 'bookcollection'),
    ]);
}
add_action('init', 'bc_register_menus');

// Register Footer Widgets
function bc_register_footer_widgets() {
    register_sidebar([
        'name' => 'Footer Column 1',
        'id' => 'footer-1',
        'description' => 'First footer column',
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
    ]);

    register_sidebar([
        'name' => 'Footer Column 2',
        'id' => 'footer-2',
        'description' => 'Second footer column',
    ]);

    register_sidebar([
        'name' => 'Footer Column 3',
        'id' => 'footer-3',
        'description' => 'Third footer column',
    ]);
}
add_action('widgets_init', 'bc_register_footer_widgets');

