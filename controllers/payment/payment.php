<?php


$db = new db();
$connect = $db->connect();

$ticket = new ticket($connect);

if (!isset($_GET['id_ticket'])) {
    $this->response(200, array(
        'status' => 'False',
        'message' => 'Missing "id_ticket" !'
    ));
}

$ticket->id_ticket = $_GET['id_ticket'];

try {

    $show = $ticket->getTotalById($ticket->id_ticket);

    if ($show->rowCount() == 0) {
        $this->response(200, array(
            'status' => 'False',
            'message' => 'ID_Ticket does not exist'
        ));
    }

    $row = $show->fetch(PDO::FETCH_ASSOC);

    $ticket->Total_money = $row['total_money'];

    $payment = pay($ticket->id_ticket, 'Pay ment for ' . $ticket->id_ticket, $ticket->Total_money);

    $response = array(
        'status' => 'success',
        'payment' => $payment
    );
    $this->response(200, $response);
} catch (Exception $e) {
    //throw $th;
    $this->response(200, array(
        'status' => 'False',
        'message' => 'Opps, have some error, plese contact admin'
    ));
}
