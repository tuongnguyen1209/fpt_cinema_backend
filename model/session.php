<?php
    class session{
        private $conn;

        public $id_session;
        public $name_mv;
        public $name;
        public $time_start;
        public $time_end;
        public $type;


        
        public function __construct($db){
            $this->conn = $db;
        }

        public function read(){
            $query = "SELECT se.id_session, mv.name_mv , rm.name ,se.type , st.time_start, st.time_end
            FROM movie mv INNER JOIN session se ON mv.id_movie = se.id_movie INNER JOIN room rm ON rm.id_room = se.id_room INNER JOIN showtimes st ON st.id_showtimes = se.id_showtimes GROUP BY se.id_session";
            
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function show(){
            $query = "SELECT se.id_session, mv.name_mv , rm.name ,se.type , st.time_start, st.time_end
            FROM movie mv INNER JOIN session se ON mv.id_movie = se.id_movie INNER JOIN room rm ON rm.id_room = se.id_room INNER JOIN showtimes st ON st.id_showtimes = se.id_showtimes
            where se.id_session =? GROUP BY se.id_session";
            
            $stmt = $this->conn->prepare($query);
            $stmt -> bindParam(1, $this->id_session);
            $stmt->execute();
           
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->name_mv = $row['name_mv'];
            $this->name = $row['name'];
            $this->time_start = $row['time_start'];
            $this->time_end = $row['time_end'];
            $this->type = $row['type'];
    }


        public function create(){
            $query = "INSERT INTO session set id_movie =:id_movie ,id_room=:id_room,type=:type, id_showtimes=:id_showtimes";
            $stmt = $this->conn->prepare($query);

            // Clead Data 
            $this->id_room = htmlspecialchars(strip_tags($this->id_room));
            $this->id_movie  = htmlspecialchars(strip_tags($this->id_movie ));
            $this->type = htmlspecialchars(strip_tags($this->type));
            $this->id_showtimes = htmlspecialchars(strip_tags($this->id_showtimes));
            

            $stmt->bindParam(':id_room' ,$this->id_room);
            $stmt->bindParam(':id_movie ' ,$this->id_movie );
            $stmt->bindParam(':type' ,$this->type);
            $stmt->bindParam(':id_showtimes' ,$this->id_showtimes);

            
            if($stmt->execute()){
                return true;
            }
            printf("Error %s.\n" ,$stmt->error);
            return false;
        }

        public function update(){
            $query = "UPDATE session set id_movie=:id_movie ,id_room=:id_room ,type=:type ,id_showtimes=:id_showtimes
            where id_session=:id_session";
            $stmt = $this->conn->prepare($query);

            // Clead Data 
            $this->id_movie = htmlspecialchars(strip_tags($this->id_movie));
            $this->id_room = htmlspecialchars(strip_tags($this->id_room));
            $this->type = htmlspecialchars(strip_tags($this->type));
            $this->id_showtimes = htmlspecialchars(strip_tags($this->id_showtimes));
            $this->id_session = htmlspecialchars(strip_tags($this->id_session));

            $stmt->bindParam(':id_movie' ,$this->id_movie);
            $stmt->bindParam(':id_room' ,$this->id_room);
            $stmt->bindParam(':type' ,$this->type);
            $stmt->bindParam(':id_showtimes' ,$this->id_showtimes);
            $stmt->bindParam(':id_session' ,$this->id_session);

            if($stmt->execute()){
                return true;
            }
            printf("Error %s.\n" ,$stmt->error);
            return false;
        }

        public function delete(){
            $query = "DELETE FROM session where id_session=:id_session";
            $stmt = $this->conn->prepare($query);

            // Clead Data 
            $this->id_session = htmlspecialchars(strip_tags($this->id_session));

            $stmt->bindParam(':id_session' ,$this->id_session);

            if($stmt->execute()){
                return true;
            }
            printf("Error %s.\n" ,$stmt->error);
            return false;
        }
    }
// 
