<?php
$db = new db();
$connect = $db->connect();

$user = new user($connect);



$username = $this->params->username;
$password =  md5($this->params->password);


$user->login($username, $password);

print_r($user);

$response = array(
    'status' => 'success',
    'data' => $user,
);

$this->response(200, $response);
