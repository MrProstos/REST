<?php

include $_SERVER['DOCUMENT_ROOT'] . "/Database/Order.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");


$input = file_get_contents("php://input");
$inputJSON = json_decode( $input, TRUE );

$db = new Order();
$db->Set($inputJSON["phone_num"],$inputJSON["to"],$inputJSON["body"],$inputJSON["status"]);
if ($db->Insert()){
    echo "Successful";
}
