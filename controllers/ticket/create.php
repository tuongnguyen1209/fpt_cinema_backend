<?php
$db = new db();
$connect = $db->connect();

$ticket = new ticket($connect);
$data = json_decode(file_get_contents("php://input"));

$ticket->id_session = $data->id_session;
$ticket->Total_money = $data->Total_money;
$ticket->id_seat = $data->id_seat;
$ticket->id_user = $data->id_user;
$ticket->id_promotion = $data->id_promotion;
$ticket->time_create = $data->time_create;
$ticket->status = $data->status;
$ticket->id_combo = $data->id_combo;
$ticket->ticket_information  = $data->ticket_information;
if ($ticket->create()) {
    $this->response(200, array('message', 'Qestion Created'));
} else {
    $this->response(200, array('message', 'Qestion Not Created'));
}
