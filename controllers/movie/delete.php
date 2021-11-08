<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methos: DELETE');
    header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methos,Authorization,X-
    Requested-With');
    include_once '../../config/db.php';
    include_once '../../model/movie.php';


    $db = new db();
    $connect = $db->connect();

    $movie = new Movie($connect);

    $data = json_decode(file_get_contents("php://input"));

    $movie->id_movie = $data->id_movie;
    
    if($movie->delete()){
        echo json_encode(array('message','Qestion Delete'));
    }else{
        echo json_encode(array('message','Qestion Not Delete'));
    }

?>