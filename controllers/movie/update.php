<?php
$db = new db();
$connect = $db->connect();

$movie = new Movie($connect);

$data = json_decode(file_get_contents("php://input"));
$movie->id_movie = isset($_GET['id_movie']) ? $_GET['id_movie'] : die();

$movie->name_mv = $data->name_mv;
$movie->image_lage = $data->image_lage;
$movie->image_medium = $data->image_medium;
$movie->traller = $data->traller;
$movie->date_start = $data->date_start;
$movie->date_end = $data->date_end;
$movie->detail = $data->detail;
$movie->actor = $data->actor;
$movie->director = $data->director;
$movie->time_mv = $data->time_mv;


$movie->banner  = $data->banner;
$movie->rate  = $data->rate;
$movie->country = $data->country;
$movie->production = $data->production;
$movie->name_vn = $data->name_vn;
$movie->status = 1;

// $movie->update();
$ar = $data->id_cate;
 if ($movie->update()) {
    $movie->delete_CT_MV();
    for ($i = 0; $i < count($ar); $i++) {
        $movie->id_cate = $data->id_cate = $ar[$i];
        $movie->create_CT_MV();
    }
    $response = array(
        'status' => 'success',
        'data' => $movie,
    );
     $this->response(200, $response);
} else {
    $this->response(401, array(
        'status' => 'False',
        'message' => 'lỗi'
    ));
    // echo json_encode(array('message', 'Qestion Not Update'));
}


// nếu số thể loại bằng vs số thể loại có trong db thì cập nhật
// nếu số thể loại< hoặc lớn hơn số thể loại có trong db thì xóa xong create vào bảng
