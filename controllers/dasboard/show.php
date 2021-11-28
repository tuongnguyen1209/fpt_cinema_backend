<?php
$db = new db();
$connect = $db->connect();

$dasboard = new dasboard($connect);
// $dasboard->id_dasboard = isset($_GET['id_dasboard']);
// $limit;
// $page;
// $ct;
// if ($dasboard->id_dasboard) {
// $dasboard->id_dasboard = ($_GET['id_dasboard']);
// $dasboard->show();
// $dasboard_item = array(
//     'id_dasboard' => $dasboard->id_dasboard,
//     'name_dasboard' => $dasboard->name_mv,
//     'img_dasboard' => $dasboard->image_mv,
//     'traller' => $dasboard->traller,
//     // 'date_start' => $dasboard->date_start,
//     // 'date_end' => $dasboard->date_end,
//     'detail' => $dasboard->detail,
//     'actor' => $dasboard->actor,
//     'director' => $dasboard->director,
//     'time_mv' => $dasboard->time_mv,
//     'cate' => $dasboard->cate,
//     'day_start' => $dasboard->day_start,
//     'day_end' => $dasboard->day_end,
//     'time_start' => $dasboard->time_start,
//     'time_end' => $dasboard->time_end
// );
// $this->response(200, $dasboard_item);
// } else {
$movie_sum = $dasboard->movie_sum();
$num = $movie_sum->rowCount();
if ($num > 0) {
    $dasboard_array = [];
    $dasboard_array['dasboard'] = [];

    while ($row = $movie_sum->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $dasboard_item = array(
            "count_all_id_movie" => $count_movie_id_all
        );
        array_push($dasboard_array['dasboard'], $dasboard_item);
    }
    $this->response(200, $dasboard_array);
}
// }
