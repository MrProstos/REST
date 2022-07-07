<?php

include $_SERVER['DOCUMENT_ROOT'] . "/Database/Client.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");


$input = file_get_contents("php://input");
$inputJSON = json_decode( $input, TRUE );

$db = new Client();
$db->Set($inputJSON["phone_num"],$inputJSON["firstname"],$inputJSON["lastname"],$inputJSON["birthday"]);
if ($db->Insert()){
    echo "Successful";
}
