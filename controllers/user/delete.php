<?php

$db = new db();
$connect = $db->connect();

$user = new user($connect);

$data = json_decode(file_get_contents("php://input"));
$user->id_user = isset($_GET['id_user']) ? $_GET['id_user'] : 1;
if ($user->delete()) {
    $response = array(
        'status' => 'success',
        'data' => $user,
    );
    $this->response(200, $response);
} else {
    $this->response(401, array(
        'status' => 'False',
        'message' => 'lỗi'
    ));
}
