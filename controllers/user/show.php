<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    include_once '../../config/db.php';
    include_once '../../model/user.php';


    $db = new db();
    $connect = $db->connect();

    $user = new user($connect);
    $user->id_user = isset($_GET['id_user']) ? $_GET['id_user'] : die();    

    $user->show();

    $user_item = array(
        'id_user' => $user->id_user,
        'tên:' => $user->full_name,
        'email' => $user->email,
        'SĐT' => $user->phone,
        'trạng thái' => $user->status
    );

    print_r(json_encode($user_item));
?>