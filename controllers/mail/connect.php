<?php
$data = json_decode(file_get_contents("php://input"));
$mailc = $data->email;
$passnew = "sts";
goimail($mailc, $passnew);
