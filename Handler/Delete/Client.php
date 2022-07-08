<?php

include $_SERVER['DOCUMENT_ROOT'] . "/Database/Client.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");

$input = file_get_contents("php://input");
$inputJSON = json_decode( $input, TRUE );

$db = new Client($inputJSON["phone_num"]);
$result = $db->Delete();
if (!$result) {
    echo "not found";
} else {
    echo "rows delete ".$result;
}

