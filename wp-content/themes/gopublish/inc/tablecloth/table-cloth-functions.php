<?php
/**
 * Functions for Table Cloth CSS/JS
 */

define( 'TC_INC_PATH', get_template_directory_uri() . 'inc/tablecloth/' );
define( 'TC_INC_URL', get_template_directory() . 'inc/tablecloth/' );

/**
 * Add table cloth to page templates.
 * Call Tablecloth with class "table-cloth" applied to table
 */
function table_cloth_tables() {
    if ( is_page_template( 'page-table-cloth.php' ) || is_page_template( 'inc/page-table-cloth.php' ) ) {
        /** Call enqueue */
        wp_enqueue_style( 'table-cloth-css', TC_INC_URL . "css/tablecloth.css" );
        wp_enqueue_script( 'table-cloth-js', TC_INC_URL . "js/tablecloth.js" );
    }
}
add_action( 'wp_enqueue_scripts', 'table_cloth_tables' );