<?php
$db = new db();
$connect = $db->connect();

$dasboard = new dasboard($connect);

$movie_sum = $dasboard->movie_sum();
$num = $movie_sum->rowCount();
$dasboard_array = [];
$dasboard_array['dasboard'] = [];
// xử lí tổng số các bộ phim đang có
while ($row = $movie_sum->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    // tổng số các bộ phim đang chiếu
    $mv_Sum = array("count_all_id_movie" => $count_movie_id_all);
    $movie_sum_show = $dasboard->movie_sum_show();
};
// tổng số các bộ phim
while ($row = $movie_sum_show->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $mv_sum_show = array("count_show_id_movie" => $count_movie_id_show);
};
// sử lí tổng giá
$total_year = $dasboard->total_year();
while ($row = $total_year->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $total_year_s = array("count_show_id_movie" => $sum_money);
};
// sử lí tổng user
$total_user = $dasboard->total_user_year_new();
while ($row = $total_user->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $total_user_s = array("count_show_id_movie" => $user);
};
// xử lí doanh thu theo tháng


array_push($dasboard_array['dasboard'], $mv_Sum, $mv_sum_show, $total_year_s, $total_user_s);
$this->response(200, $dasboard_array);
