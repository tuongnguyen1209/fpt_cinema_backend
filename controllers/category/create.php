<?php
    $db = new db();
    $connect = $db->connect();

    $category = new category($connect);

    $data = json_decode(file_get_contents("php://input"));
    $category->name = $data->name;
    

    if($category->create()){
        echo json_encode(array('message','Qestion Created'));
    }else{
        echo json_encode(array('message','Qestion Not Created'));
    }

?>