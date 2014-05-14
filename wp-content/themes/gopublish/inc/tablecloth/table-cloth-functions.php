<?php
/**
 * Functions for Table Cloth CSS/JS
 */

define( 'TC_INC_PATH', plugin_dir_path( __FILE__ ) );
define( 'TC_INC_URL', plugin_dir_url( __FILE__ ) );

/**
 * Add table cloth to page templates.
 * Call Tablecloth with class "table-cloth" applied to table
 */
function table_cloth_tables() {
    if ( is_page_template( 'inc/page-table-cloth.php' ) ) {
        /** Call enqueue */
        wp_enqueue_style( 'table-cloth-css', TC_INC_URL . "css/tablecloth.css" );
        wp_enqueue_script( 'table-cloth-js', TC_INC_URL . "js/tablecloth.js" );
    }
}
add_action( 'wp_enqueue_scripts', 'table_cloth_tables' );