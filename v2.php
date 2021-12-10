<?php

require_once './interfaceApis.php';
include "./config/db.php";

class apiv2 extends R_api
{
    function __construct()
    {
        parent::__construct();
    }

    public function session()
    {
        try {
            include_once './model/session.php';

            include_once './controllers/session/sessionController.php';
        } catch (Exception $e) {
            $this->response(200, array(
                'status' => 'False',
                'message' => 'Opps, have error!'
            ));
        }
    }
    public function ticket()
    {
        try {
            include_once './model/ticket.php';

            include_once './controllers/ticket/ticketController.php';
        } catch (Exception $e) {
            $this->response(200, array(
                'status' => 'False',
                'message' => 'Opps, have error!'
            ));
        }
    }
}

$api = new apiv2();
