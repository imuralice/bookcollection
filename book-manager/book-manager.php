<?php
/*
Plugin Name: Book Manager
Description: Manages book listings with custom post type and features.
Version: 1.0
*/

// Register Custom Post Type: Books
function bm_register_books_cpt() {
    $args = [
        'public' => true,
        'label'  => 'Books',
        'supports' => ['title', 'editor', 'thumbnail'],
        'rewrite' => ['slug' => 'books'],
        'has_archive' => true,
    ];
    register_post_type('book', $args);
}
add_action('init', 'bm_register_books_cpt');

// Add Meta Boxes for Book Details
function bm_add_book_meta_boxes() {
    add_meta_box(
        'bm_book_details',
        'Book Details',
        'bm_render_book_details',
        'book',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'bm_add_book_meta_boxes');

// Render Meta Box Fields
function bm_render_book_details($post) {
    $author = get_post_meta($post->ID, '_bm_author', true);
    $year = get_post_meta($post->ID, '_bm_year', true);
    ?>
    <p>
        <label>Author:</label>
        <input type="text" name="bm_author" value="<?php echo esc_attr($author); ?>" style="width:100%">
    </p>
    <p>
        <label>Publication Year:</label>
        <input type="number" name="bm_year" value="<?php echo esc_attr($year); ?>" style="width:100%">
    </p>
    <p>
    <label>
        <input type="checkbox" name="bm_featured" 
            <?php checked(get_post_meta($post->ID, '_bm_featured', true), '1'); ?>>
        Feature this book on the homepage
    </label>
</p>
    <?php
}

// Save Meta Box Data
function bm_save_book_meta($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['bm_author'])) {
        update_post_meta($post_id, '_bm_author', sanitize_text_field($_POST['bm_author']));
    }
    if (isset($_POST['bm_year'])) {
        update_post_meta($post_id, '_bm_year', intval($_POST['bm_year']));
    }
    if (isset($_POST['bm_featured'])) {
        update_post_meta($post_id, '_bm_featured', '1');
    } else {
        delete_post_meta($post_id, '_bm_featured');
    }
}
add_action('save_post', 'bm_save_book_meta');

// Email Notification on New Book
function bm_notify_admin_on_new_book($post_id) {
    if (wp_is_post_revision($post_id)) return;
    $post = get_post($post_id);
    if ($post->post_type !== 'book') return;

    $to = get_option('admin_email');
    $subject = 'New Book Added: ' . get_the_title($post_id);
    $message = "A new book titled \"" . get_the_title($post_id) . "\" has been added.";
    wp_mail($to, $subject, $message);
}
add_action('publish_book', 'bm_notify_admin_on_new_book');

function bm_modify_book_query($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('book')) {
        // Filter by Author
        if (isset($_GET['author']) && !empty($_GET['author'])) {
            $author = sanitize_text_field($_GET['author']);
            $query->set('meta_key', '_bm_author');
            $query->set('meta_value', $author);
        }

        // Filter by Year (FIXED)
        if (isset($_GET['bm_year']) && !empty($_GET['bm_year'])) {
            $year = intval($_GET['bm_year']);
            $meta_query = $query->get('meta_query') ?: [];
            $meta_query[] = [
                'key' => '_bm_year',
                'value' => $year,
                'compare' => '=',
                'type' => 'NUMERIC',
            ];
            $query->set('meta_query', $meta_query);
        }
    }
}
add_action('pre_get_posts', 'bm_modify_book_query');

// Shortcode: [book_list]
function bm_book_list_shortcode($atts) {
    $atts = shortcode_atts([
        'author' => '',
        'year' => '',
    ], $atts);

    $args = [
        'post_type' => 'book',
        'posts_per_page' => -1,
    ];

    if (!empty($atts['author'])) {
        $args['meta_key'] = '_bm_author';
        $args['meta_value'] = sanitize_text_field($atts['author']);
    }
    if (!empty($atts['year'])) {
        $args['meta_key'] = '_bm_year';
        $args['meta_value'] = intval($atts['year']);
    }

    $query = new WP_Query($args);
    $output = '<div class="book-grid">';

    while ($query->have_posts()) {
        $query->the_post();
        $output .= '
            <div class="book-item">
                <h3>' . get_the_title() . '</h3>
                <p>Author: ' . get_post_meta(get_the_ID(), '_bm_author', true) . '</p>
                <p>Year: ' . get_post_meta(get_the_ID(), '_bm_year', true) . '</p>
                <div class="description">' . get_the_content() . '</div>
            </div>
        ';
    }
    wp_reset_postdata();
    $output .= '</div>';
    return $output;
}
add_shortcode('book_list', 'bm_book_list_shortcode');