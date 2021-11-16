<?php
    $db = new db();
    $connect = $db->connect();

    $review = new review($connect);
    $review->id_review = isset($_GET['id_review']) ;
    if($review->id_review){
        $review->show();

        $review_item = array(
            'id_review' => $id_review,
            'tên phim' => $name_mv,
            'Họ và tên người bình luận' => $full_name,
            'Nội dung bình luận' => $content,
            'Số sao đánh giá' => $start
        );
    
        print_r(json_encode($review_item));
    }else{
        $read = $review->read();
    
        $num = $read->rowCount();
        if($num>0){
            $review_array = [];
            $review_array['review']=[];

            while($row = $read->fetch(PDO::FETCH_ASSOC)){
                extract($row);

                $review_item = array(
                    'id_review' => $id_review,
                    'tên phim' => $name_mv,
                    'Họ và tên người bình luận' => $full_name,
                    'Nội dung bình luận' => $content,
                    'Số sao đánh giá' => $start
                );

                array_push($review_array['review'],$review_item);
            }
            echo json_encode($review_array);
        }
    }

    
?>