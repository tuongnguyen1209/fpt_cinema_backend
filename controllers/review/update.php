<?php
$db = new db();
$connect = $db->connect();

$review = new review($connect);
$data = json_decode(file_get_contents("php://input"));
$review->id_user = isset($_GET['id_user']) ? $_GET['id_user'] : false;
$review->id_movie = isset($_GET['id_movie']) ? $_GET['id_movie'] : false;

$review->content = $data->content;
$review->start = $data->start;

if ($review->update()) {
    $this->response(200, array('message', 'Qestion Created'));
} else {
    $this->response(200, array('message', 'Qestion Not Created'));
    echo json_encode(array('message', 'Qestion Not Created'));
}
