<?php
$db = new db();
$connect = $db->connect();

$ticket = new ticket($connect);
$user = new user($connect);
$data = json_decode(file_get_contents("php://input"));

$ticket->id_session = $data->id_session;
$ticket->Total_money = $data->Total_money;
// $ticket->id_seat = $data->id_seat;
$ticket->id_user = $data->id_user;
$ticket->id_promotion = $data->id_promotion;
$ticket->status = 0;
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
    $payment = pay($ticket->id_ticket, 'Pay ment for ' . $lastID, $ticket->Total_money);
    $response = array(
        'status' => 'success',
        'data' => $ticket,
        'payment' => $payment
    );

    $path = './image/imgQrcode.png';
    QRcode::png('polycinema/' . $ticket->id_ticket, $path, 'L', 10);

    $content = '<p>Đây là mã QR code cho vé xem phim của bạn</p>';

    $this->responseAndSendMail(200, $response, $user->getEmailById($ticket->id_user), $content, $path);
} else {
    $this->response(401, array(
        'status' => 'False',
        'message' => 'lỗi'
    ));
}
