<?php
/**
 * Plugin Name: Anikeola CBT System Core
 * Description: Registers Custom Post Type, Taxonomies, and Meta Boxes for the Anikeola CBT System.
 * Version: 1.2
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
        'supports'              => array( 'title', 'editor' ), // 'title' for question prompt, 'editor' for detailed description/image
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
        'anikeola_cbt_answers_meta_box_id',
        __( 'Question Answers & Options', 'anikeola-cbt' ),
        'anikeola_cbt_answers_meta_box_callback',
        'cbt_question',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes_cbt_question', 'anikeola_cbt_add_answers_meta_box' );

/**
 * Callback function to render the HTML for the answers meta box.
 * @param WP_Post $post The post object.
 */
function anikeola_cbt_answers_meta_box_callback( $post ) {
    wp_nonce_field( 'anikeola_cbt_save_answers_meta_box_data', 'anikeola_cbt_answers_meta_box_nonce' );

    $answer_options = get_post_meta( $post->ID, '_anikeola_cbt_answer_options', true );
    $correct_answer_index = get_post_meta( $post->ID, '_anikeola_cbt_correct_answer_index', true );

    if ( empty( $answer_options ) || !is_array($answer_options) ) { // Ensure it's an array
        $answer_options = array_fill( 0, 5, '' );
    } else {
        // Ensure we always have at least 5 elements, padding with empty strings if necessary
        $answer_options = array_pad( $answer_options, 5, '' );
    }
    
    $correct_answer_index = ( $correct_answer_index === '' || is_null($correct_answer_index) ) ? -1 : intval( $correct_answer_index ); // Use -1 if not set

    ?>
    <style>
        .anikeola-cbt-answers-container { display: flex; flex-direction: column; gap: 10px; }
        .anikeola-cbt-answer-entry { display: flex; align-items: center; padding: 8px; border: 1px solid #ccd0d4; border-radius: 4px; background-color: #fdfdfd;}
        .anikeola-cbt-answer-entry label { margin-right: 8px; font-weight: 600; min-width: 70px; }
        .anikeola-cbt-answer-entry input[type="text"] { flex-grow: 1; padding: 6px 8px; border: 1px solid #8c8f94; border-radius: 3px; }
        .anikeola-cbt-answer-entry input[type="radio"] { margin-left: 15px; margin-right: 5px; }
        .anikeola-cbt-correct-label { font-size: 0.9em; color: #555; }
        #anikeola_cbt_answers_meta_box_id .inside { padding-top: 0; margin-top:0; } /* Adjust padding for metabox */
        .anikeola-cbt-meta-box-description { margin-bottom: 15px; color: #555; font-style: italic; }
    </style>

    <p class="anikeola-cbt-meta-box-description"><?php esc_html_e( 'Enter up to 5 answer options for this question and select the correct one.', 'anikeola-cbt' ); ?></p>
    <div class="anikeola-cbt-answers-container">
        <?php
        $number_of_options = 5;
        for ( $i = 0; $i < $number_of_options; $i++ ) :
            $option_value = isset( $answer_options[$i] ) ? esc_attr( $answer_options[$i] ) : '';
            $is_checked = ( $correct_answer_index === $i );
        ?>
            <div class="anikeola-cbt-answer-entry">
                <label for="anikeola_cbt_answer_option_<?php echo $i; ?>"><?php printf( esc_html__( 'Option %d:', 'anikeola-cbt' ), $i + 1 ); ?></label>
                <input type="text" id="anikeola_cbt_answer_option_<?php echo $i; ?>" name="anikeola_cbt_answer_options[]" value="<?php echo $option_value; ?>" />
                <input type="radio" id="anikeola_cbt_correct_<?php echo $i; ?>" name="_anikeola_cbt_correct_answer_index" value="<?php echo $i; ?>" <?php checked( $is_checked, true ); ?> />
                <label for="anikeola_cbt_correct_<?php echo $i; ?>" class="anikeola-cbt-correct-label"><?php esc_html_e( 'Correct', 'anikeola-cbt' ); ?></label>
            </div>
        <?php endfor; ?>
    </div>
    <?php
    // TODO: Add fields for points per question if needed (CBT-FUNC-XXX)
    // TODO: Add field for correct answer explanation if needed (CBT-FUNC-XXX)
}

/**
 * Save the meta box data when the post is saved.
 * @param int $post_id The ID of the post being saved.
 */
function anikeola_cbt_save_answers_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['anikeola_cbt_answers_meta_box_nonce'] ) ||
         ! wp_verify_nonce( $_POST['anikeola_cbt_answers_meta_box_nonce'], 'anikeola_cbt_save_answers_meta_box_data' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Save Answer Options
    if ( isset( $_POST['anikeola_cbt_answer_options'] ) && is_array( $_POST['anikeola_cbt_answer_options'] ) ) {
        $sanitized_options = array_map( 'sanitize_text_field', $_POST['anikeola_cbt_answer_options'] );
        // Filter out empty options if you don't want to save them, or ensure a fixed number
        $filtered_options = array_filter( $sanitized_options, function($value) { return $value !== ''; } ); 
        // Or, to always save 5 (even if empty):
        // $filtered_options = array_slice( $sanitized_options, 0, 5); 
        // $filtered_options = array_pad( $filtered_options, 5, ''); // Pad with empty strings if less than 5
        update_post_meta( $post_id, '_anikeola_cbt_answer_options', $filtered_options ); // Using filtered_options to save only non-empty ones
    } else {
        delete_post_meta( $post_id, '_anikeola_cbt_answer_options' ); // Or update with empty array
    }

    // Save Correct Answer Index
    if ( isset( $_POST['_anikeola_cbt_correct_answer_index'] ) ) {
        $correct_index = intval( $_POST['_anikeola_cbt_correct_answer_index'] );
        update_post_meta( $post_id, '_anikeola_cbt_correct_answer_index', $correct_index );
    } else {
        delete_post_meta( $post_id, '_anikeola_cbt_correct_answer_index' );
    }
}
add_action( 'save_post_cbt_question', 'anikeola_cbt_save_answers_meta_box_data' );

/**
 * Flush rewrite rules on plugin activation.
 */
function anikeola_cbt_rewrite_flush() {
    anikeola_cbt_register_question_cpt();
    anikeola_cbt_register_subject_taxonomy();
    anikeola_cbt_register_class_level_taxonomy();
    anikeola_cbt_register_topic_taxonomy();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'anikeola_cbt_rewrite_flush' );

?>
