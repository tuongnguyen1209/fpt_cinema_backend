<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methos: PUT');
    header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methos,Authorization,X-
    Requested-With');
    include_once '../../config/db.php';
    include_once '../../model/movie.php';


    $db = new db();
    $connect = $db->connect();

    $movie = new Movie($connect);

    $data = json_decode(file_get_contents("php://input"));

    $movie->id_movie = $data->id_movie;
    $movie->name_mv = $data->name_mv;
    $movie->image_mv = $data->image_mv;
    $movie->traller = $data->traller;
    $movie->date_start = $data->date_start;
    $movie->date_end = $data->date_end;
    $movie->detail = $data->detail;
    $movie->actor = $data->actor;
    $movie->director = $data->director;
    $movie->time_mv = $data->time_mv;

    if($movie->update()){
        echo json_encode(array('message','Qestion Update'));
    }else{
        echo json_encode(array('message','Qestion Not Update'));
    }

?>