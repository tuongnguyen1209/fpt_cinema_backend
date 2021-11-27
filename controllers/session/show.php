<?php
$db = new db();
$connect = $db->connect();

$session = new session($connect);
$session->id_session = isset($_GET['id_session']);
if ($session->id_session) {
    $session->id_session = ($_GET['id_session']);
    $session->show();
    $session_item = array(
        'id_session' => $session->id_session,
        'name_mv' => $session->name_mv,
        'room_number' => $session->name,
        'day' => $session->day,
        'time_start' => $session->time_start,
        'time_end' => $session->time_end,
        'type' => $session->type
    );
    $this->response(200, $session_item);

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
                'name_mv' => $name_mv,
                'room_number' => $name,
                'day' => $day,
                'date_start' => $time_start,
                'date_end' => $time_end,
                'type' => $type
            );

            array_push($session_array['session'], $session_item);
        }
    

        $this->response(200, $session_array);
    }
}
