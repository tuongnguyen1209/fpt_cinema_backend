<?php
    class Movie{
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
        public $test;

        public function __construct($db){
            $this->conn = $db;
        }

        public function read(){
            $query = "SELECT mv.id_movie, mv.name_mv ,mv.image_mv,mv.traller,mv.date_start,mv.date_end,mv.detail,mv.actor,mv.director,mv.time_mv,(GROUP_CONCAT(ct.name SEPARATOR ', ')) as cate 
            FROM movie mv INNER JOIN movie_category mvct ON mv.id_movie =mvct.id_movie INNER JOIN category ct ON ct.id_category =mvct.id_category GROUP BY mv.id_movie  order by mv.id_movie LIMIT 0,10"; // chưa xử lí limit
            
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function show(){
            $query = "SELECT mv.id_movie, mv.name_mv ,mv.image_mv,mv.traller,mv.date_start,mv.date_end,mv.detail,mv.actor,mv.director,mv.time_mv,(GROUP_CONCAT(ct.name SEPARATOR ', ')) as cate 
            FROM movie mv INNER JOIN movie_category mvct ON mv.id_movie =mvct.id_movie INNER JOIN category ct ON ct.id_category =mvct.id_category
            WHERE mv.id_movie=?  GROUP BY mv.id_movie  order by mv.id_movie LIMIT 1 ;";
            
            $stmt = $this->conn->prepare($query);
            $stmt -> bindParam(1, $this->id_movie);
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
        }


        public function create(){
            $query = "INSERT INTO movie set name_mv=:name_mv, image_mv=:image_mv, traller=:traller, date_start=:date_start, date_end=:date_end 
            ,detail=:detail ,actor=:actor ,director=:director ,time_mv=:time_mv ";
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

            $stmt->bindParam(':name_mv' ,$this->name_mv);
            $stmt->bindParam(':image_mv' ,$this->image_mv);
            $stmt->bindParam(':traller' ,$this->traller);
            $stmt->bindParam(':date_start' ,$this->date_start);
            $stmt->bindParam(':date_end' ,$this->date_end);
            $stmt->bindParam(':detail' ,$this->detail);
            $stmt->bindParam(':actor' ,$this->actor);
            $stmt->bindParam(':director' ,$this->director);
            $stmt->bindParam(':time_mv' ,$this->time_mv);
            
            if($stmt->execute()>0){
               return   $this->conn->lastInsertId();
            }
            printf("Error %s.\n" ,$stmt->error);
            return false;
        }
        public function update(){
            $query = "UPDATE movie set name_mv=:name_mv ,image_mv=:image_mv ,traller=:traller ,date_start=:date_start, date_end=:date_end 
            ,detail=:detail ,actor=:actor ,director=:director ,time_mv=:time_mv 
            where id_movie=:id_movie";
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
            $this->id_movie = htmlspecialchars(strip_tags($this->id_movie));

            $stmt->bindParam(':name_mv' ,$this->name_mv);
            $stmt->bindParam(':image_mv' ,$this->image_mv);
            $stmt->bindParam(':traller' ,$this->traller);
            $stmt->bindParam(':date_start' ,$this->date_start);
            $stmt->bindParam(':date_end' ,$this->date_end);
            $stmt->bindParam(':detail' ,$this->detail);
            $stmt->bindParam(':actor' ,$this->actor);
            $stmt->bindParam(':director' ,$this->director);
            $stmt->bindParam(':time_mv' ,$this->time_mv);
            $stmt->bindParam(':id_movie' ,$this->id_movie);

            if($stmt->execute()){
                return true;
            }
            printf("Error %s.\n" ,$stmt->error);
            return false;
        }

        public function delete(){
            $query = "DELETE FROM movie where id_movie=?";
            $stmt = $this->conn->prepare($query);

            // Clead Data 
            $this->id_movie = htmlspecialchars(strip_tags($this->id_movie));

            $stmt->bindParam(1,$this->id_movie);

            if($stmt->execute()){
                return true;
            }
            printf("Error %s.\n" ,$stmt->error);
            return false;
        }
    
     public function create_CT_MV(){
        $query ='INSERT INTO movie_category SET id_category=:id_category, id_movie=:id_movie';
        $stmt = $this->conn->prepare($query);

        $this->id_movie = htmlspecialchars(strip_tags($this->id_movie));
        $this->id_cate = htmlspecialchars(strip_tags($this->id_cate));

        $stmt->bindParam(':id_movie' ,$this->id_movie);
        $stmt->bindParam(':id_category' ,$this->id_cate);

        if($stmt->execute()){
            return true;
        }
        printf("Error %s.\n" ,$stmt->error);
        return false;
    }



    public function update_CT_MV(){
        $query ='UPDATE movie_category set id_category=:id_category WHERE id_movie=?';
        $stmt = $this->conn->prepare($query);

        $this->id_cate = htmlspecialchars(strip_tags($this->id_cate));

        $stmt->bindParam(':id_category' ,$this->id_cate);

        if($stmt->execute()){
            return true;
        }
        printf("Error %s.\n" ,$stmt->error);
        return false;
    }
    public function delete_CT_MV(){
        $query = "DELETE FROM movie_category where id_movie=?";
        $stmt = $this->conn->prepare($query);

        // Clead Data 
        $this->id_movie = htmlspecialchars(strip_tags($this->id_movie));

        $stmt->bindParam(1,$this->id_movie);

        if($stmt->execute()){
            return true;
        }
        printf("Error %s.\n" ,$stmt->error);
        return false;
    }

    }
