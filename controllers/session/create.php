<?php
$db = new db();
$connect = $db->connect();

$session = new session($connect);

$data = json_decode(file_get_contents("php://input"));
$session->id_movie = $data->id_movie;
$session->id_room = $data->id_room;
$session->day = $data->day;
$session->type = $data->type;
$session->id_showtimes = $data->id_showtimes;


if ($session->create()) {
    echo json_encode(array('message', 'Qestion Created'));
} else {
    echo json_encode(array('message', 'Qestion Not Created'));
}
