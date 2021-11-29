<?php
$db = new db();
$connect = $db->connect();

$user = new user($connect);



$username = $this->params->username;
$password =  md5($this->params->password);


if ($user->login($username, $password)) {

    $response = array(
        'status' => 'success',
        'data' => $user,
    );
    $this->response(200, $response);
} else {
    $this->response(401, array(
        'status' => 'False',
        'message' => 'Sai username hoặc mật khẩu'
    ));
}
