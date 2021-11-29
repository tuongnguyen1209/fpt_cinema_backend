<?php
$db = new db();
$connect = $db->connect();

$user = new user($connect);

<<<<<<< HEAD
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
=======
$data = json_decode(file_get_contents("php://input"));
$user->full_name = $data->full_name;
$user->email = $data->email;
$user->phone = $data->phone;
$user->password = md5($data->password);
$user->status = $data->status;

if ($user->create()) {
    $this->response(200, array('message', 'Qestion Created'));
} else {
    $this->response(200, array('message', 'Qestion Not Created'));
}
>>>>>>> e92aa350a9dffabfaf8b8f2e732a4e6f2e09eb8c
