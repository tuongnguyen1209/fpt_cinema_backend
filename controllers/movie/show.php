<?php
    $db = new db();
    $connect = $db->connect();

    $movie = new Movie($connect);
    $movie->id_movie = isset($_GET['id_movie']) ? $_GET['id_movie'] : die();    

    $movie->show();

    $movie_item = array(
        'id_movie' => $movie->id_movie,
        'tên phim' => $movie->name_mv,
        'ảnh phim' => $movie->image_mv,
        'traller phim' => $movie->traller,
        'ngày bắt đầu' => $movie->date_start,
        'ngày kết thúc' => $movie->date_end,
        'nội dung' => $movie->detail,
        'diễn viên' => $movie->actor,
        'đạo diễn' => $movie->director,
        'thời gian' => $movie->time_mv,
        'Thể loại' => $movie->cate
    );

    print_r(json_encode($movie_item));
?>