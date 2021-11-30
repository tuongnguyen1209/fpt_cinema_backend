<?php
$db = new db();
$connect = $db->connect();
$user = new user($connect);
$user->id_user = isset($_GET['id_user']);
if ($user->id_user == true) {
    $user->id_user = $_GET['id_user'];
    $user->show();

    $user_item = array(
        'id_user' => $user->id_user,
        'name_user:' => $user->full_name,
        'email' => $user->email,
        'SĐT' => $user->phone,
        'status' => $user->status
    );

    $response = array(
        'status' => 'success',
        'data' => $user_item,
    );
    $this->response(200, $response);
} else {

    $read = $user->read();

    $num = $read->rowCount();
    if ($num > 0) {
        $user_array = [];
        $user_array['user'] = [];

        while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $user_item = array(
                'id_user' => $id_user,
                'name_user' => $full_name,
                'email' => $email,
                'phone' => $phone,
                'password' => $password,
                'status' => $status
                'administration' => $administration
            );

            array_push($user_array['user'], $user_item);
        }
        $response = array(
            'status' => 'success',
            'data' => $user_array,
        );
        $this->response(200, $response);
    }
}
