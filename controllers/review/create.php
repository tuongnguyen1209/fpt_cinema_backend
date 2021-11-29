<?php
$db = new db();
$connect = $db->connect();

$review = new review($connect);
$data = json_decode(file_get_contents("php://input"));

$review->id_movie = $data->id_movie;
$review->content = $data->content;
$review->start = $data->start;
$review->id_user = $data->id_user;

if ($review->create()) {
    $response = array(
        'status' => 'success',
        'data' => $review,
    );
    $this->response(200, $response);
} else {
    $this->response(401, array(
        'status' => 'False',
        'message' => 'lỗi'
    ));
}
