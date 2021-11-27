<?php
class Movie
{
    private $conn;

    public $id_movie;
    public $name_mv;
    public $image_mv;
    public $traller;
    public $date_start;
    public $date_end;
    public $detail;
    public $actor;
    public $director;
    public $time_mv;
    public $cate;
    public $id_cate;

    public $banner;
    public $status;
    public $name_vn;
    public $country;
    public $production;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read($page = 1, $sort = false, $limit = 4)
    {
        // $query = "SELECT mv.id_movie,mv.banner,mv.country,mv.rate,mv.status,mv.production,mv.name_vn, mv.name_mv ,mv.image_mv,mv.traller,mv.date_start,mv.date_end,mv.detail,mv.actor,mv.director,mv.time_mv,(GROUP_CONCAT(ct.name SEPARATOR ', ')) as cate 
        // FROM movie mv INNER JOIN movie_category mvct ON mv.id_movie =mvct.id_movie INNER JOIN category ct ON ct.id_category =mvct.id_category GROUP BY mv.id_movie"; // chưa xử lí limit
        $start = $limit * ($page - 1);
        // if ($start >= 1) {
        // $end = $limit + $start;
        // } else {
        $end = $limit;
        // }

        if ($sort == "id" || $sort == "") {
            $query = " call movie_show_id(?,?) ";
        } elseif ($sort == "id_desc") {
            $query = " call movie_show_id_DESC(?,?)";
        } else if ($sort == "day") {
            $query = " call movie_show_day(?,?) ";
        } elseif ($sort == "day_desc") {
            $query = " call movie_show_day_DESC(?,?) ";
        } elseif ($sort == "name") {
            $query = " call movie_show_name(?,?)  ";
        } elseif ($sort == "name_DESC") {
            $query = " call movie_show_name_DESC(?,?)  ";
        }
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $start);
        $stmt->bindParam(2, $end);

        // $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function show()
    {
        // $query = "SELECT mv.id_movie,mv.banner,mv.country,mv.rate,mv.status,mv.production,mv.name_vn, mv.name_mv ,mv.image_mv,mv.traller,mv.date_start,mv.date_end,mv.detail,mv.actor,mv.director,mv.time_mv,(GROUP_CONCAT(ct.name SEPARATOR ', ')) as cate, sts.time_start,sts.time_end,se.day_start,se.day_end
        // FROM movie mv INNER JOIN movie_category mvct ON mv.id_movie =mvct.id_movie INNER JOIN category ct ON ct.id_category =mvct.id_category INNER JOIN session se on mv.id_movie=se.id_movie  INNER JOIN showtimes sts on sts.id_showtimes =se.id_showtimes  WHERE mv.id_movie=? GROUP BY mv.id_movie";

        $query = "call movie_show_one(?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_movie);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name_mv = $row['name_mv'];
        $this->image_mv = $row['image_mv'];
        $this->traller = $row['traller'];
        $this->date_start = $row['date_start'];
        $this->date_end = $row['date_end'];
        $this->detail = $row['detail'];
        $this->actor = $row['actor'];
        $this->director = $row['director'];
        $this->time_mv = $row['time_mv'];
        $this->cate = $row['cate'];
        $this->time_start = $row['time_start'];
        $this->time_end = $row['time_end'];
        $this->day_start = $row['day_start'];
        $this->day_end = $row['day_end'];
    }

