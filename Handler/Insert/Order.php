<?php

include $_SERVER['DOCUMENT_ROOT'] . "/Database/Order.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");


$input = file_get_contents("php://input");
$inputJSON = json_decode( $input, TRUE );

$db = new Order($inputJSON["phone_num"],$inputJSON["to"],$inputJSON["body"],$inputJSON["status"]);
$result = $db->Insert();
if (!$result){
    echo "Error";
} else {
    echo "rows insert ".$result;
}
