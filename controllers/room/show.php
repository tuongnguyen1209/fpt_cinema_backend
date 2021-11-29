<?php
$db = new db();
$connect = $db->connect();

$room = new room($connect);
$room->id_room = isset($_GET['id_room']);
if ($room->id_room) {
    $room->id_room = $_GET['id_room'];
    $room->show();

    $room_item = array(
        'id_room' => $room->id_room,
        'name_room' => $room->name
    );

    $response = array(
        'status' => 'success',
        'data' => $room_item,
    );
    $this->response(200, $response);
} else {
    $read = $room->read();

    $num = $read->rowCount();
    if ($num > 0) {
        $room_array = [];
        $room_array['room'] = [];

        while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $room_item = array(
                'id_room' => $id_room,
                'name_room' => $name
            );

            array_push($room_array['room'], $room_item);
        }
        $response = array(
            'status' => 'success',
            'data' => $room_array,
        );
        $this->response(200, $response);
    }
}
