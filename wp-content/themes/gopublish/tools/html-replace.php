<?php
/*
 * Template Name: Admin Use - Database String Replace
 */
/**
 * @param $replaceString
 * @param $newString
 */

error_reporting(-1);
ini_set('error_reporting', E_ALL);

function epg_sql_table_replace($tables, $replaceString, $newString) {

    echo "<h2>In these fields, <kbd>{$replaceString}</kbd> has been replaced with <kbd>{$newString}</kbd></h2>";
    $t = 0;
    while ($table = mysql_fetch_row($tables)) {
        echo '<table style="margin-bottom:20px;">';
        $fields_result = mysql_query("SHOW COLUMNS FROM " . $table[0]);
        if (!$fields_result) {
            echo '<tr><td colspan="2">Could not run query: ' . mysql_error() . '</td></tr>';
            exit;
        }
        $i = 0;
        if (mysql_num_rows($fields_result) > 0) {
            echo "<tr><td colspan='2'><strong>Table: {$table[0]}</strong></td></tr>";
            while ($field = mysql_fetch_assoc($fields_result)) {
                if (stripos($field['Type'], "VARCHAR") !== false ||
                    stripos($field['Type'], "TEXT") !== false
                ) {
                    echo '<tr>';
                    echo '<td style="padding-right:10px;">' . $field['Field'] . ' </td>';
                    $sql = "UPDATE " . $table[0] .
                        " SET " . $field['Field'] . " = replace(" . $field['Field'] . ", '$replaceString', '$newString')";
                    mysql_query($sql);
                    echo '<td>' . mysql_affected_rows() . ' records updated.</td>';
                    echo '</tr>';
                    $i = $i + mysql_affected_rows();
                }

            }
        }
        echo '<tr><td colspan="2">' . $i . ' total records updated.</td></tr>';
        echo "</table>";
        $t = $t + $i;
    }

    echo "$t changes made to the database";

}

$strings = array(
    // 'newstring'  => 'oldstring'
    '1398366141837' => '1375819015494',
    '1398366494877' => '1375819230878',
    '1398366605405' => '1375818952736'
);

/** Database */

// Connect to database server
mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

// Select database
mysql_select_db(DB_NAME);

// List all tables in database
$sql = "SHOW TABLES FROM " . DB_NAME;
$tables_result = mysql_query($sql);

if (!$tables_result || $tables_result < 1) {
    echo "Database error, could not list tables\n\nMySQL error: " . mysql_error();
    exit;
}

foreach ($strings as $new => $old){

    epg_sql_table_replace($tables_result, $old, $new);

}

mysql_free_result($tables_result);