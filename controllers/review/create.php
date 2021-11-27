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
    $this->response(200, array('message', 'Qestion Created'));
} else {
    $this->response(200, array('message', 'Qestion Not Created'));
    echo json_encode(array('message', 'Qestion Not Created'));
}
