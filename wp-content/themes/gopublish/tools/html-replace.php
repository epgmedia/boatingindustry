<?php
/*
 * Template Name: Admin Use - Database String Replace
 */
/**
 * @param $replaceString
 * @param $newString
 */

include($_SERVER['DOCUMENT_ROOT'] . 'wp-config.php');

function epg_sql_table_replace($replaceString, $newString) {

    echo "<h2>In these fields, <kbd>{$replaceString}</kbd> has been replaced with <kbd>{$newString}</kbd></h2>";
    $t = 0;
    while ($table = mysql_fetch_row($replaceString)) {
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
                if (stripos($field['Type'], "VARCHAR") !== false || stripos($field['Type'], "TEXT") !== false) {
                    echo '<tr>';
                    echo '<td style="padding-right:10px;">' . $field['Field'] . '</td>';
                    $sql = "UPDATE " . $table[0] .
                        " SET " . $field['Field'] . " = replace(" . $field['Field'] . ", '$string_to_replace', '$newString')";
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
$host       = "localhost";
$username   = DB_USER;
$password   = DB_PASSWORD;
$database   = DB_NAME;

// Connect to database server
mysql_connect($host, $username, $password);

// Select database
mysql_select_db($database);

// List all tables in database
$sql = "SHOW TABLES FROM " . $database;
$tables_result = mysql_query($sql);

if (!$tables_result) {
    echo "Database error, could not list tables\n\nMySQL error: " . mysql_error();
    exit;
}

echo '<h1>Tables in DB</h1>';
echo '<table>';
$i = 0; // $i is just for numbering the output, not really useful
while($row = mysql_fetch_array($sql))
{
    echo '<tr><td>' . $i . '</td><td>' . $row['id'] . ' </td></td> : <td><td> ' . $row['name'] . '</td></tr>';
    $i++;
}
echo '</tr></table>';

foreach ($strings as $new => $old){

    epg_sql_table_replace($old, $new);

}

mysql_free_result($tables_result);