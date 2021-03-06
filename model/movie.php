<?php
class Movie
{
    private $conn;

    public $id_movie;
    public $name_mv;
    public $image_lage;
    public $image_medium;
    public $traller;
    public $date_start;
    public $date_end;
    public $detail;
    public $actor;
    public $director;
    public $time_mv;
    public $cate;
    public $id_cate;

    public $image_banner;
    public $status;
    public $name_vn;
    public $country;
    public $production;
    public $rate;

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
            $query = " SELECT mv.id_movie,mv.image_lage,mv.image_medium,mv.image_banner,mv.country,mv.rate,mv.status,mv.production,mv.name_vn, mv.name_mv ,mv.traller,mv.date_start,mv.detail,mv.actor,mv.director,mv.time_mv,(GROUP_CONCAT(ct.name SEPARATOR ', ')) as cate 
            FROM movie mv INNER JOIN movie_category mvct ON mv.id_movie =mvct.id_movie INNER JOIN category ct ON ct.id_category =mvct.id_category GROUP BY mv.id_movie order by mv.id_movie  LIMIT $start,$end";
        } elseif ($sort == "id_desc") {
            $query = "SELECT mv.id_movie,mv.image_lage,mv.image_medium,mv.image_banner,mv.country,mv.rate,mv.status,mv.production,mv.name_vn, mv.name_mv ,mv.traller,mv.date_start,mv.detail,mv.actor,mv.director,mv.time_mv,(GROUP_CONCAT(ct.name SEPARATOR ', ')) as cate 
            FROM movie mv INNER JOIN movie_category mvct ON mv.id_movie =mvct.id_movie INNER JOIN category ct ON ct.id_category =mvct.id_category GROUP BY mv.id_movie order by mv.id_movie DESC LIMIT $start,$end";
        } else if ($sort == "day") {
            $query = "SELECT mv.id_movie,mv.image_lage,mv.image_medium,mv.image_banner,mv.country,mv.rate,mv.status,mv.production,mv.name_vn, mv.name_mv ,mv.traller,mv.date_start,mv.detail,mv.actor,mv.director,mv.time_mv,(GROUP_CONCAT(ct.name SEPARATOR ', ')) as cate 
            FROM movie mv INNER JOIN movie_category mvct ON mv.id_movie =mvct.id_movie INNER JOIN category ct ON ct.id_category =mvct.id_category GROUP BY mv.date_start order by mv.date_start LIMIT $start,$end";
        } elseif ($sort == "day_desc") {
            $query = "SELECT mv.id_movie,mv.image_lage,mv.image_medium,mv.image_banner,mv.country,mv.rate,mv.status,mv.production,mv.name_vn, mv.name_mv ,mv.traller,mv.date_start,mv.detail,mv.actor,mv.director,mv.time_mv,(GROUP_CONCAT(ct.name SEPARATOR ', ')) as cate 
            FROM movie mv INNER JOIN movie_category mvct ON mv.id_movie =mvct.id_movie INNER JOIN category ct ON ct.id_category =mvct.id_category GROUP BY mv.date_start order by mv.date_start DESC LIMIT $start,$end";
        } elseif ($sort == "name") {
            $query = "SELECT mv.id_movie,mv.image_lage,mv.image_medium,mv.image_banner,mv.country,mv.rate,mv.status,mv.production,mv.name_vn, mv.name_mv ,mv.traller,mv.date_start,mv.detail,mv.actor,mv.director,mv.time_mv,(GROUP_CONCAT(ct.name SEPARATOR ', ')) as cate 
            FROM movie mv INNER JOIN movie_category mvct ON mv.id_movie =mvct.id_movie INNER JOIN category ct ON ct.id_category =mvct.id_category GROUP BY mv.name_mv order by mv.name_mv LIMIT $start,$end";
        } elseif ($sort == "name_desc") {
            $query = "SELECT mv.id_movie,mv.image_lage,mv.image_medium,mv.image_banner,mv.country,mv.rate,mv.status,mv.production,mv.name_vn, mv.name_mv ,mv.traller,mv.date_start,mv.detail,mv.actor,mv.director,mv.time_mv,(GROUP_CONCAT(ct.name SEPARATOR ', ')) as cate 
            FROM movie mv INNER JOIN movie_category mvct ON mv.id_movie =mvct.id_movie INNER JOIN category ct ON ct.id_category =mvct.id_category GROUP BY mv.name_mv order by mv.name_mv DESC LIMIT $start,$end";
        } elseif ($sort == "sapchieu") {
            $query = "SELECT mv.id_movie,mv.image_lage,mv.image_medium,mv.image_banner,mv.country,mv.rate,mv.status,mv.production,mv.name_vn, mv.name_mv ,mv.traller,mv.date_start,mv.date_end,mv.detail,mv.actor,mv.director,mv.time_mv,(GROUP_CONCAT(ct.name SEPARATOR ', ')) as cate 
            FROM movie mv INNER JOIN movie_category mvct ON mv.id_movie =mvct.id_movie INNER JOIN category ct ON ct.id_category =mvct.id_category
            WHERE mv.date_start >= now() 
            GROUP BY mv.id_movie order by mv.id_movie LIMIT $start,$end";
        } elseif ($sort == "congchieu") {
            $query = "SELECT mv.id_movie,mv.image_lage,mv.image_medium,mv.image_banner,mv.country,mv.rate,mv.status,mv.production,mv.name_vn, mv.name_mv ,mv.traller,mv.date_start,mv.date_end,mv.detail,mv.actor,mv.director,mv.time_mv,(GROUP_CONCAT(ct.name SEPARATOR ', ')) as cate 
            FROM movie mv INNER JOIN movie_category mvct ON mv.id_movie =mvct.id_movie INNER JOIN category ct ON ct.id_category =mvct.id_category
            WHERE mv.date_start < now() 
            GROUP BY mv.id_movie order by mv.id_movie LIMIT $start,$end";
        }
        $stmt = $this->conn->prepare($query);
        // $stmt->bindParam("start", $start);
        // $stmt->bindParam("end", $end);

        // $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function show()
    {
        $query = "SELECT mv.id_movie,mv.image_lage,mv.image_medium,mv.image_banner,mv.country,mv.rate,mv.status,mv.production,mv.name_vn, mv.name_mv ,mv.traller,mv.date_start,mv.detail,mv.actor,mv.director,mv.time_mv,(GROUP_CONCAT(ct.name SEPARATOR ', ')) as cate 
        FROM movie mv INNER JOIN movie_category mvct ON mv.id_movie =mvct.id_movie INNER JOIN category ct ON ct.id_category =mvct.id_category WHERE mv.id_movie = ?  GROUP BY mv.id_movie order by mv.id_movie";

        // $query = "call movie_show_one(?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_movie);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name_mv = $row['name_mv'];
        $this->name_vn = $row['name_vn'];
        $this->image_lage = $row['image_lage'];
        $this->image_medium = $row['image_medium'];
        $this->traller = $row['traller'];
        $this->date_start = $row['date_start'];
        $this->image_banner = $row['image_banner'];
        $this->detail = $row['detail'];
        $this->actor = $row['actor'];
        $this->director = $row['director'];
        $this->time_mv = $row['time_mv'];
        $this->cate = $row['cate'];
        $this->rate = $row['rate'];
        $this->production = $row['production'];
        $this->country = $row['country'];
        $this->name_vn = $row['name_vn'];
    }
    public function create()
    {
        // $query = "INSERT INTO `movie`(`name_mv`, `image_mv`, `traller`, `date_start`, `date_end`, `detail`, `actor`, `director`, `time_mv`, `banner`, `name_vn`, `status`, `country`, `production`, `rate`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $query = "INSERT INTO `movie`(`name_mv`, `image_lage`, `traller`, `date_start`, `date_end`, `detail`, `actor`, `director`, `time_mv`, `image_banner`, `name_vn`, `status`, `country`, `production`, `rate`, `image_medium`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);

        // Clead Data 
        $this->name_mv = htmlspecialchars(strip_tags($this->name_mv));
        $this->image_lage = htmlspecialchars(strip_tags($this->image_lage));
        $this->traller = htmlspecialchars(strip_tags($this->traller));
        $this->date_start = htmlspecialchars(strip_tags($this->date_start));
        $this->date_end = htmlspecialchars(strip_tags($this->date_end));
        $this->detail = htmlspecialchars(strip_tags($this->detail));
        $this->actor = htmlspecialchars(strip_tags($this->actor));
        $this->director = htmlspecialchars(strip_tags($this->director));
        $this->time_mv = htmlspecialchars(strip_tags($this->time_mv));

        $this->image_banner = htmlspecialchars(strip_tags($this->image_banner));
        $this->name_vn = htmlspecialchars(strip_tags($this->name_vn));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->country = htmlspecialchars(strip_tags($this->country));
        $this->production = htmlspecialchars(strip_tags($this->production));
        $this->rate = htmlspecialchars(strip_tags($this->rate));
        $this->image_medium = htmlspecialchars(strip_tags($this->image_medium));


        $stmt->bindParam(1, $this->name_mv);
        $stmt->bindParam(2, $this->image_lage);
        $stmt->bindParam(3, $this->traller);
        $stmt->bindParam(4, $this->date_start);
        $stmt->bindParam(5, $this->date_end);
        $stmt->bindParam(6, $this->detail);
        $stmt->bindParam(7, $this->actor);
        $stmt->bindParam(8, $this->director);
        $stmt->bindParam(9, $this->time_mv);

        $stmt->bindParam(10, $this->image_banner);
        $stmt->bindParam(12, $this->status);
        $stmt->bindParam(11, $this->name_vn);
        $stmt->bindParam(13, $this->country);
        $stmt->bindParam(14, $this->production);
        $stmt->bindParam(15, $this->rate);
        $stmt->bindParam(16, $this->image_medium);

        if ($stmt->execute() > 0) {
            return   $this->conn->lastInsertId();
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }
    public function update()
    {
        $query = "UPDATE  movie set name_mv=:name_mv, image_lage=:image_lage, traller=:traller, date_start=:date_start, date_end=:date_end 
        ,detail=:detail ,actor=:actor ,director=:director ,time_mv=:time_mv, image_banner=:banner, status=:status,name_vn=:name_vn, country=:country, production=:production,rate=:rate
      ,  image_medium=:image_medium    where id_movie=:id_movie";
        $stmt = $this->conn->prepare($query);

        // Clead Data 
        // Clead Data 
        $this->name_mv = htmlspecialchars(strip_tags($this->name_mv));
        $this->image_lage = htmlspecialchars(strip_tags($this->image_lage));
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
        $this->image_medium = htmlspecialchars(strip_tags($this->image_medium));

        $stmt->bindParam(':name_mv', $this->name_mv);
        $stmt->bindParam(':image_lage', $this->image_lage);
        $stmt->bindParam(':image_medium', $this->image_medium);
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
