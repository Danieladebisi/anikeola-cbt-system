<?php
/**
 * Plugin Name: Anikeola CBT System Core
 * Description: Registers Custom Post Type, Taxonomies, and Meta Boxes for the Anikeola CBT System.
 * Version: 1.1
 * Author: Daniel Adebisi
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register CBT Question Custom Post Type.
 */
function anikeola_cbt_register_question_cpt() {
    $labels = array(
        'name'                  => _x( 'CBT Questions', 'Post Type General Name', 'anikeola-cbt' ),
        'singular_name'         => _x( 'CBT Question', 'Post Type Singular Name', 'anikeola-cbt' ),
        'menu_name'             => __( 'CBT Questions', 'anikeola-cbt' ),
        'name_admin_bar'        => __( 'CBT Question', 'anikeola-cbt' ),
        'archives'              => __( 'Question Archives', 'anikeola-cbt' ),
        'attributes'            => __( 'Question Attributes', 'anikeola-cbt' ),
        'parent_item_colon'     => __( 'Parent Question:', 'anikeola-cbt' ),
        'all_items'             => __( 'All Questions', 'anikeola-cbt' ),
        'add_new_item'          => __( 'Add New Question', 'anikeola-cbt' ),
        'add_new'               => __( 'Add New', 'anikeola-cbt' ),
        'new_item'              => __( 'New Question', 'anikeola-cbt' ),
        'edit_item'             => __( 'Edit Question', 'anikeola-cbt' ),
        'update_item'           => __( 'Update Question', 'anikeola-cbt' ),
        'view_item'             => __( 'View Question', 'anikeola-cbt' ),
        'view_items'            => __( 'View Questions', 'anikeola-cbt' ),
        'search_items'          => __( 'Search Question', 'anikeola-cbt' ),
        'not_found'             => __( 'Not found', 'anikeola-cbt' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'anikeola-cbt' ),
        'featured_image'        => __( 'Featured Image', 'anikeola-cbt' ),
        'set_featured_image'    => __( 'Set featured image', 'anikeola-cbt' ),
        'remove_featured_image' => __( 'Remove featured image', 'anikeola-cbt' ),
        'use_featured_image'    => __( 'Use as featured image', 'anikeola-cbt' ),
        'insert_into_item'      => __( 'Insert into question', 'anikeola-cbt' ),
        'uploaded_to_this_item' => __( 'Uploaded to this question', 'anikeola-cbt' ),
        'items_list'            => __( 'Questions list', 'anikeola-cbt' ),
        'items_list_navigation' => __( 'Questions list navigation', 'anikeola-cbt' ),
        'filter_items_list'     => __( 'Filter questions list', 'anikeola-cbt' ),
    );
    $args = array(
        'label'                 => __( 'CBT Question', 'anikeola-cbt' ),
        'description'           => __( 'Custom Post Type for CBT Questions', 'anikeola-cbt' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor' ), // Removed 'custom-fields' as we'll build our own meta box
        'taxonomies'            => array( 'cbt_subject', 'cbt_class_level', 'cbt_topic' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-forms',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    register_post_type( 'cbt_question', $args );
}
add_action( 'init', 'anikeola_cbt_register_question_cpt', 0 );

/**
 * Register Subject Taxonomy.
 */
function anikeola_cbt_register_subject_taxonomy() {
    $labels = array(
        'name'              => _x( 'Subjects', 'taxonomy general name', 'anikeola-cbt' ),
        'singular_name'     => _x( 'Subject', 'taxonomy singular name', 'anikeola-cbt' ),
        'search_items'      => __( 'Search Subjects', 'anikeola-cbt' ),
        'all_items'         => __( 'All Subjects', 'anikeola-cbt' ),
        'parent_item'       => __( 'Parent Subject', 'anikeola-cbt' ),
        'parent_item_colon' => __( 'Parent Subject:', 'anikeola-cbt' ),
        'edit_item'         => __( 'Edit Subject', 'anikeola-cbt' ),
        'update_item'       => __( 'Update Subject', 'anikeola-cbt' ),
        'add_new_item'      => __( 'Add New Subject', 'anikeola-cbt' ),
        'new_item_name'     => __( 'New Subject Name', 'anikeola-cbt' ),
        'menu_name'         => __( 'Subjects', 'anikeola-cbt' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'cbt-subject' ),
        'show_in_rest'      => true,
    );
    register_taxonomy( 'cbt_subject', array( 'cbt_question' ), $args );
}
add_action( 'init', 'anikeola_cbt_register_subject_taxonomy', 0 );

/**
 * Register Class Level Taxonomy.
 */
function anikeola_cbt_register_class_level_taxonomy() {
    $labels = array(
        'name'              => _x( 'Class Levels', 'taxonomy general name', 'anikeola-cbt' ),
        'singular_name'     => _x( 'Class Level', 'taxonomy singular name', 'anikeola-cbt' ),
        'search_items'      => __( 'Search Class Levels', 'anikeola-cbt' ),
        'all_items'         => __( 'All Class Levels', 'anikeola-cbt' ),
        'parent_item'       => __( 'Parent Class Level', 'anikeola-cbt' ),
        'parent_item_colon' => __( 'Parent Class Level:', 'anikeola-cbt' ),
        'edit_item'         => __( 'Edit Class Level', 'anikeola-cbt' ),
        'update_item'       => __( 'Update Class Level', 'anikeola-cbt' ),
        'add_new_item'      => __( 'Add New Class Level', 'anikeola-cbt' ),
        'new_item_name'     => __( 'New Class Level Name', 'anikeola-cbt' ),
        'menu_name'         => __( 'Class Levels', 'anikeola-cbt' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'cbt-class-level' ),
        'show_in_rest'      => true,
    );
    register_taxonomy( 'cbt_class_level', array( 'cbt_question' ), $args );
}
add_action( 'init', 'anikeola_cbt_register_class_level_taxonomy', 0 );

/**
 * Register Topic Taxonomy.
 */
function anikeola_cbt_register_topic_taxonomy() {
    $labels = array(
        'name'              => _x( 'Topics', 'taxonomy general name', 'anikeola-cbt' ),
        'singular_name'     => _x( 'Topic', 'taxonomy singular name', 'anikeola-cbt' ),
        'search_items'      => __( 'Search Topics', 'anikeola-cbt' ),
        'all_items'         => __( 'All Topics', 'anikeola-cbt' ),
        'parent_item'       => __( 'Parent Topic', 'anikeola-cbt' ),
        'parent_item_colon' => __( 'Parent Topic:', 'anikeola-cbt' ),
        'edit_item'         => __( 'Edit Topic', 'anikeola-cbt' ),
        'update_item'       => __( 'Update Topic', 'anikeola-cbt' ),
        'add_new_item'      => __( 'Add New Topic', 'anikeola-cbt' ),
        'new_item_name'     => __( 'New Topic Name', 'anikeola-cbt' ),
        'menu_name'         => __( 'Topics', 'anikeola-cbt' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'cbt-topic' ),
        'show_in_rest'      => true,
    );
    register_taxonomy( 'cbt_topic', array( 'cbt_question' ), $args );
}
add_action( 'init', 'anikeola_cbt_register_topic_taxonomy', 0 );

/**
 * Adds a meta box to the CBT Question post type edit screen.
 */
function anikeola_cbt_add_answers_meta_box() {
    add_meta_box(
        'anikeola_cbt_answers_meta_box_id', // Unique ID for the meta box
        __( 'Question Answers & Options', 'anikeola-cbt' ), // Title of the meta box
        'anikeola_cbt_answers_meta_box_callback', // Callback function to render the HTML
        'cbt_question', // The CPT slug where this meta box will appear
        'normal', // Context (normal, side, advanced)
        'high' // Priority (high, core, default, low)
    );
}
add_action( 'add_meta_boxes_cbt_question', 'anikeola_cbt_add_answers_meta_box' ); // Note the hook specific to the CPT

/**
 * Callback function to render the HTML for the answers meta box.
 *
 * @param WP_Post $post The post object.
 */
function anikeola_cbt_answers_meta_box_callback( $post ) {
    // Add a nonce field for security
    wp_nonce_field( 'anikeola_cbt_save_answers_meta_box_data', 'anikeola_cbt_answers_meta_box_nonce' );

    // Retrieve existing values from the database
    $answer_options = get_post_meta( $post->ID, '_anikeola_cbt_answer_options', true );
    $correct_answer_index = get_post_meta( $post->ID, '_anikeola_cbt_correct_answer_index', true );

    // Set defaults if no values exist
    if ( empty( $answer_options ) ) {
        $answer_options = array_fill( 0, 5, '' ); // Default to 5 empty answer options
    }
    if ( $correct_answer_index === '' ) { // Check for empty string as it might be saved as such if no selection
        $correct_answer_index = null; // Or -1, or some other indicator of "not set"
    } else {
        $correct_answer_index = intval( $correct_answer_index );
    }

    // --- Styling for the meta box ---
    echo '<style>
        .anikeola-cbt-answer-row { margin-bottom: 15px; display: flex; align-items: center; }
        .anikeola-cbt-answer-row label { margin-right: 10px; min-width: 80px; }
        .anikeola-cbt-answer-row input[type="text"] { width: 70%; margin-right: 10px; }
        .anikeola-cbt-answer-row input[type="radio"] { margin-left: 5px; }
        .anikeola-cbt-meta-box-table { width: 100%; border-collapse: collapse; }
        .anikeola-cbt-meta-box-table td, .anikeola-cbt-meta-box-table th { padding: 8px; text-align: left; }
        .anikeola-cbt-meta-box-table th { font-weight: bold; }
    </style>';

    // --- HTML for the meta box fields ---
    echo '<p>' . __('Enter up to 5 answer options for this question and select the correct one.', 'anikeola-cbt') . '</p>';
    echo '<table class="anikeola-cbt-meta-box-table">';
    echo '<thead><tr><th>' . __('Option', 'anikeola-cbt') . '</th><th>' . __('Answer Text', 'anikeola-cbt') . '</th><th>' . __('Is Correct?', 'anikeola-cbt') . '</th></tr></thead>';
    echo '<tbody>';

    $number_of_options = 5; // Define how many answer options to show
    for ( $i = 0; $i < $number_of_options; $i++ ) {
        $option_value = isset( $answer_options[$i] ) ? esc_attr( $answer_options[$i] ) : '';
        $is_checked = ( $correct_answer_index === $i ); // Check if this option is the correct one

        echo '<tr>';
        echo '<td><label for="anikeola_cbt_answer_option_' . $i . '">' . sprintf( __('Option %d:', 'anikeola-cbt'), $i + 1 ) . '</label></td>';
        echo '<td><input type="text" id="anikeola_cbt_answer_option_' . $i . '" name="anikeola_cbt_answer_options[]" value="' . $option_value . '" style="width: 90%;" /></td>';
        echo '<td><input type="radio" name="_anikeola_cbt_correct_answer_index" value="' . $i . '" ' . checked( $is_checked, true, false ) . ' /></td>';
        echo '</tr>';
    }
    echo '</tbody></table>';

    // TODO: Add fields for points per question if needed (CBT-FUNC-XXX)
    // TODO: Add field for correct answer explanation if needed (CBT-FUNC-XXX)
}

/**
 * Save the meta box data when the post is saved.
 *
 * @param int $post_id The ID of the post being saved.
 */
function anikeola_cbt_save_answers_meta_box_data( $post_id ) {
    // Check if our nonce is set.
    if ( ! isset( $_POST['anikeola_cbt_answers_meta_box_nonce'] ) ) {
        return;
    }
    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['anikeola_cbt_answers_meta_box_nonce'], 'anikeola_cbt_save_answers_meta_box_data' ) ) {
        return;
    }
    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'cbt_question' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    } else {
        // This check is for other post types, not strictly necessary here since we hooked to 'save_post_cbt_question'
        // but good practice if hooking to generic 'save_post'.
        if ( ! current_user_can( 'edit_page', $post_id ) ) { // Or 'edit_post' if it's a generic post
            return;
        }
    }

    // --- Save Answer Options ---
    if ( isset( $_POST['anikeola_cbt_answer_options'] ) ) {
        $sanitized_options = array();
        // Sanitize each answer option
        foreach ( (array) $_POST['anikeola_cbt_answer_options'] as $option ) {
            $sanitized_options[] = sanitize_text_field( $option );
        }
        update_post_meta( $post_id, '_anikeola_cbt_answer_options', $sanitized_options );
    }

    // --- Save Correct Answer Index ---
    // Check if the radio button was selected
    if ( isset( $_POST['_anikeola_cbt_correct_answer_index'] ) ) {
        $correct_index = intval( $_POST['_anikeola_cbt_correct_answer_index'] );
        update_post_meta( $post_id, '_anikeola_cbt_correct_answer_index', $correct_index );
    } else {
        // If no radio button is selected (e.g., if it's a new question and none was picked, or if it was somehow cleared)
        // You might want to delete the meta or save a specific "not set" value like -1 or null.
        // For now, let's delete it if not set, or you can choose to save a default.
        delete_post_meta( $post_id, '_anikeola_cbt_correct_answer_index' );
    }

    // TODO: Save points per question if the field exists
    // TODO: Save correct answer explanation if the field exists
}
// Use 'save_post_{post_type}' hook for better performance if you know the post type.
add_action( 'save_post_cbt_question', 'anikeola_cbt_save_answers_meta_box_data' );


/**
 * Flush rewrite rules on plugin activation.
 * This is important for the CPT and taxonomy slugs to work correctly.
 */
function anikeola_cbt_rewrite_flush() {
    // First, register CPTs and taxonomies
    anikeola_cbt_register_question_cpt();
    anikeola_cbt_register_subject_taxonomy();
    anikeola_cbt_register_class_level_taxonomy();
    anikeola_cbt_register_topic_taxonomy();

    // Then, flush the rules
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'anikeola_cbt_rewrite_flush' );
// register_deactivation_hook( __FILE__, 'flush_rewrite_rules' ); // Optional: Flush on deactivation too

?>
