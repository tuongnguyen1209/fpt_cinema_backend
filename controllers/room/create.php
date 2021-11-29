<?php
$db = new db();
$connect = $db->connect();

$room = new room($connect);
$data = json_decode(file_get_contents("php://input"));

$room->name = $data->name;

if ($room->create()) {
    $response = array(
        'status' => 'success',
        'data' => $room,
    );
    $this->response(200, $response);
} else {
    $this->response(401, array(
        'status' => 'False',
        'message' => 'lỗi'
    ));
}
