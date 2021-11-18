<?php
$db = new db();
$connect = $db->connect();

$movie = new Movie($connect);
$movie->id_movie = isset($_GET['id_movie']);
$limit;
$page;
$ct;
if ($movie->id_movie) {
    $movie->id_movie = ($_GET['id_movie']);
    $movie->show();
    $movie_item = array(
        'id_movie' => $movie->id_movie,
        'tên phim' => $movie->name_mv,
        'ảnh phim' => $movie->image_mv,
        'traller phim' => $movie->traller,
        'ngày bắt đầu' => $movie->date_start,
        'ngày kết thúc' => $movie->date_end,
        // 'nội dung' => $movie->detail,
        'diễn viên' => $movie->actor,
        'đạo diễn' => $movie->director,
        'thời gian' => $movie->time_mv,
        // 'Thể loại' => $movie->cate
    );
    $this->response(200, $movie_item);
} else {
    $read = $movie->read();
    $num = $read->rowCount();
    if ($num > 0) {
        $movie_array = [];
        $movie_array['movie'] = [];

        while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $movie_item = array(
                'id_movie' => $id_movie,
                'name' => $name_mv,
                'image' => $image_mv,
                'traller' => $traller,
                'datestart' => $date_start,
                'dateend' => $date_end,
                'content' => $detail,
                'actor' => $actor,
                'dirctor' => $director,
                'time' => $time_mv,
                "country" => $country,
                "production" => $production,
                "name_vn" => $name_vn,
                'category' => $cate
            );

            array_push($movie_array['movie'], $movie_item);
        }
        $this->response(200, $movie_array);
    }
}
