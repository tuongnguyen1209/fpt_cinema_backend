<?php
$db = new db();
$connect = $db->connect();

$user = new user($connect);

$data = json_decode(file_get_contents("php://input"));
$user->full_name = $data->full_name;
$user->email = $data->email;
$user->phone = $data->phone;
$user->password = md5($data->password);
$user->status = $data->status;

if ($user->create()) {
    $this->response(200, array('message', 'Qestion Created'));
} else {
    $this->response(200, array('message', 'Qestion Not Created'));
}
