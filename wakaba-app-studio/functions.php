<?php
if (!defined('ABSPATH')) exit;

// Theme Setup
function wakaba_app_studio_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'wakaba-app-studio'),
        'footer' => esc_html__('Footer Menu', 'wakaba-app-studio'),
    ));
}
add_action('after_setup_theme', 'wakaba_app_studio_setup');

// Enqueue scripts and styles
function wakaba_app_studio_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('wakaba-app-studio-style', get_stylesheet_uri(), array(), '1.0.0');

    // Enqueue AOS animation script
    wp_enqueue_script('aos-script', 'https://unpkg.com/aos@next/dist/aos.js', array(), '2.3.4', true);

    // Enqueue custom script
    wp_enqueue_script('wakaba-app-studio-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);

    // Localize script for AJAX
    wp_localize_script('wakaba-app-studio-script', 'wakabaAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('wakaba-nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'wakaba_app_studio_scripts');

// Register widget areas
function wakaba_app_studio_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'wakaba-app-studio'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'wakaba-app-studio'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'wakaba_app_studio_widgets_init');

// Custom post type for Apps
function wakaba_app_studio_register_post_types() {
    register_post_type('app', array(
        'labels' => array(
            'name'               => __('Apps', 'wakaba-app-studio'),
            'singular_name'      => __('App', 'wakaba-app-studio'),
            'menu_name'          => __('Apps', 'wakaba-app-studio'),
            'add_new'            => __('Add New', 'wakaba-app-studio'),
            'add_new_item'       => __('Add New App', 'wakaba-app-studio'),
            'edit_item'          => __('Edit App', 'wakaba-app-studio'),
            'new_item'           => __('New App', 'wakaba-app-studio'),
            'view_item'          => __('View App', 'wakaba-app-studio'),
            'search_items'       => __('Search Apps', 'wakaba-app-studio'),
            'not_found'          => __('No apps found', 'wakaba-app-studio'),
            'not_found_in_trash' => __('No apps found in Trash', 'wakaba-app-studio'),
        ),
        'public'              => true,
        'has_archive'         => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'apps'),
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-smartphone',
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
    ));
}
add_action('init', 'wakaba_app_studio_register_post_types');

// Custom meta boxes for Apps
function wakaba_app_studio_add_meta_boxes() {
    add_meta_box(
        'app_details',
        __('App Details', 'wakaba-app-studio'),
        'wakaba_app_studio_app_details_callback',
        'app',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'wakaba_app_studio_add_meta_boxes');

function wakaba_app_studio_app_details_callback($post) {
    wp_nonce_field('wakaba_app_studio_app_details', 'wakaba_app_studio_app_details_nonce');
    
    $app_store_url = get_post_meta($post->ID, '_app_store_url', true);
    $play_store_url = get_post_meta($post->ID, '_play_store_url', true);
    ?>
    <p>
        <label for="app_store_url"><?php _e('App Store URL:', 'wakaba-app-studio'); ?></label>
        <input type="url" id="app_store_url" name="app_store_url" value="<?php echo esc_attr($app_store_url); ?>" class="widefat">
    </p>
    <p>
        <label for="play_store_url"><?php _e('Google Play Store URL:', 'wakaba-app-studio'); ?></label>
        <input type="url" id="play_store_url" name="play_store_url" value="<?php echo esc_attr($play_store_url); ?>" class="widefat">
    </p>
    <?php
}

function wakaba_app_studio_save_meta_box_data($post_id) {
    if (!isset($_POST['wakaba_app_studio_app_details_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['wakaba_app_studio_app_details_nonce'], 'wakaba_app_studio_app_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $app_store_url = sanitize_url($_POST['app_store_url']);
    $play_store_url = sanitize_url($_POST['play_store_url']);

    update_post_meta($post_id, '_app_store_url', $app_store_url);
    update_post_meta($post_id, '_play_store_url', $play_store_url);
}
add_action('save_post', 'wakaba_app_studio_save_meta_box_data'); 