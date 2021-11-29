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
        'name_movie' => $movie->name_mv,
        'img_large' => $movie->image_lage,
        'img_medium' => $movie->image_medium,
        'traller' => $movie->traller,
        'production' => $movie->production,
        'country' => $movie->country,
        'detail' => $movie->detail,
        'actor' => $movie->actor,
        'director' => $movie->director,
        'time_mv' => $movie->time_mv,
        'cate' => $movie->cate,
        'day' => $movie->date_start,
        "rate" => $movie->rate,
        // 'time_start' => $movie->time_start,
        // 'time_end' => $movie->time_end
    );
    $this->response(200, $movie_item);
} else {
    $sort = isset($_GET["sort"]) ? $_GET["sort"] : false;
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
    $limit = isset($_GET["limit"]) ? $_GET["limit"] : 10;
    $read = $movie->read($page, $sort,  $limit);
    $num = $read->rowCount();
    if ($num > 0) {
        $movie_array = [];
        $movie_array['movie'] = [];

        while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $movie_item = array(
                'id_movie' => $id_movie,
                'name' => $name_mv,
                "name_vn" => $name_vn,
                'image_large' => $image_lage,
                'traller' => $traller,
                'date_start' => $date_start,
                'img_medium' => $image_medium,
                'img_banner' => $image_banner,
                'content' => $detail,
                'actor' => $actor,
                'dirctor' => $director,
                'time' => $time_mv,
                "country" => $country,
                "production" => $production,
                'category' => $cate,
                // 'day_end' => $movie->day_end,
                // 'time_start' => $movie->time_start,
                // 'time_end' => $movie->time_end
            );

            array_push($movie_array['movie'], $movie_item);
        }
        $this->response(200, $movie_array);
    }
}
