<?php
/**
 * Plugin Name: Anikeola CBT System Core
 * Description: Registers CPTs, Taxonomies, Meta Boxes, CSV Import, and Exam functionality for the Anikeola CBT System.
 * Version: 1.7
 * Author: Daniel Adebisi
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// --- CBT Question Custom Post Type and Taxonomies (No changes from Version 1.6) ---
/**
 * Register CBT Question Custom Post Type.
 */
function anikeola_cbt_register_question_cpt() {
    $labels = array(
        'name'                  => _x( 'CBT Questions', 'Post Type General Name', 'anikeola-cbt' ),
        'singular_name'         => _x( 'CBT Question', 'Post Type Singular Name', 'anikeola-cbt' ),
        'menu_name'             => __( 'Question Bank', 'anikeola-cbt' ),
        'name_admin_bar'        => __( 'CBT Question', 'anikeola-cbt' ),
        'archives'              => __( 'Question Archives', 'anikeola-cbt' ),
        'attributes'            => __( 'Question Attributes', 'anikeola-cbt' ),
        'parent_item_colon'     => __( 'Parent Question:', 'anikeola-cbt' ),
        'all_items'             => __( 'All Questions', 'anikeola-cbt' ),
        'add_new_item'          => __( 'Add New Question', 'anikeola-cbt' ),
        'add_new'               => __( 'Add New Question', 'anikeola-cbt' ),
        'new_item'              => __( 'New Question', 'anikeola-cbt' ),
        'edit_item'             => __( 'Edit Question', 'anikeola-cbt' ),
        'update_item'           => __( 'Update Question', 'anikeola-cbt' ),
        'view_item'             => __( 'View Question', 'anikeola-cbt' ),
        'view_items'            => __( 'View Questions', 'anikeola-cbt' ),
        'search_items'          => __( 'Search Questions', 'anikeola-cbt' ),
        'not_found'             => __( 'No questions found.', 'anikeola-cbt' ),
        'not_found_in_trash'    => __( 'No questions found in Trash.', 'anikeola-cbt' ),
        'items_list'            => __( 'Questions list', 'anikeola-cbt' ),
        'items_list_navigation' => __( 'Questions list navigation', 'anikeola-cbt' ),
        'filter_items_list'     => __( 'Filter questions list', 'anikeola-cbt' ),
    );
    $args = array(
        'label'                 => __( 'CBT Question', 'anikeola-cbt' ),
        'description'           => __( 'Individual questions for the CBT system question bank.', 'anikeola-cbt' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor' ),
        'taxonomies'            => array( 'cbt_subject', 'cbt_class_level', 'cbt_topic' ),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => 'edit.php?post_type=cbt_exam',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    register_post_type( 'cbt_question', $args );
}
add_action( 'init', 'anikeola_cbt_register_question_cpt', 0 );

/**
 * Register CBT Exam Custom Post Type.
 */
function anikeola_cbt_register_exam_cpt() {
    $labels = array(
        'name'                  => _x( 'CBT Exams', 'Post Type General Name', 'anikeola-cbt' ),
        'singular_name'         => _x( 'CBT Exam', 'Post Type Singular Name', 'anikeola-cbt' ),
        'menu_name'             => __( 'CBT Exams', 'anikeola-cbt' ),
        'name_admin_bar'        => __( 'CBT Exam', 'anikeola-cbt' ),
        'archives'              => __( 'Exam Archives', 'anikeola-cbt' ),
        'attributes'            => __( 'Exam Attributes', 'anikeola-cbt' ),
        'parent_item_colon'     => __( 'Parent Exam:', 'anikeola-cbt' ),
        'all_items'             => __( 'All Exams', 'anikeola-cbt' ),
        'add_new_item'          => __( 'Add New Exam', 'anikeola-cbt' ),
        'add_new'               => __( 'Add New Exam', 'anikeola-cbt' ),
        'new_item'              => __( 'New Exam', 'anikeola-cbt' ),
        'edit_item'             => __( 'Edit Exam', 'anikeola-cbt' ),
        'update_item'           => __( 'Update Exam', 'anikeola-cbt' ),
        'view_item'             => __( 'View Exam (Admin)', 'anikeola-cbt' ),
        'view_items'            => __( 'View Exams (Admin)', 'anikeola-cbt' ),
        'search_items'          => __( 'Search Exams', 'anikeola-cbt' ),
        'not_found'             => __( 'No exams found.', 'anikeola-cbt' ),
        'not_found_in_trash'    => __( 'No exams found in Trash.', 'anikeola-cbt' ),
        'items_list'            => __( 'Exams list', 'anikeola-cbt' ),
        'items_list_navigation' => __( 'Exams list navigation', 'anikeola-cbt' ),
        'filter_items_list'     => __( 'Filter exams list', 'anikeola-cbt' ),
    );
    $args = array(
        'label'                 => __( 'CBT Exam', 'anikeola-cbt' ),
        'description'           => __( 'Custom Post Type for creating and managing CBT Exams.', 'anikeola-cbt' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 25,
        'menu_icon'             => 'dashicons-welcome-learn-more',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
         'taxonomies'            => array( 'cbt_subject', 'cbt_class_level' ),
    );
    register_post_type( 'cbt_exam', $args );
}
add_action( 'init', 'anikeola_cbt_register_exam_cpt', 0 );


// Taxonomies (Subject, Class Level, Topic) - No changes from Version 1.6
function anikeola_cbt_register_subject_taxonomy() {
    $labels = array('name' => _x( 'Subjects', 'taxonomy general name', 'anikeola-cbt' ), 'singular_name' => _x( 'Subject', 'taxonomy singular name', 'anikeola-cbt' ), 'menu_name' => __( 'Subjects', 'anikeola-cbt' ),);
    $args = array('hierarchical' => true, 'labels' => $labels, 'show_ui' => true, 'show_admin_column' => true, 'query_var' => true, 'rewrite' => array( 'slug' => 'cbt-subject' ), 'show_in_rest' => true,);
    register_taxonomy( 'cbt_subject', array( 'cbt_question', 'cbt_exam' ), $args );
}
add_action( 'init', 'anikeola_cbt_register_subject_taxonomy', 0 );

function anikeola_cbt_register_class_level_taxonomy() {
    $labels = array('name' => _x( 'Class Levels', 'taxonomy general name', 'anikeola-cbt' ), 'singular_name' => _x( 'Class Level', 'taxonomy singular name', 'anikeola-cbt' ), 'menu_name' => __( 'Class Levels', 'anikeola-cbt' ),);
    $args = array('hierarchical' => true, 'labels' => $labels, 'show_ui' => true, 'show_admin_column' => true, 'query_var' => true, 'rewrite' => array( 'slug' => 'cbt-class-level' ), 'show_in_rest' => true,);
    register_taxonomy( 'cbt_class_level', array( 'cbt_question', 'cbt_exam' ), $args );
}
add_action( 'init', 'anikeola_cbt_register_class_level_taxonomy', 0 );

function anikeola_cbt_register_topic_taxonomy() {
    $labels = array('name' => _x( 'Topics', 'taxonomy general name', 'anikeola-cbt' ), 'singular_name' => _x( 'Topic', 'taxonomy singular name', 'anikeola-cbt' ), 'menu_name' => __( 'Topics', 'anikeola-cbt' ),);
    $args = array('hierarchical' => true, 'labels' => $labels, 'show_ui' => true, 'show_admin_column' => true, 'query_var' => true, 'rewrite' => array( 'slug' => 'cbt-topic' ), 'show_in_rest' => true,);
    register_taxonomy( 'cbt_topic', array( 'cbt_question' ), $args );
}
add_action( 'init', 'anikeola_cbt_register_topic_taxonomy', 0 );


// --- Meta Box for Question Answers (No changes from Version 1.6) ---
function anikeola_cbt_add_answers_meta_box() {
    add_meta_box('anikeola_cbt_answers_meta_box_id', __( 'Question Options', 'anikeola-cbt' ), 'anikeola_cbt_answers_meta_box_callback', 'cbt_question', 'normal', 'high');
}
add_action( 'add_meta_boxes_cbt_question', 'anikeola_cbt_add_answers_meta_box' );

function anikeola_cbt_answers_meta_box_callback( $post ) {
    wp_nonce_field( 'anikeola_cbt_save_answers_meta_box_data', 'anikeola_cbt_answers_meta_box_nonce' );
    $answer_options = get_post_meta( $post->ID, '_anikeola_cbt_answer_options', true );
    $correct_answer_index = get_post_meta( $post->ID, '_anikeola_cbt_correct_answer_index', true );
    if ( empty( $answer_options ) || !is_array($answer_options) ) { $answer_options = array_fill( 0, 5, '' ); } else { $answer_options = array_pad( $answer_options, 5, '' ); }
    $correct_answer_index = ( $correct_answer_index === '' || is_null($correct_answer_index) ) ? -1 : intval( $correct_answer_index );
    ?>
    <style>
        .anikeola-cbt-answers-container { display: flex; flex-direction: column; gap: 10px; margin-top:10px;}
        .anikeola-cbt-answer-entry { display: flex; align-items: center; padding: 8px; border: 1px solid #ccd0d4; border-radius: 4px; background-color: #fdfdfd;}
        .anikeola-cbt-answer-entry label.option-label { margin-right: 8px; font-weight: 600; min-width: 70px; }
        .anikeola-cbt-answer-entry input[type="text"] { flex-grow: 1; padding: 6px 8px; border: 1px solid #8c8f94; border-radius: 3px; }
        .anikeola-cbt-answer-entry input[type="radio"] { margin-left: 15px; margin-right: 5px; }
        .anikeola-cbt-correct-label { font-size: 0.9em; color: #555; cursor:pointer; }
        .anikeola-cbt-meta-box-description { margin-bottom: 15px; color: #555; font-style: italic; }
    </style>
    <p class="anikeola-cbt-meta-box-description"><?php esc_html_e( 'Enter up to 5 answer options. Select the radio button next to the correct answer.', 'anikeola-cbt' ); ?></p>
    <div class="anikeola-cbt-answers-container">
        <?php
        $number_of_options = 5;
        for ( $i = 0; $i < $number_of_options; $i++ ) :
            $option_value = isset( $answer_options[$i] ) ? esc_attr( $answer_options[$i] ) : '';
            $is_checked = ( $correct_answer_index === $i );
        ?>
            <div class="anikeola-cbt-answer-entry">
                <label for="anikeola_cbt_answer_option_<?php echo $i; ?>" class="option-label"><?php printf( esc_html__( 'Option %d:', 'anikeola-cbt' ), $i + 1 ); ?></label>
                <input type="text" id="anikeola_cbt_answer_option_<?php echo $i; ?>" name="anikeola_cbt_answer_options[]" value="<?php echo $option_value; ?>" />
                <input type="radio" id="anikeola_cbt_correct_<?php echo $i; ?>" name="_anikeola_cbt_correct_answer_index" value="<?php echo $i; ?>" <?php checked( $is_checked, true ); ?> />
                <label for="anikeola_cbt_correct_<?php echo $i; ?>" class="anikeola-cbt-correct-label"><?php esc_html_e( 'Correct', 'anikeola-cbt' ); ?></label>
            </div>
        <?php endfor; ?>
    </div>
    <?php
}

function anikeola_cbt_save_answers_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['anikeola_cbt_answers_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['anikeola_cbt_answers_meta_box_nonce'], 'anikeola_cbt_save_answers_meta_box_data' ) ) { return; }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
    if ( get_post_type($post_id) != 'cbt_question' || ! current_user_can( 'edit_post', $post_id ) ) { return; }

    if ( isset( $_POST['anikeola_cbt_answer_options'] ) && is_array( $_POST['anikeola_cbt_answer_options'] ) ) {
        $sanitized_options = array_map( 'sanitize_text_field', $_POST['anikeola_cbt_answer_options'] );
        $options_to_save = array_slice( $sanitized_options, 0, 5 );
        $options_to_save = array_pad( $options_to_save, 5, '');
        update_post_meta( $post_id, '_anikeola_cbt_answer_options', $options_to_save );
    } else { update_post_meta( $post_id, '_anikeola_cbt_answer_options', array_fill(0, 5, '') ); }

    if ( isset( $_POST['_anikeola_cbt_correct_answer_index'] ) ) {
        update_post_meta( $post_id, '_anikeola_cbt_correct_answer_index', intval( $_POST['_anikeola_cbt_correct_answer_index'] ) );
    } else { delete_post_meta( $post_id, '_anikeola_cbt_correct_answer_index' ); }
}
add_action( 'save_post_cbt_question', 'anikeola_cbt_save_answers_meta_box_data' );


// --- Meta Box for Exam Settings (No changes from Version 1.6) ---
function anikeola_cbt_add_exam_settings_meta_box() {
    add_meta_box('anikeola_cbt_exam_settings_meta_box_id',__( 'Exam Settings', 'anikeola-cbt' ),'anikeola_cbt_exam_settings_meta_box_callback','cbt_exam','normal','high');
}
add_action( 'add_meta_boxes_cbt_exam', 'anikeola_cbt_add_exam_settings_meta_box' );

function anikeola_cbt_exam_settings_meta_box_callback( $post ) {
    wp_nonce_field( 'anikeola_cbt_save_exam_settings_meta_box_data', 'anikeola_cbt_exam_settings_meta_box_nonce' );
    $time_limit = get_post_meta( $post->ID, '_anikeola_cbt_time_limit', true );
    $passing_score = get_post_meta( $post->ID, '_anikeola_cbt_passing_score', true );
    $attempts_allowed = get_post_meta( $post->ID, '_anikeola_cbt_attempts_allowed', true );
    ?>
    <table class="form-table">
        <tbody>
            <tr><th scope="row"><label for="anikeola_cbt_time_limit"><?php esc_html_e( 'Time Limit (minutes)', 'anikeola-cbt' ); ?></label></th><td><input type="number" id="anikeola_cbt_time_limit" name="_anikeola_cbt_time_limit" value="<?php echo esc_attr( $time_limit ); ?>" min="0" step="1" /><p class="description"><?php esc_html_e( 'Enter 0 or leave blank for no time limit.', 'anikeola-cbt' ); ?></p></td></tr>
            <tr><th scope="row"><label for="anikeola_cbt_passing_score"><?php esc_html_e( 'Passing Score (%)', 'anikeola-cbt' ); ?></label></th><td><input type="number" id="anikeola_cbt_passing_score" name="_anikeola_cbt_passing_score" value="<?php echo esc_attr( $passing_score ); ?>" min="0" max="100" step="1" /><p class="description"><?php esc_html_e( 'Enter a percentage (0-100).', 'anikeola-cbt' ); ?></p></td></tr>
            <tr><th scope="row"><label for="anikeola_cbt_attempts_allowed"><?php esc_html_e( 'Attempts Allowed', 'anikeola-cbt' ); ?></label></th><td><input type="number" id="anikeola_cbt_attempts_allowed" name="_anikeola_cbt_attempts_allowed" value="<?php echo esc_attr( $attempts_allowed ); ?>" min="0" step="1" /><p class="description"><?php esc_html_e( 'Enter 0 or leave blank for unlimited attempts.', 'anikeola-cbt' ); ?></p></td></tr>
        </tbody>
    </table>
    <?php
}

function anikeola_cbt_save_exam_settings_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['anikeola_cbt_exam_settings_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['anikeola_cbt_exam_settings_meta_box_nonce'], 'anikeola_cbt_save_exam_settings_meta_box_data' ) ) { return; }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
    if ( get_post_type($post_id) != 'cbt_exam' || ! current_user_can( 'edit_post', $post_id ) ) { return; }
    if ( isset( $_POST['_anikeola_cbt_time_limit'] ) ) { update_post_meta( $post_id, '_anikeola_cbt_time_limit', sanitize_text_field( $_POST['_anikeola_cbt_time_limit'] ) ); }
    if ( isset( $_POST['_anikeola_cbt_passing_score'] ) ) { update_post_meta( $post_id, '_anikeola_cbt_passing_score', sanitize_text_field( $_POST['_anikeola_cbt_passing_score'] ) ); }
    if ( isset( $_POST['_anikeola_cbt_attempts_allowed'] ) ) { update_post_meta( $post_id, '_anikeola_cbt_attempts_allowed', sanitize_text_field( $_POST['_anikeola_cbt_attempts_allowed'] ) ); }
}
add_action( 'save_post_cbt_exam', 'anikeola_cbt_save_exam_settings_meta_box_data' );


// --- Meta Box for Managing Exam Questions (No changes from Version 1.6) ---
function anikeola_cbt_add_manage_questions_meta_box() {
    add_meta_box('anikeola_cbt_manage_questions_meta_box_id',__( 'Manage Exam Questions', 'anikeola-cbt' ),'anikeola_cbt_manage_questions_meta_box_callback','cbt_exam','normal','high');
}
add_action( 'add_meta_boxes_cbt_exam', 'anikeola_cbt_add_manage_questions_meta_box' );

function anikeola_cbt_manage_questions_meta_box_callback( $post ) {
    wp_nonce_field( 'anikeola_cbt_save_manage_questions_meta_box_data', 'anikeola_cbt_manage_questions_meta_box_nonce' );
    $selected_question_ids = get_post_meta( $post->ID, '_anikeola_cbt_exam_question_ids', true );
    if ( ! is_array( $selected_question_ids ) ) { $selected_question_ids = array(); }
    $question_ids_string = implode( ',', $selected_question_ids );
    ?>
    <style>
        #anikeola_cbt_selected_questions_list li { background: #f9f9f9; border: 1px solid #eee; padding: 5px 10px; margin-bottom: 5px; border-radius: 3px; }
        .anikeola-cbt-question-selector-area { margin-top: 15px; }
        .anikeola-cbt-question-selector-area textarea { width: 100%; min-height: 100px; }
        .anikeola-cbt-question-selector-area .description { margin-top: 5px; }
    </style>
    <h4><?php esc_html_e( 'Selected Questions for this Exam:', 'anikeola-cbt' ); ?></h4>
    <div id="anikeola_cbt_selected_questions_list_container">
        <?php if ( ! empty( $selected_question_ids ) ) : ?>
            <ol id="anikeola_cbt_selected_questions_list">
                <?php foreach ( $selected_question_ids as $q_id ) : 
                    $question_title = get_the_title( $q_id );
                    if ( $question_title ) : ?>
                    <li><?php echo esc_html( $question_title ); ?> (ID: <?php echo esc_html( $q_id ); ?>)</li>
                <?php endif; endforeach; ?>
            </ol>
        <?php else : ?><p><?php esc_html_e( 'No questions have been added to this exam yet.', 'anikeola-cbt' ); ?></p><?php endif; ?>
    </div>
    <div class="anikeola-cbt-question-selector-area">
        <h4><?php esc_html_e( 'Add/Edit Question IDs', 'anikeola-cbt' ); ?></h4>
        <p class="description"><?php esc_html_e( 'Enter a comma-separated list of Question IDs from the Question Bank to include in this exam.', 'anikeola-cbt' ); ?><br><em><?php esc_html_e( 'Example: 12,34,56,7. You can find Question IDs in the "All Questions" list in the Question Bank.', 'anikeola-cbt' ); ?></em></p>
        <textarea id="anikeola_cbt_question_ids_input" name="_anikeola_cbt_exam_question_ids_input"><?php echo esc_textarea( $question_ids_string ); ?></textarea>
        <p class="description"><em><?php esc_html_e( 'Note: This is a basic input method. A more advanced question selector will be implemented later. Saving the exam will update the list above based on these IDs.', 'anikeola-cbt' ); ?></em></p>
    </div>
    <?php
}

function anikeola_cbt_save_manage_questions_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['anikeola_cbt_manage_questions_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['anikeola_cbt_manage_questions_meta_box_nonce'], 'anikeola_cbt_save_manage_questions_meta_box_data' ) ) { return; }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
    if ( get_post_type($post_id) != 'cbt_exam' || ! current_user_can( 'edit_post', $post_id ) ) { return; }
    if ( isset( $_POST['_anikeola_cbt_exam_question_ids_input'] ) ) {
        $ids_string = sanitize_text_field( $_POST['_anikeola_cbt_exam_question_ids_input'] );
        $question_ids = array_map( 'intval', explode( ',', $ids_string ) );
        $question_ids = array_filter( $question_ids, function($id) { return $id > 0; } );
        update_post_meta( $post_id, '_anikeola_cbt_exam_question_ids', $question_ids );
    } else { delete_post_meta( $post_id, '_anikeola_cbt_exam_question_ids' ); }
}
add_action( 'save_post_cbt_exam', 'anikeola_cbt_save_manage_questions_meta_box_data' );


// --- CSV Import Functionality (No changes from Version 1.6) ---
function anikeola_cbt_add_import_submenu_page() {
    add_submenu_page('edit.php?post_type=cbt_exam',__( 'Import Questions', 'anikeola-cbt' ),__( 'Import Questions CSV', 'anikeola-cbt' ),'manage_options','anikeola-cbt-import-questions','anikeola_cbt_render_import_page');
}
add_action( 'admin_menu', 'anikeola_cbt_add_import_submenu_page' );

function anikeola_cbt_render_import_page() { /* ... same as v1.6 ... */ 
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Import CBT Questions from CSV', 'anikeola-cbt' ); ?></h1>
        <p><?php esc_html_e( 'Upload a CSV file to bulk import questions into the Question Bank.', 'anikeola-cbt' ); ?></p>
        <p><strong><?php esc_html_e( 'Expected CSV Format (headerless, 11 columns):', 'anikeola-cbt' ); ?></strong><br>
            <code>Question Title, Answer 1, Answer 2, Answer 3, Answer 4, Answer 5 (optional), Correct Answer Index (1-5), Subject, Class Level, Topic, Question Description (optional)</code>
        </p>
        <p><em><?php esc_html_e( 'Example Row: Which of these is the powerhouse of the cell?,Nucleus,Mitochondria,Ribosome,Endoplasmic Reticulum,,2,Biology,JSS 1,Cell Structure,This question tests basic cell biology knowledge.', 'anikeola-cbt' ); ?></em></p>
        <form method="post" enctype="multipart/form-data" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <input type="hidden" name="action" value="anikeola_cbt_handle_csv_upload">
            <?php wp_nonce_field( 'anikeola_cbt_csv_import_nonce', 'anikeola_cbt_csv_import_nonce_field' ); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="cbt_csv_file"><?php esc_html_e( 'CSV File:', 'anikeola-cbt' ); ?></label></th>
                    <td><input type="file" id="cbt_csv_file" name="cbt_csv_file" accept=".csv" required /><p class="description"><?php esc_html_e( 'Please ensure the file is UTF-8 encoded and follows the specified format.', 'anikeola-cbt' ); ?></p></td>
                </tr>
            </table>
            <?php submit_button( __( 'Import Questions', 'anikeola-cbt' ) ); ?>
        </form>
    </div>
    <?php
}

function anikeola_cbt_handle_csv_upload_action() { /* ... same as v1.6 ... */ 
    if ( ! isset( $_POST['anikeola_cbt_csv_import_nonce_field'] ) || ! wp_verify_nonce( $_POST['anikeola_cbt_csv_import_nonce_field'], 'anikeola_cbt_csv_import_nonce' ) ) { wp_die( esc_html__( 'Security check failed!', 'anikeola-cbt' ) ); }
    if ( ! current_user_can( 'manage_options' ) ) { wp_die( esc_html__( 'You do not have sufficient permissions.', 'anikeola-cbt' ) ); }

    if ( isset( $_FILES['cbt_csv_file'] ) && $_FILES['cbt_csv_file']['error'] == UPLOAD_ERR_OK ) {
        $file_tmp_path = $_FILES['cbt_csv_file']['tmp_name'];
        $allowed_mime_types = array( 'text/csv', 'application/csv', 'text/plain', 'application/vnd.ms-excel' );
        if ( ! in_array( mime_content_type($file_tmp_path), $allowed_mime_types ) ) {
            wp_redirect( add_query_arg( array( 'page' => 'anikeola-cbt-import-questions', 'message' => 'invalid_file_type' ), admin_url( 'edit.php?post_type=cbt_exam' ) ) ); exit;
        }

        @set_time_limit(0); @ini_set('memory_limit', '256M');
        $imported_count = 0; $failed_rows = array(); $row_number = 0;

        if ( ( $handle = fopen( $file_tmp_path, 'r' ) ) !== false ) {
            while ( ( $data = fgetcsv( $handle, 2000, ',' ) ) !== false ) {
                $row_number++;
                if ( count( $data ) < 10 ) { $failed_rows[] = $row_number; continue; }

                $question_title = sanitize_text_field( trim( $data[0] ) );
                $answer_options_raw = array_slice( $data, 1, 5 );
                $answer_options = array_map(function($opt) { return sanitize_text_field(trim($opt)); }, $answer_options_raw);
                $answer_options = array_pad($answer_options, 5, '');
                $correct_answer_index_raw = isset($data[6]) ? trim($data[6]) : '';
                $correct_answer_index = ( is_numeric($correct_answer_index_raw) && $correct_answer_index_raw >= 1 && $correct_answer_index_raw <= 5 ) ? intval( $correct_answer_index_raw ) - 1 : -1;
                $subject_name     = isset($data[7]) ? sanitize_text_field( trim( $data[7] ) ) : '';
                $class_level_name = isset($data[8]) ? sanitize_text_field( trim( $data[8] ) ) : '';
                $topic_name       = isset($data[9]) ? sanitize_text_field( trim( $data[9] ) ) : '';
                $question_content = isset($data[10]) ? wp_kses_post( trim( $data[10] ) ) : '';

                if ( empty( $question_title ) || $correct_answer_index === -1 ) { $failed_rows[] = $row_number; continue; }

                $post_data = array('post_title' => $question_title, 'post_content' => $question_content, 'post_type' => 'cbt_question', 'post_status' => 'publish');
                $post_id = wp_insert_post( $post_data );

                if ( $post_id && ! is_wp_error( $post_id ) ) {
                    update_post_meta( $post_id, '_anikeola_cbt_answer_options', $answer_options );
                    update_post_meta( $post_id, '_anikeola_cbt_correct_answer_index', $correct_answer_index );
                    if ( ! empty( $subject_name ) ) { wp_set_object_terms( $post_id, $subject_name, 'cbt_subject', false ); }
                    if ( ! empty( $class_level_name ) ) { wp_set_object_terms( $post_id, $class_level_name, 'cbt_class_level', false ); }
                    if ( ! empty( $topic_name ) ) { wp_set_object_terms( $post_id, $topic_name, 'cbt_topic', false ); }
                    $imported_count++;
                } else { $failed_rows[] = $row_number; }
            }
            fclose( $handle );
            $redirect_args = array('page' => 'anikeola-cbt-import-questions', 'message' => 'imported', 'count' => $imported_count);
            if(!empty($failed_rows)) { $redirect_args['failed_count'] = count($failed_rows); }
            wp_redirect( add_query_arg( $redirect_args, admin_url( 'edit.php?post_type=cbt_exam' ) ) ); exit;
        } else { wp_redirect( add_query_arg( array( 'page' => 'anikeola-cbt-import-questions', 'message' => 'file_read_error' ), admin_url( 'edit.php?post_type=cbt_exam' ) ) ); exit; }
    } else { $error_code = isset($_FILES['cbt_csv_file']['error']) ? $_FILES['cbt_csv_file']['error'] : 'unknown'; wp_redirect( add_query_arg( array( 'page' => 'anikeola-cbt-import-questions', 'message' => 'upload_error', 'code' => $error_code ), admin_url( 'edit.php?post_type=cbt_exam' ) ) ); exit; }
}
add_action( 'admin_post_anikeola_cbt_handle_csv_upload', 'anikeola_cbt_handle_csv_upload_action' );

function anikeola_cbt_import_admin_notices() { /* ... same as v1.6 ... */ 
    if ( ! isset( $_GET['page'] ) || 'anikeola-cbt-import-questions' !== $_GET['page'] ) { return; }
    if ( isset( $_GET['message'] ) ) {
        $message = ''; $type = 'info';
        switch ( $_GET['message'] ) {
            case 'imported':
                $count = isset( $_GET['count'] ) ? intval( $_GET['count'] ) : 0;
                $message = sprintf( esc_html__( '%d questions imported successfully into the Question Bank.', 'anikeola-cbt' ), $count );
                if(isset($_GET['failed_count']) && intval($_GET['failed_count']) > 0) { $message .= ' ' . sprintf( esc_html__( '%d rows failed to import.', 'anikeola-cbt' ), intval($_GET['failed_count']) );}
                $type = 'success'; break;
            case 'invalid_file_type': $message = esc_html__( 'Error: Invalid file type. Please upload a CSV file.', 'anikeola-cbt' ); $type = 'error'; break;
            case 'file_read_error': $message = esc_html__( 'Error: Could not read the uploaded file.', 'anikeola-cbt' ); $type = 'error'; break;
            case 'upload_error': $code = isset($_GET['code']) ? $_GET['code'] : 'unknown'; $message = sprintf(esc_html__( 'Error: File upload failed. Code: %s', 'anikeola-cbt' ), $code); $type = 'error'; break;
        }
        if ( $message ) { echo '<div class="notice notice-' . esc_attr( $type ) . ' is-dismissible"><p>' . $message . '</p></div>'; }
    }
}
add_action( 'admin_notices', 'anikeola_cbt_import_admin_notices' );


// --- NEW: Front-end Exam Display Shortcode ---
/**
 * Enqueue scripts and styles for the front-end exam display.
 */
function anikeola_cbt_enqueue_front_end_assets() {
    // Only enqueue if our shortcode is present or on an exam page (more robust check needed for single exam CPT pages)
    if ( is_singular('cbt_exam') || (function_exists('has_shortcode') && has_shortcode( get_the_content(), 'anikeola_cbt_exam' )) ) {
        wp_enqueue_style(
            'anikeola-cbt-front-style',
            plugin_dir_url( __FILE__ ) . 'public/css/anikeola-cbt-front.css', // We'll create this file
            array(),
            '1.7' // Version
        );
        wp_enqueue_script(
            'anikeola-cbt-front-script',
            plugin_dir_url( __FILE__ ) . 'public/js/anikeola-cbt-front.js', // We'll create this file
            array( 'jquery' ), // Depends on jQuery
            '1.7',
            true // Load in footer
        );
        // Pass data to script, like AJAX URL for submission later, or timer settings
        wp_localize_script('anikeola_cbt-front-script', 'anikeolaCbtData', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('anikeola_cbt_exam_nonce') // For future AJAX submissions
        ));
    }
}
add_action( 'wp_enqueue_scripts', 'anikeola_cbt_enqueue_front_end_assets' );

/**
 * Shortcode to display a CBT Exam.
 * Usage: [anikeola_cbt_exam id="EXAM_POST_ID"]
 *
 * @param array $atts Shortcode attributes.
 * @return string HTML output for the exam.
 */
function anikeola_cbt_exam_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'id' => 0, // Default to 0, meaning no exam ID provided
    ), $atts, 'anikeola_cbt_exam' );

    $exam_id = intval( $atts['id'] );

    if ( ! $exam_id || get_post_type( $exam_id ) !== 'cbt_exam' ) {
        return '<p>' . esc_html__( 'Error: Invalid or missing exam ID.', 'anikeola-cbt' ) . '</p>';
    }

    // Check if user is logged in (basic check, can be expanded with role checks)
    if ( ! is_user_logged_in() ) {
        return '<p>' . esc_html__( 'Please log in to take this exam.', 'anikeola-cbt' ) . '</p>';
    }

    $exam_post = get_post( $exam_id );
    $exam_title = get_the_title( $exam_post );
    $exam_instructions = apply_filters( 'the_content', $exam_post->post_content ); // Main editor content as instructions

    // Get exam settings
    $time_limit_minutes = get_post_meta( $exam_id, '_anikeola_cbt_time_limit', true );
    $time_limit_seconds = !empty($time_limit_minutes) && is_numeric($time_limit_minutes) ? intval( $time_limit_minutes ) * 60 : 0;

    // Get associated question IDs
    $question_ids = get_post_meta( $exam_id, '_anikeola_cbt_exam_question_ids', true );
    if ( ! is_array( $question_ids ) || empty( $question_ids ) ) {
        return '<p>' . esc_html__( 'This exam currently has no questions.', 'anikeola-cbt' ) . '</p>';
    }

    ob_start(); // Start output buffering
    ?>
    <div class="anikeola-cbt-exam-wrapper" id="anikeola-cbt-exam-<?php echo esc_attr( $exam_id ); ?>" data-exam-id="<?php echo esc_attr( $exam_id ); ?>">
        <h2 class="anikeola-cbt-exam-title"><?php echo esc_html( $exam_title ); ?></h2>
        
        <?php if ( $time_limit_seconds > 0 ) : ?>
            <div class="anikeola-cbt-timer">
                <?php esc_html_e( 'Time Remaining: ', 'anikeola-cbt' ); ?>
                <span id="anikeola-cbt-countdown-<?php echo esc_attr( $exam_id ); ?>" data-time-limit="<?php echo esc_attr( $time_limit_seconds ); ?>">
                    <?php echo gmdate("H:i:s", $time_limit_seconds); // Display initial time ?>
                </span>
            </div>
        <?php endif; ?>

        <div class="anikeola-cbt-exam-instructions">
            <?php echo wp_kses_post( $exam_instructions ); ?>
        </div>

        <form id="anikeola-cbt-exam-form-<?php echo esc_attr( $exam_id ); ?>" class="anikeola-cbt-exam-form" method="post">
            <input type="hidden" name="action" value="anikeola_cbt_submit_exam">
            <input type="hidden" name="exam_id" value="<?php echo esc_attr( $exam_id ); ?>">
            <?php wp_nonce_field( 'anikeola_cbt_submit_exam_nonce_' . $exam_id, 'anikeola_cbt_exam_submission_nonce' ); ?>

            <div class="anikeola-cbt-questions-container">
                <?php foreach ( $question_ids as $index => $question_id ) :
                    $question_post = get_post( $question_id );
                    if ( ! $question_post || $question_post->post_type !== 'cbt_question' ) {
                        continue; // Skip if not a valid question post
                    }
                    $question_title = get_the_title( $question_post );
                    $answer_options = get_post_meta( $question_id, '_anikeola_cbt_answer_options', true );
                    if ( ! is_array( $answer_options ) ) { $answer_options = array(); }
                ?>
                    <div class="anikeola-cbt-question" id="question-<?php echo esc_attr($exam_id . '-' . $question_id); ?>">
                        <h3 class="anikeola-cbt-question-title"><?php echo ($index + 1) . '. ' . esc_html( $question_title ); ?></h3>
                        <?php if ( ! empty( $question_post->post_content ) ) : ?>
                            <div class="anikeola-cbt-question-description">
                                <?php echo apply_filters( 'the_content', $question_post->post_content ); ?>
                            </div>
                        <?php endif; ?>
                        <ul class="anikeola-cbt-answer-options">
                            <?php foreach ( $answer_options as $option_index => $option_text ) : 
                                if ( empty(trim($option_text)) ) continue; // Skip empty options
                            ?>
                                <li>
                                    <label>
                                        <input type="radio" name="answers[<?php echo esc_attr( $question_id ); ?>]" value="<?php echo esc_attr( $option_index ); ?>">
                                        <?php echo esc_html( $option_text ); ?>
                                    </label>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>

            <button type="submit" class="anikeola-cbt-submit-button"><?php esc_html_e( 'Submit Exam', 'anikeola-cbt' ); ?></button>
        </form>
        <div id="anikeola-cbt-exam-result-<?php echo esc_attr( $exam_id ); ?>" class="anikeola-cbt-exam-result" style="display:none;">
            </div>
    </div>
    <?php
    return ob_get_clean(); // Return buffered content
}
add_shortcode( 'anikeola_cbt_exam', 'anikeola_cbt_exam_shortcode' );


// --- Activation Hook ---
function anikeola_cbt_rewrite_flush() {
    anikeola_cbt_register_question_cpt();
    anikeola_cbt_register_exam_cpt();
    anikeola_cbt_register_subject_taxonomy();
    anikeola_cbt_register_class_level_taxonomy();
    anikeola_cbt_register_topic_taxonomy();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'anikeola_cbt_rewrite_flush' );

?>
