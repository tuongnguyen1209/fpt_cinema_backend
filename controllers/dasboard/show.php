<?php
$db = new db();
$connect = $db->connect();

$dasboard = new dasboard($connect);



if (isset($_GET['type'])) {
    $type = $_GET['type'];
    if ($type == 'month') {
        $month = isset($_GET['month']) ? $_GET['month'] : null;
        $year = isset($_GET['year']) ? $_GET['year'] : null;
        if (!isset($month) || !isset($year)) $this->response(200, array(
            'status' => 'False',
            'message' => 'Mising params month'
        ));

        $listPirce = $dasboard->price_day_by_Month($month, $year);
        $arr = [];
        while ($row = $listPirce->fetch(PDO::FETCH_ASSOC)) {

            // tổng số các bộ phim đang chiếu
            array_push($arr, array(
                "date" => $row['date'],
                "total" => $row['total']
            ));
        }
        $this->response(200, array(
            'status' => 'Success',
            'static' => $arr
        ));
    } else if ($type == 'date') {
        $start = isset($_GET['start']) ? $_GET['start'] : null;
        $end = isset($_GET['end']) ? $_GET['end'] : null;
        if (!isset($start) || !isset($end)) $this->response(200, array(
            'status' => 'False',
            'message' => 'Mising params, please check again'
        ));

        $listPirce = $dasboard->price_day_by_Date($start, $end);
        $arr = [];

        while ($row = $listPirce->fetch(PDO::FETCH_ASSOC)) {

            // tổng số các bộ phim đang chiếu
            array_push($arr, array(
                "date" => $row['date'],
                "total" => $row['total']
            ));
        }
        $this->response(200, array(
            'status' => 'Success',
            'static' => $arr
        ));
    }
}


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

    $total_year_s = array("total_price" => $sum_money);
};
// sử lí tổng user
$total_user = $dasboard->total_user_year_new();
while ($row = $total_user->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $total_user_s = array("total_user" => $user);
};
// xử lí doanh thu theo tháng

$totalPriceByMonth = $dasboard->total_Price_By_month();
$arrByMonth = [];
while ($row = $totalPriceByMonth->fetch(PDO::FETCH_ASSOC)) {

    array_push($arrByMonth, array(
        'date' => $row['date'],
        'total' => $row['total']
    ));
}

$totalPriceByShowtime = $dasboard->total_price_by_showtime();
$arrByShowtime = [];
while ($row = $totalPriceByShowtime->fetch(PDO::FETCH_ASSOC)) {

    array_push($arrByShowtime, array(
        'shotime' => $row['shotime'],
        'total' => $row['total']
    ));
}




array_push(
    $dasboard_array['dasboard'],
    $mv_Sum,
    $mv_sum_show,
    $total_year_s,
    $total_user_s,
    array('price_by_month' => $arrByMonth),
    array('price_by_showtime' => $arrByShowtime)
);
$response = array(
    'status' => 'success',
    'data' => $dasboard_array,
);
$this->response(200, $response);
