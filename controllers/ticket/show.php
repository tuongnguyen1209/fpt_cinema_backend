<?php
$db = new db();
$connect = $db->connect();
$ticket = new ticket($connect);
$ticket->id_ticket = isset($_GET['id_ticket']);
if ($ticket->id_ticket) {
    $ticket->id_ticket = ($_GET['id_ticket']);
    $ticket->show();
    $id_ticket_item = array(
        "full_name" => $ticket->full_name,
        "id_ticket" => $ticket->id_ticket,
        "name_mv" => $ticket->name_mv,
        "date_start" => $ticket->day_start,
        "time_start" => $ticket->time_start,
        "combo" => $ticket->Combo,
        "id_seat" => $ticket->id_seat,
        "id_room" => $ticket->id_room,
        "ticket_information" => $ticket->ticket_information,
        "status" => $ticket->status,
        "Total_money" => $ticket->Total_money,
    );
    $this->response(200, $id_ticket_item);
} else {

    $read = $ticket->read();

    $ticket_array = [];
    $ticket_array['ticket'] = [];
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


    $this->response(200, $ticket_array);
}
