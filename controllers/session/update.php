<?php
    $db = new db();
    $connect = $db->connect();

    $session = new session($connect);

    $data = json_decode(file_get_contents("php://input"));
    $session->id_movie = $data->id_movie;
    $session->id_room = $data->id_room;
    $session->type = $data->type;
    $session->id_showtimes = $data->id_showtimes;
    

    if($session->update()){
        $response = array(
            'status' => 'success',
            'data' => $session,
        );
        $this->response(200, $response);
    }else{
        $this->response(401, array(
            'status' => 'False',
            'message' => 'lỗi'
        ));
    }
