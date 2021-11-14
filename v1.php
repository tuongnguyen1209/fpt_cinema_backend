<?php
require_once './interfaceApis.php';
include "./config/db.php";

class api extends  R_api{
    function __construct()
    {
        parent::__construct();
    }

    public function movie()
    {   include_once "./model/movie.php";
       if($this->method == 'GET'){
            //   include_once './controllers/movie/read.php';
              include_once './controllers/movie/show.php';
       }
       else if ($this->method == 'POST') {

            include_once "./controllers/movie/create.php";
        } else if ($this->method == 'PUT') {
            include_once "./controllers/movie/update.php";
        } else if($this->method== 'DELETE'){
            include_once "./controllers/movie/delete.php";
        }
    }
}
$api = new api();
