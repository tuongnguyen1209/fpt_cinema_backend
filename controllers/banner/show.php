<?php
    $db = new db();
    $connect = $db->connect();

    $banner = new Banner($connect);
    $banner->id_banner = isset($_GET['id_banner']) ? $_GET['id_banner'] : die();    

    $banner->show();

    $banner_item = array(
        'id_banner' => $banner->id_banner,
        'hình ảnh' => $banner->image
    );

    print_r(json_encode($banner_item));
?>