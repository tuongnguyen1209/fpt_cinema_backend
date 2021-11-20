<?php

$db = new db();
$connect = $db->connect();

$session = new session($connect);

$data = json_decode(file_get_contents("php://input"));
$session->id_session = isset($_GET['id_session']) ? $_GET['id_session'] : die();
$session->delete();
