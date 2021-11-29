<?php
$db = new db();
$connect = $db->connect();

$user = new user($connect);

$data = json_decode(file_get_contents("php://input"));
$user->id_user = isset($_GET['id_user']) ? $_GET['id_user'] : die();
$user->full_name = $data->full_name;
$user->password = $data->password;
$user->email = $data->email;
$user->status = $data->status;
$user->phone = $data->phone;

if ($user->update()) {
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


// nếu số thể loại bằng vs số thể loại có trong db thì cập nhật
// nếu số thể loại< hoặc lớn hơn số thể loại có trong db thì xóa xong create vào bảng
