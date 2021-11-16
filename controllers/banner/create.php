<?php
    $db = new db();
    $connect = $db->connect();

    $banner = new banner($connect);

    $data = json_decode(file_get_contents("php://input"));
    $banner->image = $data->image;
    
    if($banner->create()){
        echo json_encode(array('message','Qestion Created'));
    }else{
        echo json_encode(array('message','Qestion Not Created'));
    }
?>