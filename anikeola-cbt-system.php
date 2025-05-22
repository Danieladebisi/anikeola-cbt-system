<?php
/**
 * Plugin Name: Anikeola CBT System Core
 * Description: Registers Custom Post Type, Taxonomies, Meta Boxes, and CSV Import for the Anikeola CBT System.
 * Version: 1.3
 * Author: Daniel Adebisi
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// --- CPT and Taxonomy Registration (from Version 1.2 - no changes here) ---
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

// --- Meta Box for Answers (from Version 1.2 - no changes here) ---
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

    if ( empty( $answer_options ) || !is_array($answer_options) ) {
        $answer_options = array_fill( 0, 5, '' );
    } else {
        $answer_options = array_pad( $answer_options, 5, '' );
    }
    
    $correct_answer_index = ( $correct_answer_index === '' || is_null($correct_answer_index) ) ? -1 : intval( $correct_answer_index );

    ?>
    <style>
        .anikeola-cbt-answers-container { display: flex; flex-direction: column; gap: 10px; }
        .anikeola-cbt-answer-entry { display: flex; align-items: center; padding: 8px; border: 1px solid #ccd0d4; border-radius: 4px; background-color: #fdfdfd;}
        .anikeola-cbt-answer-entry label { margin-right: 8px; font-weight: 600; min-width: 70px; }
        .anikeola-cbt-answer-entry input[type="text"] { flex-grow: 1; padding: 6px 8px; border: 1px solid #8c8f94; border-radius: 3px; }
        .anikeola-cbt-answer-entry input[type="radio"] { margin-left: 15px; margin-right: 5px; }
        .anikeola-cbt-correct-label { font-size: 0.9em; color: #555; }
        #anikeola_cbt_answers_meta_box_id .inside { padding-top: 0; margin-top:0; }
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
    if ( ! current_user_can( 'edit_post', $post_id ) ) { // Check for 'cbt_question' post type specifically
        return;
    }
     // Ensure this is the 'cbt_question' post type before saving meta
    if (get_post_type($post_id) != 'cbt_question') {
        return;
    }


    if ( isset( $_POST['anikeola_cbt_answer_options'] ) && is_array( $_POST['anikeola_cbt_answer_options'] ) ) {
        $sanitized_options = array_map( 'sanitize_text_field', $_POST['anikeola_cbt_answer_options'] );
        // Save all 5 options, even if some are empty, to maintain structure
        $options_to_save = array_slice( $sanitized_options, 0, 5 );
        $options_to_save = array_pad( $options_to_save, 5, ''); // Pad with empty strings if less than 5 submitted
        update_post_meta( $post_id, '_anikeola_cbt_answer_options', $options_to_save );
    } else {
        update_post_meta( $post_id, '_anikeola_cbt_answer_options', array_fill(0, 5, '') ); // Save 5 empty strings if no options submitted
    }

    if ( isset( $_POST['_anikeola_cbt_correct_answer_index'] ) ) {
        $correct_index = intval( $_POST['_anikeola_cbt_correct_answer_index'] );
        update_post_meta( $post_id, '_anikeola_cbt_correct_answer_index', $correct_index );
    } else {
        delete_post_meta( $post_id, '_anikeola_cbt_correct_answer_index' );
    }
}
add_action( 'save_post_cbt_question', 'anikeola_cbt_save_answers_meta_box_data' );


// --- NEW: CSV Import Functionality ---

/**
 * Add submenu page for CSV Import under "CBT Questions".
 */
function anikeola_cbt_add_import_submenu_page() {
    add_submenu_page(
        'edit.php?post_type=cbt_question', // Parent slug (for our CPT)
        __( 'Import Questions', 'anikeola-cbt' ),    // Page title
        __( 'Import CSV', 'anikeola-cbt' ),        // Menu title
        'manage_options',                         // Capability required
        'anikeola-cbt-import',                    // Menu slug
        'anikeola_cbt_render_import_page'         // Function to display the page
    );
}
add_action( 'admin_menu', 'anikeola_cbt_add_import_submenu_page' );

/**
 * Render the CSV Import page.
 */
