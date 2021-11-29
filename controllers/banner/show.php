<?php
    $db = new db();
    $connect = $db->connect();

    $banner = new Banner($connect);
    $banner->id_banner = isset($_GET['id_banner']);
    if($banner->id_banner){
        $banner->id_banner = ($_GET['id_banner']);
        $banner->show();

        $banner_item = array(
            'id_banner' => $banner->id_banner,
            'hình ảnh' => $banner->image
        );

        print_r(json_encode($banner_item));
    }else{
        $read = $banner->read();

        $num = $read->rowCount();
        if($num>0){
            $banner_array = [];
            $banner_array['banner']=[];

            while($row = $read->fetch(PDO::FETCH_ASSOC)){
                extract($row);

                $banner_item = array(
                    'id_banner' => $id_banner,
                    'hình ảnh' => $image, 
                );

                array_push($banner_array['banner'],$banner_item);
            }
            
        }
    }
