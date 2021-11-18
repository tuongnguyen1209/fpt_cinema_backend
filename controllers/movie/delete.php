<?php

$db = new db();
$connect = $db->connect();

$movie = new Movie($connect);

$data = json_decode(file_get_contents("php://input"));
$movie->id_movie = isset($_GET['id_movie']) ? $_GET['id_movie'] : die();
$movie->delete();
