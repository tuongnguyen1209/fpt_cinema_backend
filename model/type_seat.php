<?php
    class type_seat{
        private $conn;

        public $id_type;
        public $name_type;
        public $default_price;
        
        public function __construct($db){
            $this->conn = $db;
        }

        public function read(){
            $query = "SELECT * FROM type_seat GROUP BY id_type ASC";
            
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function show(){
            $query = "SELECT * FROM type_seat Where id_type =?";
            
            $stmt = $this->conn->prepare($query);
            $stmt -> bindParam(1, $this->id_type_seat);
            $stmt->execute();
           
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->name_type = $row['name_type'];
            $this->default_price =$row['default_price'];
            
    }


        // public function create(){
        //     $query = "INSERT INTO review set sale=:sale,name=:name,detail=:detail";
        //     $stmt = $this->conn->prepare($query);

        //     // Clead Data 
        //     $this->name = htmlspecialchars(strip_tags($this->name));
        //     $this->sale = htmlspecialchars(strip_tags($this->sale));
        //     $this->detail = htmlspecialchars(strip_tags($this->detail));
        //     $this->date_start = htmlspecialchars(strip_tags($this->date_start));
        //     $this->date_end = htmlspecialchars(strip_tags($this->date_end));
        //     $this->quantity = htmlspecialchars(strip_tags($this->quantity));
            

        //     $stmt->bindParam(':name' ,$this->name);
        //     $stmt->bindParam(':sale' ,$this->sale);
        //     $stmt->bindParam(':detail' ,$this->detail);
        //     $stmt->bindParam(':date_start' ,$this->date_start);
        //     $stmt->bindParam(':date_end' ,$this->date_end);
        //     $stmt->bindParam(':quantity' ,$this->quantity);

            
        //     if($stmt->execute()){
        //         return true;
        //     }
        //     printf("Error %s.\n" ,$stmt->error);
        //     return false;
        // }

//         public function update(){
//             $query = "UPDATE movie set name_mv=:name_mv ,image_mv=:image_mv ,traller=:traller ,date_start=:date_start, date_end=:date_end 
//             ,detail=:detail ,actor=:actor ,director=:director ,time_mv=:time_mv 
//             where id_movie=:id_movie";
//             $stmt = $this->conn->prepare($query);

//             // Clead Data 
//             $this->name_mv = htmlspecialchars(strip_tags($this->name_mv));
//             $this->image_mv = htmlspecialchars(strip_tags($this->image_mv));
//             $this->traller = htmlspecialchars(strip_tags($this->traller));
//             $this->date_start = htmlspecialchars(strip_tags($this->date_start));
//             $this->date_end = htmlspecialchars(strip_tags($this->date_end));
//             $this->detail = htmlspecialchars(strip_tags($this->detail));
//             $this->actor = htmlspecialchars(strip_tags($this->actor));
//             $this->director = htmlspecialchars(strip_tags($this->director));
//             $this->time_mv = htmlspecialchars(strip_tags($this->time_mv));
//             $this->id_movie = htmlspecialchars(strip_tags($this->id_movie));

//             $stmt->bindParam(':name_mv' ,$this->name_mv);
//             $stmt->bindParam(':image_mv' ,$this->image_mv);
//             $stmt->bindParam(':traller' ,$this->traller);
//             $stmt->bindParam(':date_start' ,$this->date_start);
//             $stmt->bindParam(':date_end' ,$this->date_end);
//             $stmt->bindParam(':detail' ,$this->detail);
//             $stmt->bindParam(':actor' ,$this->actor);
//             $stmt->bindParam(':director' ,$this->director);
//             $stmt->bindParam(':time_mv' ,$this->time_mv);
//             $stmt->bindParam(':id_movie' ,$this->id_movie);

//             if($stmt->execute()){
//                 return true;
//             }
//             printf("Error %s.\n" ,$stmt->error);
//             return false;
//         }

//         public function delete(){
//             $query = "DELETE FROM movie where id_movie=:id_movie";
//             $stmt = $this->conn->prepare($query);

//             // Clead Data 
//             $this->id_movie = htmlspecialchars(strip_tags($this->id_movie));

//             $stmt->bindParam(':id_movie' ,$this->id_movie);

//             if($stmt->execute()){
//                 return true;
//             }
//             printf("Error %s.\n" ,$stmt->error);
//             return false;
//         }
    }
// ?>