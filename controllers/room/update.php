<?php
$db = new db();
$connect = $db->connect();

$room = new room($connect);

$data = json_decode(file_get_contents("php://input"));
$room->id_movie = isset($_GET['id_movie']) ? $_GET['id_movie'] : die();

$room->name_mv = $data->name_mv;
// if ($room->update()) {
//     $this->response(200, array('message', 'Qestion Created'));
// } else {
//     $this->response(400, array('message', 'false'));
//     // echo json_encode(array('message', 'Qestion Not Update'));
// }


// nếu số thể loại bằng vs số thể loại có trong db thì cập nhật
// nếu số thể loại< hoặc lớn hơn số thể loại có trong db thì xóa xong create vào bảng
