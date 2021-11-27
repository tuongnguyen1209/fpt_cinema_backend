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
    $num = $read->rowCount();
    if ($num > 0) {
        $ticket_array = [];
        $ticket_array['ticket'] = [];

        while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $arr = [];
            $listTiketSeat =  $ticket->getTiketSeat($id_ticket);
            while ($row2 =  $listTiketSeat->fetch(PDO::FETCH_ASSOC))

                print_r($row2);

            $listTiketCombo =  $ticket->getTiketCombo($id_ticket);
            while ($row3 =  $listTiketCombo->fetch(PDO::FETCH_ASSOC))

                print_r($row3);

            // $ticket_item = array(
            //     "full_name" => $full_name,
            //     "id_tickets" => $id_ticket,
            //     "name_mv" => $name_mv,
            //     "date_start" => $day_start,
            //     "time_start" => $time_start,
            //     "combo" => $Combo,
            //     "id_seat" => $id_seat,
            //     "id_room" => $id_room,
            //     "ticket_information" => $ticket_information,
            //     "status" => $status,
            //     "Total_money" => $Total_money,
            // );

            // array_push($ticket_array['ticket'], $ticket_item);
        }


        // $this->response(200, $ticket_array);
    }
}
