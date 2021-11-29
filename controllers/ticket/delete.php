<?php

$db = new db();
$connect = $db->connect();

$ticket = new ticket($connect);

$data = json_decode(file_get_contents("php://input"));
$ticket->id_ticket = isset($_GET['id_ticket']) ? $_GET['id_ticket'] : 1;
if ($ticket->delete()) {
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
