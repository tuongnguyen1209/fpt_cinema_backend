<?php
$db = new db();
$connect = $db->connect();

$session = new session($connect);
$session->id_session = isset($_GET['id_session']);
$session->day = isset($_GET['day']);
$session->id_showtimes = isset($_GET['id_showtimes']);
$session->id_movie = isset($_GET['id_movie']);
if ($session->id_session) {
    $session->id_session = ($_GET['id_session']);
    $session->show();
    $session_item = array(
        'id_session' => $session->id_session,
        'name_mv' => $session->name_mv,
        'id_movie' => $session->id_movie,
        'image_lage' => $session->image_lage,
        'room_number' => $session->name,
        'day' => $session->day,
        'time_start' => $session->time_start,
        'time_end' => $session->time_end,
        'type' => $session->type
    );
    $response = array(
        'status' => 'success',
        'data' => $session_item,
    );
    $this->response(200, $response);
} elseif ($session->day == true || $session->id_showtimes == true) {
    $session->day = ($_GET['day']);
    $session->id_showtimes = ($_GET['id_showtimes']);
    $showtime = $session->show_time();
    $session_array = [];
    $session_array['session'] = [];

    while ($row = $showtime->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $session_item = array(
            'id_session' => $id_session,
            'name_mv' => $name_mv, 'id_movie' =>  $id_movie,
            'image_lage' => $image_lage,
            'room_number' => $name,
            'day' => $day,
            'time_start' => $time_start,
            'time_end' => $time_end,
            'type' => $type
        );

        array_push($session_array['session'], $session_item);
    }


    $response = array(
        'status' => 'success',
        'data' => $session_array,
    );
    $this->response(200, $response);
} elseif ($session->id_movie) {
    $session->id_movie = ($_GET['id_movie']);
    $show_mv = $session->show_mv();
    $session_array = [];
    $session_array['session'] = [];

    while ($row = $show_mv->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $session_item = array(
            'id_movie' => $id_movie,
            'id_session' => $id_session,
            'name_mv' => $name_mv, 'id_movie' =>  $id_movie,
            'image_lage' => $image_lage,
            'room_number' => $name,
            'day' => $day,
            'time_start' => $time_start,
            'time_end' => $time_end,
            'type' => $type
        );

        array_push($session_array['session'], $session_item);
    }


    $response = array(
        'status' => 'success',
        'data' => $session_array,
    );
    $this->response(200, $response);
} else {
    $read = $session->read();
    $num = $read->rowCount();
    if ($num > 0) {
        $session_array = [];
        $session_array['session'] = [];

        while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $session_item = array(
                'id_session' => $id_session,
                'name_mv' => $name_mv, 'id_movie' =>  $id_movie,
                'image_lage' => $image_lage,
                'room_number' => $name,
                'day' => $day,
                'date_start' => $time_start,
                'date_end' => $time_end,
                'type' => $type
            );

            array_push($session_array['session'], $session_item);
        }


        $response = array(
            'status' => 'success',
            'data' => $session_array,
        );
        $this->response(200, $response);
    }
}
