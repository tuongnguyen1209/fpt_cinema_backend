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
// $connect = "tên của bạn: $user->full_name, email :$user->email, số điện thoại của bạn: $user->phone";
$user->img_user = $data->img_user;
// $connect = array(
//     "email:" => $user->full_name,
//     "phone" => $user->email,
// );
// array_push($connect);


if ($user->checkEmailExit($data->email)) {

    return   $this->response(200, array(
        'status' => 'False',
        'message' => 'Email already exists!'
    ));
}


if ($user->create()) {
    $response = array(
        'status' => 'success',
        'data' => $user,
    );


    $content = "<p>Chào mừng bạn đến với Poly Cinema</p>";
    $content .= "<p>Đây là thông tin tài khoản của bạn</p>";
    $content .= "<p>Họ tên: $user->full_name</p><p>Email :$user->email</p><p> số điện thoại: $user->phone</p><p>Mật khẩu: $data->password</p>";


    $this->responseAndSendMail(200, $response, $user->email, $content);
} else {
    $this->response(401, array(
        'status' => 'False',
        'message' => 'lỗi'
    ));
}