function anikeola_cbt_render_import_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Import CBT Questions from CSV', 'anikeola-cbt' ); ?></h1>
        <p><?php esc_html_e( 'Upload a CSV file to import questions into the CBT system.', 'anikeola-cbt' ); ?></p>
        <p>
            <?php esc_html_e( 'Expected CSV Format (headerless, 11 columns):', 'anikeola-cbt' ); ?><br>
            <code>Question Title, Answer 1, Answer 2, Answer 3, Answer 4, Answer 5 (optional), Correct Answer Index (1-5), Subject, Class Level, Topic, Question Description (optional)</code>
        </p>
        <p>
            <em><?php esc_html_e( 'Example Row: Which of these is the powerhouse of the cell?,Nucleus,Mitochondria,Ribosome,Endoplasmic Reticulum,,2,Biology,JSS 1,Cell Structure,This question tests basic cell biology knowledge.', 'anikeola-cbt' ); ?></em><br>
            <em>(This example has 4 answer options, so Answer 5 is blank. Answer 2 is correct. Question Description is included.)</em>
        </p>

        <form method="post" enctype="multipart/form-data" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <input type="hidden" name="action" value="anikeola_cbt_handle_csv_upload">
            <?php wp_nonce_field( 'anikeola_cbt_csv_import_nonce', 'anikeola_cbt_csv_import_nonce_field' ); ?>
            
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="cbt_csv_file"><?php esc_html_e( 'CSV File:', 'anikeola-cbt' ); ?></label>
                    </th>
                    <td>
                        <input type="file" id="cbt_csv_file" name="cbt_csv_file" accept=".csv" required />
                        <p class="description"><?php esc_html_e( 'Please ensure the file is UTF-8 encoded.', 'anikeola-cbt' ); ?></p>
                    </td>
                </tr>
            </table>
            <?php submit_button( __( 'Import Questions', 'anikeola-cbt' ) ); ?>
        </form>
    </div>
    <?php
}

/**
 * Handle the CSV file upload and process questions.
 * Hooked to admin_post_{action_name}
 */
function anikeola_cbt_handle_csv_upload_action() {
    // Verify nonce
    if ( ! isset( $_POST['anikeola_cbt_csv_import_nonce_field'] ) || ! wp_verify_nonce( $_POST['anikeola_cbt_csv_import_nonce_field'], 'anikeola_cbt_csv_import_nonce' ) ) {
        wp_die( esc_html__( 'Security check failed!', 'anikeola-cbt' ) );
    }

    // Check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) { // Or a more specific capability for managing questions
        wp_die( esc_html__( 'You do not have sufficient permissions to perform this action.', 'anikeola-cbt' ) );
    }

    // Check if file was uploaded
    if ( isset( $_FILES['cbt_csv_file'] ) && $_FILES['cbt_csv_file']['error'] == UPLOAD_ERR_OK ) {
        $file_tmp_path = $_FILES['cbt_csv_file']['tmp_name'];
        $file_name = $_FILES['cbt_csv_file']['name'];
        $file_type = $_FILES['cbt_csv_file']['type'];

        // Basic validation for file type (can be spoofed, but a first check)
        $allowed_mime_types = array( 'text/csv', 'application/csv', 'text/plain', 'application/vnd.ms-excel' );
        if ( ! in_array( $file_type, $allowed_mime_types ) ) {
            wp_redirect( add_query_arg( array( 'page' => 'anikeola-cbt-import', 'message' => 'invalid_file_type' ), admin_url( 'edit.php?post_type=cbt_question' ) ) );
            exit;
        }

        // Increase execution time and memory limit for potentially large CSV files
        @set_time_limit(0);
        @ini_set('memory_limit', '256M');

        $imported_count = 0;
        $failed_rows = array();
        $row_number = 0;

        if ( ( $handle = fopen( $file_tmp_path, 'r' ) ) !== false ) {
            while ( ( $data = fgetcsv( $handle, 2000, ',' ) ) !== false ) { // Read up to 2000 chars per line
                $row_number++;
                // Expected 11 columns based on our defined format
                // Question Title, Ans1, Ans2, Ans3, Ans4, Ans5, CorrectIndex, Subject, ClassLevel, Topic, Description
                if ( count( $data ) < 10 ) { // Minimum 10 columns (Description can be missing)
                    $failed_rows[] = $row_number;
                    continue;
                }

                // Sanitize and prepare data
                $question_title = sanitize_text_field( trim( $data[0] ) );
                $answer_options_raw = array_slice( $data, 1, 5 ); // Get up to 5 answers
                $answer_options = array();
                foreach($answer_options_raw as $opt) {
                    $answer_options[] = sanitize_text_field(trim($opt));
                }
                // Ensure we always have 5 answer options, padding with empty if fewer
                $answer_options = array_pad($answer_options, 5, '');


                $correct_answer_index_raw = isset($data[6]) ? trim($data[6]) : '';
                // Adjust index: CSV is 1-based, our meta is 0-based
                $correct_answer_index = ( is_numeric($correct_answer_index_raw) && $correct_answer_index_raw >= 1 && $correct_answer_index_raw <= 5 ) ? intval( $correct_answer_index_raw ) - 1 : -1;

                $subject_name     = isset($data[7]) ? sanitize_text_field( trim( $data[7] ) ) : '';
                $class_level_name = isset($data[8]) ? sanitize_text_field( trim( $data[8] ) ) : '';
                $topic_name       = isset($data[9]) ? sanitize_text_field( trim( $data[9] ) ) : '';
                $question_content = isset($data[10]) ? wp_kses_post( trim( $data[10] ) ) : ''; // Allow some HTML for description

                if ( empty( $question_title ) || $correct_answer_index === -1 ) {
                    $failed_rows[] = $row_number;
                    continue;
                }

                // Create new cbt_question post
                $post_data = array(
                    'post_title'   => $question_title,
                    'post_content' => $question_content,
                    'post_type'    => 'cbt_question',
                    'post_status'  => 'publish', // Or 'draft' if you want to review them
                );
                $post_id = wp_insert_post( $post_data );

                if ( $post_id && ! is_wp_error( $post_id ) ) {
                    // Save answer options and correct index
                    update_post_meta( $post_id, '_anikeola_cbt_answer_options', $answer_options );
                    update_post_meta( $post_id, '_anikeola_cbt_correct_answer_index', $correct_answer_index );

                    // Assign taxonomies
                    if ( ! empty( $subject_name ) ) {
                        wp_set_object_terms( $post_id, $subject_name, 'cbt_subject', false );
                    }
                    if ( ! empty( $class_level_name ) ) {
                        wp_set_object_terms( $post_id, $class_level_name, 'cbt_class_level', false );
                    }
                    if ( ! empty( $topic_name ) ) {
                        wp_set_object_terms( $post_id, $topic_name, 'cbt_topic', false );
                    }
                    $imported_count++;
                } else {
                    $failed_rows[] = $row_number;
                }
            }
            fclose( $handle );

            // Redirect back with a success/error message
            $redirect_args = array(
                'page' => 'anikeola-cbt-import',
                'message' => 'imported',
                'count' => $imported_count
            );
            if(!empty($failed_rows)) {
                $redirect_args['failed_count'] = count($failed_rows);
                // Optionally, pass failed row numbers if not too many: $redirect_args['failed_rows'] = implode(',', $failed_rows);
            }
            wp_redirect( add_query_arg( $redirect_args, admin_url( 'edit.php?post_type=cbt_question' ) ) );
            exit;

        } else {
            wp_redirect( add_query_arg( array( 'page' => 'anikeola-cbt-import', 'message' => 'file_read_error' ), admin_url( 'edit.php?post_type=cbt_question' ) ) );
            exit;
        }
    } else {
        // No file uploaded or an error occurred
        $error_code = isset($_FILES['cbt_csv_file']['error']) ? $_FILES['cbt_csv_file']['error'] : 'unknown';
        wp_redirect( add_query_arg( array( 'page' => 'anikeola-cbt-import', 'message' => 'upload_error', 'code' => $error_code ), admin_url( 'edit.php?post_type=cbt_question' ) ) );
        exit;
    }
}
add_action( 'admin_post_anikeola_cbt_handle_csv_upload', 'anikeola_cbt_handle_csv_upload_action' );

