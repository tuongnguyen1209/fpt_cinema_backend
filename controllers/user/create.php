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

// $connect = implode($connect);
// goimail($user->email, $connect);
// print_r($connect);

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
