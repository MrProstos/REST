<?php

include $_SERVER['DOCUMENT_ROOT'] . "/Database/Order.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");

$input = file_get_contents("php://input");
$inputJSON = json_decode( $input, TRUE );

$db = new Order($inputJSON["phone_num"],$inputJSON["send"],$inputJSON["body"],$inputJSON["status"]);
$result = $db->Update();
if (!$result) {
    echo "not found";
} else {
    echo "rows update ".$result;
}
