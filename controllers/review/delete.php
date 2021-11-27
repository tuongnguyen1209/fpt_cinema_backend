<?php

$db = new db();
$connect = $db->connect();

$movie = new Movie($connect);

$data = json_decode(file_get_contents("php://input"));
$movie->id_movie = isset($_GET['id_movie']) ? $_GET['id_movie'] : 1;
$movie->id_user = isset($_GET['id_user']) ? $_GET['id_user'] : 1;
if ($movie->delete()) {
    $this->response(200, array('message', 'Qestion delete'));
} else {
    $this->response(200, array('message', 'Qestion Not Delete'));
}
