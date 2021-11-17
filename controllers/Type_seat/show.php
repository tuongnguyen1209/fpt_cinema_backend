<?php
    $db = new db();
    $connect = $db->connect();

    $type_seat = new type_seat($connect);
    $type_seat->id_type_seat = isset($_GET['id_type']) ;
    if($type_seat->id_type_seat){
        $type_seat->id_type =$_GET['id_type'];
        $type_seat->show();

        $type_seat_item = array(
            'tên ghế' => $type_seat->name_type,
            'giá' => $type_seat-> default_price
        );
    
        print_r(json_encode($type_seat_item));
    }else{
        $read = $type_seat->read();
    
        $num = $read->rowCount();
        if($num>0){
            $type_seat_array = [];
            $type_seat_array['type_seat']=[];

            while($row = $read->fetch(PDO::FETCH_ASSOC)){
                extract($row);

                $type_seat_item = array(
                    'id_type' => $id_type,
                    'tên ghế' => $name_type,
                    'giá' => $default_price
                );

                array_push($type_seat_array['type_seat'],$type_seat_item);
            }
            echo json_encode($type_seat_array);
        }
    }

    
?>