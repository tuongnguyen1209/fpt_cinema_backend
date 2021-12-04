<?php
$db = new db();
$connect = $db->connect();

$ticket = new ticket($connect);


$id_ticket = isset($_GET['vnp_TxnRef']) ? $_GET['vnp_TxnRef'] : null;


if (isset($id_ticket)) {
    if ($_GET['vnp_ResponseCode'] == '00') {
        echo "GD Thanh cong";
        $ticket->paySuccess($id_ticket);
    } else {
        echo "GD Khong thanh cong";
    }
} else {
    print_r('Có lỗi xảy ra');
}

// header('Location: https://fptcinema.netlify.app/member');
