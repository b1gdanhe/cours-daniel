<?php

$table1 = [
    'a',
    'b',
    'c',
    'd',
    'e',
];
$table2 = [
    [
        'last_name' => 'DANHIN',
        'frist_name' => 'Bignon Elie',
    ],
    [
        'last_name' => 'DANHIN1',
        'frist_name' => 'Bignon2 Elie2',
    ]
];

// for ($i = 0; $i < 26; $i++) {
//     Str::ascii('û');
// }

// add data to table 
array_push($table1, [0 => 'eee']);

// add value on the begging of the array
//array_unshift($table1);

// check if needle is in the array
in_array(1, $table1);

// supprimer un element 
//array_pop($table1);

// remove the first data in the array
//array_shift($table1);

// count the numbeer off data present in the array 
sizeof($table1);
count($table1);
// delete
unset($table1[0]);
$test = 'rr';
unset($test);

$e_index = array_search('e', $table1);
print($e);
//$table1[$e_index] = 'z';
var_dump($table1);
$data = array_replace($table1, [$e_index => 'z']);
var_dump($data);
