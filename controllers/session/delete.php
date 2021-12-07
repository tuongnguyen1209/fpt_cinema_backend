<?php

$db = new db();
$connect = $db->connect();

$session = new session($connect);

$data = json_decode(file_get_contents("php://input"));
$session->id_session = isset($_GET['id_session']) ? $_GET['id_session'] : die();
if ($session->delete()) {
    $response = array(
        'status' => 'success',

    );
    $this->response(200, $response);
} else {
    $this->response(401, array(
        'status' => 'False',
        'message' => 'lỗi'
    ));
}
