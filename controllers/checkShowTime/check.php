<?php
$db = new db();
$connect = $db->connect();

$session = new session($connect);

$day = isset($_GET['day']) ? $_GET['day'] : null;

if (!isset($day)) {
    $response = array(
        'status' => 'False',
        'message' => 'Missing day!!!'
    );
    return  $this->response(200, $response);
}

$read = $session->getRoomExitByDay($day);

$num = $read->rowCount();
$session_array = [];
$session_array['list'] = [];
if ($num > 0) {
    $arr = [];
    while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        // print_r($key);
        // if ($key) {
        //     print_r($key);
        // } else {
        //     $session_item = array(
        //         'id_room' => $id_room,
        //         'list_time' => array(
        //             $id_showtimes
        //         )
        //     );
        //     array_push($arr, $session_item);
        // }
        $check = false;
        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i]['id_room'] == $id_room) {
                $check = true;
                array_push($arr[$i]['list_time'], $id_showtimes);
            }
        }

        if (!$check) {
            $session_item = array(
                'id_room' => $id_room,
                'list_time' => array(
                    $id_showtimes
                )
            );
            array_push($arr, $session_item);
        }
    }
    $session_array['list'] =  $arr;
}


$response = array(
    'status' => 'success',
    'data' => $session_array,
);
$this->response(200, $response);
