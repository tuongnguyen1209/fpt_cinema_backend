<?php
$db = new db();
$connect = $db->connect();
$data = json_decode(file_get_contents("php://input"));
$user = new user($connect);
$user->email = $data->email;
$pass = $user->generatePassword();
$user->password = md5($pass);

if ($user->forgotPass()) {
    goimail($user->email, "Mật khẩu mới của bạn là: " . $pass);
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