    public function read_day_start()
    {

        $query = "SELECT * From movie GROUP BY date_start order by id_movie";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_movie);
        $stmt->execute();
    }



    public function create()
    {
        // $query = "INSERT INTO `movie`(`name_mv`, `image_mv`, `traller`, `date_start`, `date_end`, `detail`, `actor`, `director`, `time_mv`, `banner`, `name_vn`, `status`, `country`, `production`, `rate`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $query = "call movie_create(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);

        // Clead Data 
        $this->name_mv = htmlspecialchars(strip_tags($this->name_mv));
        $this->image_mv = htmlspecialchars(strip_tags($this->image_mv));
        $this->traller = htmlspecialchars(strip_tags($this->traller));
        $this->date_start = htmlspecialchars(strip_tags($this->date_start));
        $this->date_end = htmlspecialchars(strip_tags($this->date_end));
        $this->detail = htmlspecialchars(strip_tags($this->detail));
        $this->actor = htmlspecialchars(strip_tags($this->actor));
        $this->director = htmlspecialchars(strip_tags($this->director));
        $this->time_mv = htmlspecialchars(strip_tags($this->time_mv));

        $this->banner = htmlspecialchars(strip_tags($this->banner));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->name_vn = htmlspecialchars(strip_tags($this->name_vn));
        $this->country = htmlspecialchars(strip_tags($this->country));
        $this->production = htmlspecialchars(strip_tags($this->production));
        $this->rate = htmlspecialchars(strip_tags($this->rate));


        $stmt->bindParam(1, $this->name_mv);
        $stmt->bindParam(2, $this->image_mv);
        $stmt->bindParam(3, $this->traller);
        $stmt->bindParam(4, $this->date_start);
        $stmt->bindParam(5, $this->date_end);
        $stmt->bindParam(6, $this->detail);
        $stmt->bindParam(7, $this->actor);
        $stmt->bindParam(8, $this->director);
        $stmt->bindParam(9, $this->time_mv);

        $stmt->bindParam(10, $this->banner);
        $stmt->bindParam(12, $this->status);
        $stmt->bindParam(11, $this->name_vn);
        $stmt->bindParam(13, $this->country);
        $stmt->bindParam(14, $this->production);
        $stmt->bindParam(15, $this->rate);

        if ($stmt->execute() > 0) {
            return   $this->conn->lastInsertId();
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }
    public function update()
    {
        $query = "UPDATE  movie set name_mv=:name_mv, image_mv=:image_mv, traller=:traller, date_start=:date_start, date_end=:date_end 
        ,detail=:detail ,actor=:actor ,director=:director ,time_mv=:time_mv, banner=:banner, status=:status,name_vn=:name_vn, country=:country, production=:production,rate=:rate
            where id_movie=:id_movie";
        $stmt = $this->conn->prepare($query);

        // Clead Data 
        // Clead Data 
        $this->name_mv = htmlspecialchars(strip_tags($this->name_mv));
        $this->image_mv = htmlspecialchars(strip_tags($this->image_mv));
        $this->traller = htmlspecialchars(strip_tags($this->traller));
        $this->date_start = htmlspecialchars(strip_tags($this->date_start));
        $this->date_end = htmlspecialchars(strip_tags($this->date_end));
        $this->detail = htmlspecialchars(strip_tags($this->detail));
        $this->actor = htmlspecialchars(strip_tags($this->actor));
        $this->director = htmlspecialchars(strip_tags($this->director));
        $this->time_mv = htmlspecialchars(strip_tags($this->time_mv));
        $this->id_movie = htmlspecialchars(strip_tags($this->id_movie));
        $this->banner = htmlspecialchars(strip_tags($this->banner));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->name_vn = htmlspecialchars(strip_tags($this->name_vn));
        $this->country = htmlspecialchars(strip_tags($this->country));
        $this->production = htmlspecialchars(strip_tags($this->production));
        $this->rate = htmlspecialchars(strip_tags($this->rate));


        $stmt->bindParam(':name_mv', $this->name_mv);
        $stmt->bindParam(':image_mv', $this->image_mv);
        $stmt->bindParam(':traller', $this->traller);
        $stmt->bindParam(':date_start', $this->date_start);
        $stmt->bindParam(':date_end', $this->date_end);
        $stmt->bindParam(':detail', $this->detail);
        $stmt->bindParam(':actor', $this->actor);
        $stmt->bindParam(':director', $this->director);
        $stmt->bindParam(':time_mv', $this->time_mv);
        $stmt->bindParam(':id_movie', $this->id_movie);
        $stmt->bindParam(':banner', $this->banner);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':name_vn', $this->name_vn);
        $stmt->bindParam(':country', $this->country);
        $stmt->bindParam(':rate', $this->rate);
        $stmt->bindParam(':production', $this->production);


        if ($stmt->execute()) {
            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }

    public function delete()
    {
        // $query = "DELETE FROM movie where id_movie=?";
        $query = " call movie_delete(?)";
        $stmt = $this->conn->prepare($query);

        // Clead Data 
        $this->id_movie = htmlspecialchars(strip_tags($this->id_movie));

        $stmt->bindParam(1, $this->id_movie);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }

    public function create_CT_MV()
    {
        $query = 'INSERT INTO movie_category SET id_category=:id_category, id_movie=:id_movie';
        $stmt = $this->conn->prepare($query);

        $this->id_movie = htmlspecialchars(strip_tags($this->id_movie));
        $this->id_cate = htmlspecialchars(strip_tags($this->id_cate));

        $stmt->bindParam(':id_movie', $this->id_movie);
        $stmt->bindParam(':id_category', $this->id_cate);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }

    // public function update_CT_MV()
    // {
    //     $query = "UPDATE movie_category set id_category=:id_category where id_movie=:id_movie";
    //     $stmt = $this->conn->prepare($query);

    //     // Clead Data 

    //     $this->time_mv = htmlspecialchars(strip_tags($this->id_cate));
    //     $this->id_movie = htmlspecialchars(strip_tags($this->id_movie));

    //     $stmt->bindParam(':id_movie', $this->id_movie);
    //     $stmt->bindParam(':id_category', $this->id_cate);

    //     if ($stmt->execute()) {
    //         return true;
    //     }
    //     printf("Error %s.\n", $stmt->error);
    //     return false;
    // }
    public function delete_CT_MV()
    {
        $query = "DELETE FROM movie_category where id_movie=?";
        $stmt = $this->conn->prepare($query);

        // Clead Data 
        $this->id_movie = htmlspecialchars(strip_tags($this->id_movie));

        $stmt->bindParam(1, $this->id_movie);


        if ($stmt->execute()) {
            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }
}
