<?php
$db = new db();
$connect = $db->connect();

$ticket = new ticket($connect);
$data = json_decode(file_get_contents("php://input"));
$ticket->id_ticket = isset($_GET['id_ticket']) ? $_GET['id_ticket'] : die();

$ticket->id_session = $data->id_session;
$ticket->Total_money = $data->Total_money;
$ticket->id_seat = $data->id_seat;
$ticket->id_user = $data->id_user;
$ticket->id_promotion = $data->id_promotion;
$ticket->time_create = $data->time_create;
$ticket->status = $data->status;
$ticket->id_combo = $data->id_combo;
$ticket->ticket_information  = $data->ticket_information;
$ticket->ticket_code = $data->ticket_code;
if ($ticket->update()) {
    $response = array(
        'status' => 'success',
        'data' => $ticket,
    );
    $this->response(200, $response);
} else {
    $this->response(401, array(
        'status' => 'False',
        'message' => 'lỗi'
    ));
}
