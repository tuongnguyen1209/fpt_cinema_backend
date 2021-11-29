<?php
$db = new db();
$connect = $db->connect();

$category = new category($connect);

$data = json_decode(file_get_contents("php://input"));
$category->name = $data->name;


if ($category->create()) {
    $response = array(
        'status' => 'success',
        'data' => $category,
    );
    $this->response(200, $response);
} else {
    $this->response(401, array(
        'status' => 'False',
        'message' => 'lỗi'
    ));
}
