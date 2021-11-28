<?php
$db = new db();
$connect = $db->connect();

$room = new room($connect);
$data = json_decode(file_get_contents("php://input"));

$room->name = $data->name;

if ($room->create()) {
    $this->response(200, array('message', 'Qestion Created'));
} else {
    $this->response(200, array('message', 'Qestion Not Created'));
}
