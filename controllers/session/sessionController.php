<?php

function checkItemInArr($arr = [], $item, $key)
{
    for ($i = count($arr) - 1; $i >= 0; $i--) {

        if ($arr[$i][$key] == $item) {
            echo 'vo day ' . $i, '<br>';
            return $i;
        }

        if ($key == 'id_movie' && $arr[$i][$key] < $item) {
            return -1;
        }
    }
    return -1;
}

if ($this->method == 'GET') {
    if ($this->params[0] == 'movie') {
        $db = new db();
        $connect = $db->connect();
        $session = new session($connect);
        $listSession = $session->getSessionByMovie();

        $arr = [];

        while ($row = $listSession->fetch(PDO::FETCH_ASSOC)) {
            $oneSession = array(
                'id_session' => $row['id_session'],
                'id_showtimes' => $row['id_showtimes'],
                'time_start' => $row['time_start'],
                'time_end' => $row['time_end'],
                'type' => $row['type'],
            );

            $index = checkItemInArr($arr, $row['id_movie'], 'id_movie');

            if ($index == -1) {
                array_push($arr, array(
                    'id_movie' => $row['id_movie'],
                    'image_large' => $row['image_lage'],
                    'img_medium' => $row['image_medium'],
                    'name' => $row['name_mv'],
                    'sessions' => array(
                        array(
                            'day' => $row['day'],
                            'session' => array($oneSession)
                        )
                    )
                ));
            } else {
                $indInSession = checkItemInArr($arr[$index]['sessions'], $row['day'], 'day');

                if ($indInSession == -1) {
                    array_push($arr[$index]['sessions'], array(
                        'day' => $row['day'],
                        'session' => array(
                            $oneSession
                        )
                    ));
                } else {
                    array_push(
                        $arr[$index]['sessions'][$indInSession]['session'],
                        $oneSession

                    );
                }
            }
        }
        $response = array(
            'status' => 'success',
            'data' => array('movie' => $arr),
        );
        $this->response(200, $response);
    }
}
