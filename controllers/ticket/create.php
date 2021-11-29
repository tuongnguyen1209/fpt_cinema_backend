<?php
$db = new db();
$connect = $db->connect();

$ticket = new ticket($connect);
$data = json_decode(file_get_contents("php://input"));

$ticket->id_session = $data->id_session;
$ticket->Total_money = $data->Total_money;
// $ticket->id_seat = $data->id_seat;
$ticket->id_user = $data->id_user;
$ticket->id_promotion = $data->id_promotion;
$ticket->status = $data->status;
// $ticket->id_combo = $data->id_combo;
$ticket->ticket_information  = $data->ticket_information;


$date = time();
$tk_code = $ticket->id_session . $ticket->id_user . $date;
$ticket->ticket_code = $tk_code;


$tks = $data->id_seat;
$tkcb = $data->id_combo;
if ($lastID = $ticket->create()) {
    $ticket->id_ticket = $lastID;
    for ($i = 0; $i < count($tks); $i++) {
        $ticket->id_seat = $data->id_seat = $tks[$i];
        $ticket->createTiketSeat();
    }
    for ($i = 0; $i < count($tkcb); $i++) {
        $ticket->id_combo = $data->id_combo = $tkcb[$i];
        $ticket->createTiketCombo();
    }
    $this->response(200, array('message', 'Qestion Created'));
} else {
    $this->response(200, array('message', 'Qestion Not Created'));
}
