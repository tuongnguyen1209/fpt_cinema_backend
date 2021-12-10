<?php
if ($this->method === 'PUT') {
    if ($this->params[0] == 'conform') {

        $db = new db();
        $connect = $db->connect();

        $ticket = new ticket($connect);
        if (!isset($this->params[1])) {
            $this->response(200, array(
                'Status' => 'False',
                'Message' => 'Missing id ticket'
            ));
        }

        if ($ticket->conformGetTicket($this->params[1])) {
            $this->response(200, array(
                'Status' => 'Success',
            ));
        } else {
            $this->response(200, array(
                'Status' => 'False',
                'Message' => 'Have some error'
            ));
        }
    }
}
