<?php
    $db = new db();
    $connect = $db->connect();

    $promotion  = new promotion($connect);
    $promotion->id_promotion  = isset($_GET['id_promotion']) ;    
    if($promotion->id_promotion){
        $promotion->id_promotion =$_GET['id_promotion'];
        $promotion->show();

        $promotion_item = array(
            'id_promotion ' => $promotion->id_promotion ,
            'Mã code giảm giá' => $promotion->code,
            'Giá sale (%)' => $promotion->sale,
            'Chi tiết' => $promotion->detail,
            'ngày bắt đầu' => $promotion->date_start,
            'ngày hết hạn' => $promotion->date_end,
            'Số lượng mã' => $promotion->quantity
        );
    
        print_r(json_encode($promotion_item));
    }else{
        $read = $promotion->read();

        $num = $read->rowCount();
        if($num>0){
            $promotion_array = [];
            $promotion_array['promotion']=[];

            while($row = $read->fetch(PDO::FETCH_ASSOC)){
                extract($row);

                $promotion_item = array(
                    'id_promotion ' => $promotion->id_promotion ,
                    'Mã code giảm giá' => $promotion->code,
                    'Giá sale (%)' => $promotion->sale,
                    'Chi tiết' => $promotion->detail,
                    'ngày bắt đầu' => $promotion->date_start,
                    'ngày hết hạn' => $promotion->date_end,
                    'Số lượng mã' => $promotion->quantity

                );

                array_push($promotion_array['promotion'],$promotion_item);
            }
            echo json_encode($promotion_array);
        }
    }

    
?>