<?php
class review
{
    private $conn;

    public $id_review;
    public $name_mv;
    public $full_name;
    public $content;
    public $start;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT mv.name_mv, us.full_name, rv.content, rv.start FROM movie mv INNER JOIN review rv ON mv.id_movie =rv.id_movie INNER JOIN user us ON us.id_user =rv.id_user GROUP BY us.id_movie order by rv.id_movie";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function show()
    {
        $query = "SELECT rv.id_review,mv.name_mv, us.full_name, rv.content, rv.start FROM movie mv INNER JOIN review rv ON rv.id_movie =mv.id_movie INNER JOIN user us ON us.id_user =rv.id_user WHERE rv.id_review=1 GROUP BY rv.id_review order by rv.id_review";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_review);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name_mv = $row['name_mv'];
        $this->full_name = $row['full_name'];
        $this->content = $row['content'];
        $this->start = $row['start'];
    }


    public function create()
    {
        $query = "INSERT INTO `review`(`id_user`, `id_movie`, `content`, `start`) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($query);

        // Clead Data 
        $this->id_user = htmlspecialchars(strip_tags($this->id_user));
        $this->id_movie = htmlspecialchars(strip_tags($this->id_movie));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->start = htmlspecialchars(strip_tags($this->start));

        $stmt->bindParam(1, $this->id_user);
        $stmt->bindParam(2, $this->id_movie);
        $stmt->bindParam(3, $this->content);
        $stmt->bindParam(4, $this->start);


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