/**
 * Display admin notices for CSV import.
 */
function anikeola_cbt_import_admin_notices() {
    if ( ! isset( $_GET['page'] ) || 'anikeola-cbt-import' !== $_GET['page'] ) {
        return;
    }

    if ( isset( $_GET['message'] ) ) {
        $message = '';
        $type = 'info'; // Default type

        switch ( $_GET['message'] ) {
            case 'imported':
                $count = isset( $_GET['count'] ) ? intval( $_GET['count'] ) : 0;
                $message = sprintf( esc_html__( '%d questions imported successfully.', 'anikeola-cbt' ), $count );
                if(isset($_GET['failed_count']) && intval($_GET['failed_count']) > 0) {
                    $message .= ' ' . sprintf( esc_html__( '%d rows failed to import.', 'anikeola-cbt' ), intval($_GET['failed_count']) );
                }
                $type = 'success';
                break;
            case 'invalid_file_type':
                $message = esc_html__( 'Error: Invalid file type. Please upload a CSV file.', 'anikeola-cbt' );
                $type = 'error';
                break;
            case 'file_read_error':
                $message = esc_html__( 'Error: Could not read the uploaded file.', 'anikeola-cbt' );
                $type = 'error';
                break;
            case 'upload_error':
                $code = isset($_GET['code']) ? $_GET['code'] : 'unknown';
                $message = sprintf(esc_html__( 'Error: File upload failed. Code: %s', 'anikeola-cbt' ), $code);
                $type = 'error';
                break;
        }

        if ( $message ) {
            echo '<div class="notice notice-' . esc_attr( $type ) . ' is-dismissible"><p>' . $message . '</p></div>';
        }
    }
}
add_action( 'admin_notices', 'anikeola_cbt_import_admin_notices' );


// --- Activation Hook (from Version 1.2 - no changes here) ---
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
