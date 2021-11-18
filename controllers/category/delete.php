<?php
    $db = new db();
    $connect = $db->connect();

    $category = new category($connect);

    $data = json_decode(file_get_contents("php://input"));
    $category->id_category = $data->id_category;
    

    if($category->delete()){
        echo json_encode(array('message','Question Created'));
    }else{
        echo json_encode(array('message','Question Not Created'));
    }

?>