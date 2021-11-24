<?php
require_once './interfaceApis.php';
include "./config/db.php";

class api extends  R_api
{
    function __construct()
    {
        parent::__construct();
    }

    public function movie()
    {
        include_once "./model/movie.php";
        if ($this->method == 'GET') {
            include_once './controllers/movie/show.php';
        } else if ($this->method == 'POST') {
            include_once "./controllers/movie/create.php";
        } else if ($this->method == 'PUT') {
            include_once "./controllers/movie/update.php";
        } else if ($this->method == 'DELETE') {
            include_once "./controllers/movie/delete.php";
        }
    } // chưa xử lí xong

    public function user()
    {
        include_once "./model/user.php";
        if ($this->method == 'GET') {
            include_once './controllers/user/show.php';
        } else if ($this->method == 'POST') {

            include_once "./controllers/user/create.php";
        } else if ($this->method == 'PUT') {
            include_once "./controllers/user/update.php";
        } else if ($this->method == 'DELETE') {
            include_once "./controllers/user/delete.php";
        }
    }

    public function banner()
    {
        include_once "./model/banner.php";
        if ($this->method == 'GET') {
            include_once './controllers/banner/show.php';
        } else if ($this->method == 'POST') {

            include_once "./controllers/banner/create.php";
        } else if ($this->method == 'PUT') {
            include_once "./controllers/banner/update.php";
        } else if ($this->method == 'DELETE') {
            include_once "./controllers/banner/delete.php";
        }
    }


    public function category()
    {
        include_once "./model/category.php";
        if ($this->method == 'GET') {
            //   include_once './controllers/category/read.php';
            include_once './controllers/category/show.php';
        } else if ($this->method == 'POST') {

            include_once "./controllers/category/create.php";
        } else if ($this->method == 'PUT') {
            include_once "./controllers/category/update.php";
        } else if ($this->method == 'DELETE') {
            include_once "./controllers/category/delete.php";
        }
    }


    public function combo()
    {
        include_once "./model/combo.php";
        if ($this->method == 'GET') {
            //   include_once './controllers/combo/read.php';
            include_once './controllers/combo/show.php';
        } else if ($this->method == 'POST') {

            include_once "./controllers/combo/create.php";
        } else if ($this->method == 'PUT') {
            include_once "./controllers/combo/update.php";
        } else if ($this->method == 'DELETE') {
            include_once "./controllers/combo/delete.php";
        }
    }


    public function promotion()
    {
        include_once "./model/promotion.php";
        if ($this->method == 'GET') {
            //   include_once './controllers/promotion/read.php';
            include_once './controllers/promotion/show.php';
        } else if ($this->method == 'POST') {

            include_once "./controllers/promotion/create.php";
        } else if ($this->method == 'PUT') {
            include_once "./controllers/promotion/update.php";
        } else if ($this->method == 'DELETE') {
            include_once "./controllers/promotion/delete.php";
        }
    }


    public function review()
    {
        include_once "./model/room.php";
        if ($this->method == 'GET') {
            //   include_once './controllers/review/read.php';
            include_once './controllers/review/show.php';
        } else if ($this->method == 'POST') {

            include_once "./controllers/review/create.php";
        } else if ($this->method == 'PUT') {
            include_once "./controllers/review/update.php";
        } else if ($this->method == 'DELETE') {
            include_once "./controllers/review/delete.php";
        }
    }

    public function room()
    {
        include_once "./model/room.php";
        if ($this->method == 'GET') {
            include_once './controllers/room/show.php';
        }
    }


    public function ticket()
    {
        include_once "./model/ticket.php";
        if ($this->method == 'GET') {
            include_once './controllers/ticket/show.php';
        } else if ($this->method == 'POST') {
            include_once './controllers/ticket/create.php';
        }
    }

    public function session()
    {
        include_once "./model/session.php";
        if ($this->method == 'GET') {
            include_once './controllers/session/show.php';
        } else if ($this->method == 'POST') {

            include_once "./controllers/session/create.php";
        } else if ($this->method == 'PUT') {
            include_once "./controllers/session/update.php";
        } else if ($this->method == 'DELETE') {
            include_once "./controllers/session/delete.php";
        }
    }
}
$api = new api();
