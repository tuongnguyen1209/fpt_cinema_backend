<?php
$db = new db();
$connect = $db->connect();

$user = new user($connect);





$type = isset($_GET['type']) ? $_GET['type'] : null;

if ($type === 'fb') {
} elseif ($type === 'gg') {
    $googleId = $this->params->googleId;
    if ($user->checkGoogle($googleId)) {
        $response = array(
            'status' => 'success',
            'data' => $user,
        );
    } else {
        $data = json_decode(file_get_contents("php://input"));
        $user->full_name = $data->name;
        $user->email = $data->email;
        $user->phone = $data->phone;
        $user->password = md5($googleId);
        $user->status = $data->status;
        $user->img_user = $data->imageUrl;
        if ($user->create()) {
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
    }
} else {
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
}
