<?php
$db = new db();
$connect = $db->connect();

$tk_seat = new tk_seat($connect);
$read = $tk_seat->read();

$tk_seat_array = [];
$tk_seat_array['tk_seat'] = [];

while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
    $tk_seat_item = $row["id_seat"];

    array_push($tk_seat_array['tk_seat'], $tk_seat_item);
}
$response = array(
    'status' => 'success',
    'data' => $tk_seat_array,
);
$this->response(200, $response);
