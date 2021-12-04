<?php
// $data = json_decode(file_get_contents("php://input"));
$mailc = isset($_GET['email']) ? $_GET['email'] : 'tuong0188549903@gmail.com';
$passnew = "sts";
goimail($mailc, $passnew);
