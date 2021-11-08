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

        public function __construct($db){
            $this->conn = $db;
        }

        public function read(){
            $query = "SELECT * FROM movie order by id_movie asc";
            
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function show(){
            $query = "SELECT * FROM movie where id_movie=? LIMIT 1";
            
            $stmt = $this->conn->prepare($query);
            $stmt -> bindParam(1, $this->id_movie);
            $stmt->execute();
           
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->name = $row['name_mv'];
            $this->image = $row['image_mv'];
            $this->traller = $row['traller'];
            $this->date_start = $row['date_start'];
            $this->date_end = $row['date_end'];
            $this->detail = $row['detail'];
            $this->actor = $row['actor'];
            $this->director = $row['director'];
            $this->time = $row['time_mv'];
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

            if($stmt->execute()){
                return true;
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
            $query = "DELETE FROM movie where id_movie=:id_movie";
            $stmt = $this->conn->prepare($query);

            // Clead Data 
            $this->id_movie = htmlspecialchars(strip_tags($this->id_movie));

            $stmt->bindParam(':id_movie' ,$this->id_movie);

            if($stmt->execute()){
                return true;
            }
            printf("Error %s.\n" ,$stmt->error);
            return false;
        }
    }
?>