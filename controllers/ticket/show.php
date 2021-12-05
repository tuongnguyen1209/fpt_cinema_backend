<?php
$db = new db();
$connect = $db->connect();
$ticket = new ticket($connect);

$ticket->code = isset($_GET["code"]);
if ($ticket->code) {
    $type = isset($_GET['type']) ? $_GET["type"] : false;
    $ticket->code = $_GET['code'];
    $show = $ticket->show($type);

    $ticket_array = [];
    $ticket_array['ticket'] = [];
    while ($row1 = $show->fetch(PDO::FETCH_ASSOC)) {
        extract($row1);
        $arr = [];
        $listTiketSeat =  $ticket->getTiketSeat($id_ticket);
        $arr2 = [];
        while ($row2 =  $listTiketSeat->fetch(PDO::FETCH_ASSOC)) {
            $seat = array(
                "seat" => $row2['id_seat']
            );
            array_push(
                $arr2,
                $seat
            );
        }
        $listTiketCombo =  $ticket->getTiketCombo($id_ticket);
        $arr3 = [];
        while ($row3 =  $listTiketCombo->fetch(PDO::FETCH_ASSOC)) {
            $combo = array(
                "combo" => $row3['name'],
                "quantity" => $row3['quantity'],
                "unit_price" => $row3['unit_price']
            );
            array_push(
                $arr3,
                $combo

            );
        }
        $ticket_item = array(
            "full_name" => $full_name,
            "email" => $email,
            "phone" => $phone,
            "id_ticket" => $id_ticket,
            "name_mv" => $name_mv,
            "image" => $image_lage,
            "date" => $day,
            "time_start" => $time_start,
            "time_create" => $time_create,
            "id_room" => $id_room,
            "ticket_information" => $ticket_information,
            "status" => $status,
            "Total_money" => $Total_money,
            "seat" => $arr2,
            "combo" => $arr3
        );
        array_push($ticket_array['ticket'], $ticket_item);
    }


    $response = array(
        'status' => 'success',
        'data' => $ticket_array,
    );
    $this->response(200, $response);
} else {
    // $sort = isset($_GET["sort"]) ? $_GET["sort"] : false;
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
    $limit = isset($_GET["limit"]) ? $_GET["limit"] : 10;

    $read = $ticket->read($page, $limit);

    $ticket_array = [];
    $ticket_array['ticket'] = [];
    $total = $ticket->total_ticket();
    while ($row4 = $total->fetch(PDO::FETCH_ASSOC)) {
        $total_ticket = array("total_ticket" => $row4['total_ticket']);
    }
    array_push($ticket_array['ticket'], $total_ticket);
    while ($row1 = $read->fetch(PDO::FETCH_ASSOC)) {
        extract($row1);
        $arr = [];
        $listTiketSeat =  $ticket->getTiketSeat($id_ticket);
        $arr2 = [];
        while ($row2 =  $listTiketSeat->fetch(PDO::FETCH_ASSOC)) {
            $seat = array(
                "seat" => $row2['id_seat']
            );
            array_push(
                $arr2,
                $seat

            );
        }

        $listTiketCombo =  $ticket->getTiketCombo($id_ticket);
        $arr3 = [];
        while ($row3 =  $listTiketCombo->fetch(PDO::FETCH_ASSOC)) {
            $combo = array(
                "combo" => $row3['name'],
                "quantity" => $row3['quantity'],
                "unit_price" => $row3['unit_price']
            );
            array_push(
                $arr3,
                $combo

            );
        }
        $ticket_item = array(
            "full_name" => $full_name,
            "id_ticket" => $id_ticket,
            "name_mv" => $name_mv,
            "image" => $image_lage,
            "date" => $day,
            "time_start" => $time_start,
            "id_room" => $id_room,
            "ticket_information" => $ticket_information,
            "status" => $status,
            "Total_money" => $Total_money,
            "seat" => $arr2,
            "combo" => $arr3
        );
        array_push($ticket_array['ticket'], $ticket_item);
    }


    $response = array(
        'status' => 'success',
        'data' => $ticket_array,
    );
    $this->response(200, $response);
}
