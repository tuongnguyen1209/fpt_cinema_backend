<?php
    $db = new db();
    $connect = $db ->connect();
    $movie = new Movie($connect);

    $read = $movie->read();

    $num = $read->rowCount();
    if($num>0){
        $movie_array = [];
        $movie_array['movie']=[];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $movie_item = array(
                'id_movie' => $id_movie,
                'tên phim' => $name_mv,
                'ảnh phim' => $image_mv,
                'traller phim' => $traller,
                'ngày bắt đầu' => $date_start,
                'ngày kết thúc' => $date_end,
                'nội dung' => $detail,
                'diễn viên' => $actor,
                'đạo diễn' => $director,
                'thời gian' => $time_mv,
                'thể loại' => $cate
            );

            array_push($movie_array['movie'],$movie_item);
        }
        echo json_encode($movie_array);
    }
?>