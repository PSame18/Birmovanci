///////////////////////////////
// ONLY FOR TESTING PURPOSES //
///////////////////////////////

<?php include_once("core/init.inc.php");

$event_id = 7;

// $keys = array('event_id', 'user_id', 'time');
$keys[] = 'event_id';
$keys[] = 'user_id';
$keys[] = 'time';

$first = $keys[0];
echo "$first";

// print_r($keys);


// sendLogMessage(EVENTS_DB, "subscription", $values_array);

// function sendLogMessage($db_name, $table_name, $values_array){
//
//     $column_msg = array(); // column name and data stored to it will be store in it in format: column_name: [value];
//
//     for($row = 0; $row < sizeof($values_array); $row++){
//         // $column_msg[] = "$values_array[$row][0]: [$values_array[$row][1]]; ";
//         $column_msg[] = array_values($values_array[$row]);
//     }
//
//     $allValues = array_values($column_msg);
//
//     trigger_error("Data inserted into $db_name.->$table_name: $allValues", E_USER_NOTICE);
//
// }

?>
