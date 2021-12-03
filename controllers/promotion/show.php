<?php
$db = new db();
$connect = $db->connect();

$promotion  = new promotion($connect);
$promotion->id_promotion  = isset($_GET['id_promotion']);
if ($promotion->id_promotion) {
    $promotion->id_promotion = $_GET['id_promotion'];
    $promotion->show();

    $promotion_item = array(
        'id_promotion ' => $promotion->id_promotion,
        'code_promotion' => $promotion->code,
        'sale' => $promotion->sale,
        'content' => $promotion->detail,
        'day_start' => $promotion->date_start,
        'day_end' => $promotion->date_end,
        'quantity' => $promotion->quantity
    );

    print_r(json_encode($promotion_item));
} else {
    $read = $promotion->read();

    $num = $read->rowCount();
    if ($num > 0) {
        $promotion_array = [];
        $promotion_array['promotion'] = [];

        while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $promotion_item = array(
                'id_promotion ' => $promotion->id_promotion,
                'code' => $promotion->code,
                'sale' => $promotion->sale,
                'content' => $promotion->detail,
                'day_start' => $promotion->date_start,
                'day_end' => $promotion->date_end,
                'quantity' => $promotion->quantity

            );

            array_push($promotion_array['promotion'], $promotion_item);
        }
        $response = array(
            'status' => 'success',
            'data' => $promotion_array,
        );
        $this->response(200, $response);
    }
}
