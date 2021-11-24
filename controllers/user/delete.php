<?php

$db = new db();
$connect = $db->connect();

$user = new user($connect);

$data = json_decode(file_get_contents("php://input"));
$user->id_user = isset($_GET['id_user']) ? $_GET['id_user'] : 1;
if ($user->delete()) {
    $this->response(200, array('message', 'Qestion deleted'));
} else {
    $this->response(200, array('message', 'Qestion not deleted'));
}
