<?php
class Banner
{
    private $conn;

    public $id_banner;
    public $image;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM banner order by id_banner asc";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function show()
    {
        $query = "SELECT * FROM banner where id_banner=? LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_banner);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->image = $row['image'];
    }


    public function create()
    {
        $query = "INSERT INTO banner set image=:image";
        $stmt = $this->conn->prepare($query);

        // Clead Data 
        $this->image = htmlspecialchars(strip_tags($this->image));


        $stmt->bindParam(':image', $this->image);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }

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
// 
