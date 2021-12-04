<?php
$db = new db();
$connect = $db->connect();
$data = json_decode(file_get_contents("php://input"));
$user = new user($connect);
$user->id_user = isset($_GET["id_user"]) ? $_GET["id_user"] : 1;
$user->password = md5($data->password);
if ($user->changePass()) {
    $response = array(
        'status' => 'success',
        'data' => $user,
    );
    return    $this->response(200, $response);
} else {
    $this->response(401, array(
        'status' => 'False',
        'message' => 'lỗi'
    ));
}
