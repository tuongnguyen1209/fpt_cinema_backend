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
$tkcb_id = $data->id_combo;
$tkcb_quantity = $data->quantity;
$tkcb_unit_price = $data->unit_price;
if ($lastID = $ticket->create()) {
    $ticket->id_ticket = $lastID;
    for ($i = 0; $i < count($tks); $i++) {
        $ticket->id_seat = $data->id_seat = $tks[$i];
        $ticket->createTiketSeat();
    }
    for ($i = 0; $i < count($tkcb_id); $i++) {
        $ticket->id_combo = $data->id_combo = $tkcb_id[$i];
        $ticket->quantity = $data->quantity = $tkcb_quantity[$i];
        $ticket->unit_price = $data->unit_price = $tkcb_unit_price[$i];

        $ticket->createTiketCombo();
    }
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
