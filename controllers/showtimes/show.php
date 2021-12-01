<?php
$db = new db();
$connect = $db->connect();
$showtimes = new showtimes($connect);
$showtimes->id_showtimes = isset($_GET['id_showtimes']);
if ($showtimes->id_showtimes == true) {
    $showtimes->id_showtimes = $_GET['id_showtimes'];
    $showtimes->show();

    $showtimes_item = array(
        'id_showtimes' => $showtimes->id_showtimes,
        'time_start' => $showtimes->time_start,
        'time_end' => $showtimes->time_end
    );

    $response = array(
        'status' => 'success',
        'data' => $showtimes_item,
    );
    $this->response(200, $response);
} else {

    $read = $showtimes->read();

    $num = $read->rowCount();
    if ($num > 0) {
        $showtimes_array = [];
        $showtimes_array['showtimes'] = [];

        while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
             extract($row);

            $showtimes_item = array(
                'id_showtimes' => $id_showtimes,
                'time_start' => $time_start,
                'time_end' => $time_end
            );

            array_push($showtimes_array['showtimes'], $showtimes_item);
        }
        $response = array(
            'status' => 'success',
            'data' => $showtimes_array,
        );
        $this->response(200, $response);
    }
}
