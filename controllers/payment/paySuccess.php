<?php
$db = new db();
$connect = $db->connect();

$ticket = new ticket($connect);


$id_ticket = isset($_GET['vnp_TxnRef']) ? $_GET['vnp_TxnRef'] : null;


if (isset($id_ticket)) {
    $ticket->paySuccess($id_ticket);
    print_r('Thành công');
    header('Location: https://fptcinema.netlify.app/member');
} else {
    print_r('Có lỗi xảy ra');
}
