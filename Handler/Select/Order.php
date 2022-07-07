<?php
include $_SERVER['DOCUMENT_ROOT'] . "/Database/Order.php";

header('Content-Type: application/json; charset=utf-8');

$input = file_get_contents('php://input');
$inputJSON = json_decode($input, TRUE);

$db = new Order();
$db->Set($inputJSON["phone_num"]);
$result = $db->Select();

if (is_array($result)) {
    echo json_encode($result);
} else {
   echo $result;
}