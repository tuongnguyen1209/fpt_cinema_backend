<?php
$db = new db();
$connect = $db->connect();

$category  = new category($connect);
$category->id_category  = isset($_GET['id_category']);
if ($category->id_category) {
    $category->id_category  = $_GET['id_category'];
    $category->show();

    $category_item = array(
        'id_category ' => $category->id_category,
        'Tên thể loại' => $category->name
    );

    $response = array(
        'status' => 'success',
        'data' => $category_item,
    );
    $this->response(200, $response);
} else {
    $read = $category->read();

    $num = $read->rowCount();
    if ($num > 0) {
        $category_array = [];
        $category_array['category'] = [];

        while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $category_item = array(
                'id_category' => $id_category,
                'name_category' => $name
            );

            array_push($category_array['category'], $category_item);
        }
        $response = array(
            'status' => 'success',
            'data' => $category_array,
        );
        $this->response(200, $response);
    }
}
