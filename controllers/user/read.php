<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    include_once '../../config/db.php';
    include_once '../../model/user.php';


    $db = new db();
    $connect = $db ->connect();
    $user= new user($connect);

    $read = $user->read();

    $num = $read->rowCount();
    if($num>0){
        $user_array = [];
        $user_array['user']=[];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $user_item = array(
                'id_user' => $id_user,
                'tên tài khoản' => $full_name,
                'email' => $email,
                'phone' => $phone,
                'password' => $password,
                'trạng thái' => $status
                            );

            array_push($user_array['user'],$user_item);
        }
        echo json_encode($user_array);
    }
?>