<?php
$db = new db();
$connect = $db->connect();

$combo  = new combo($connect);
$combo->id_combo  = isset($_GET['id_combo']);
if ($combo->id_combo) {
    $combo->show();
    $combo->id_combo  = ($_GET['id_combo']);

    $combo_item = array(
        'id_combo ' => $combo->id_combo,
        'Tên combo' => $combo->name,
        'Giá tiền' => $combo->price,
        'Hình ảnh' => $combo->image

    );

    print_r(json_encode($combo_item));
} else {
    $read = $combo->read();

    $num = $read->rowCount();
    if ($num > 0) {
        $combo_array = [];
        $combo_array['combo'] = [];

        while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $combo_item = array(
                'id_combo ' => $id_combo,
                'Tên combo' => $name,
                'Giá tiền' => $price,
                'Hình ảnh' => $image

            );

            array_push($combo_array['combo'], $combo_item);
        }
        $response = array(
            'status' => 'success',
            'data' => $combo_array,
        );
        $this->response(200, $response);
    }
}
