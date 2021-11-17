<?php
    $db = new db();
    $connect = $db->connect();

    $user = new user($connect);

    $data = json_decode(file_get_contents("php://input"));
    $user->full_name = $data->full_name;
    $user->email = $data->email;
    $user->phone = $data->phone;
    $user->password = $data->password;
    $user->status = $data->status;

    if($user->create()){
        echo json_encode(array('message','Qestion Created'));
    }else{
        echo json_encode(array('message','Qestion Not Created'));
    }

?>