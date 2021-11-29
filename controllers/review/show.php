<?php
$db = new db();
$connect = $db->connect();

$review = new review($connect);
$review->id_user = isset($_GET['id_user']);
if ($review->id_user) {
    $review->id_user = $_GET['id_user'];
    $review->show();

    $review_item = array(
        'Họ và tên người bình luận' => $review->full_name,
        'tên phim' => $review->name_mv,
        'Nội dung bình luận' => $review->content,
        'Số sao đánh giá' => $review->start
    );

    $response = array(
        'status' => 'success',
        'data' => $review_item,
    );
    $this->response(200, $response);
} else {
    $read = $review->read();

    $num = $read->rowCount();
    if ($num > 0) {
        $review_array = [];
        $review_array['review'] = [];

        while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $review_item = array(
                'full_name' => $full_name,
                "name_mv" => $name_mv,
                'Nội dung bình luận' => $content,
                'Số sao đánh giá' => $start
            );

            array_push($review_array['review'], $review_item);
        }
        $response = array(
            'status' => 'success',
            'data' => $review_array,
        );
        $this->response(200, $response);
    }
}
