<?php

$db = new db();
$connect = $db->connect();

$ticket = new ticket($connect);

$data = json_decode(file_get_contents("php://input"));
$ticket->id_ticket = isset($_GET['id_ticket']) ? $_GET['id_ticket'] : 1;
if ($ticket->delete()) {
    $this->response(200, array('message', 'Qestion delete'));
} else {
    $this->response(200, array('message', 'Qestion Not Delete'));
}
