<?php

    $db = new db();
    $connect = $db->connect();

    $movie = new Movie($connect);

    $data = json_decode(file_get_contents("php://input"));
    $movie->id_movie = isset($_GET['id_movie']) ? $_GET['id_movie'] : die();    
    
    if($movie->delete() ==true){
        echo json_encode(array('message','Qestion Delete'));
    }else{
        echo json_encode(array('message','Qestion Not Delete'));
    }

?>