<?php
$number = 0;
if(isset($_POST['number']))
{
    $number =  $_POST['number'];
}

$arr = [
    'send' => true,
    'status' => 'go',
    'value' => [1*$number, 2*$number, 3*$number]
];

echo json_encode($arr, JSON_UNESCAPED_UNICODE);
die();

