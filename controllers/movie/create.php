<?php
$db = new db();
$connect = $db->connect();

$movie = new Movie($connect);
$data = json_decode(file_get_contents("php://input"));

$movie->name_mv = $data->name_mv;
$movie->image_mv = $data->image_mv;
$movie->traller = $data->traller;
$movie->date_start = $data->date_start;
$movie->date_end = $data->date_end;
$movie->detail = $data->detail;
$movie->actor = $data->actor;
$movie->director = $data->director;
$movie->time_mv = $data->time_mv;
$movie->banner  = $data->banner;
$movie->rate  = $data->rate;
$movie->status = $data->status;
$movie->country = $data->country;
$movie->production = $data->production;
$movie->name_vn = $data->name_vn;
$ar = $data->id_cate;
if ($lastID = $movie->create()) {
    $movie->id_movie = $lastID;
    for ($i = 0; $i < count($ar); $i++) {
        $movie->id_cate = $data->id_cate = $ar[$i];
        $movie->create_CT_MV();
    }
    $this->response(200, array('message', 'Qestion Created'));
} else {
    $this->response(200, array('message', 'Qestion Not Created'));
}
