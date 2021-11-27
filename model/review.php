<?php
class review
{
    private $conn;
    public $name_mv;
    public $full_name;
    public $content;
    public $start;
    public $id_user;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "call review_read()";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function show()
    {
        $query = "call review_one(?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_user);
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

    public function update()
    {
        $query = "UPDATE review set content=:content,start=:start  where id_user=:id_user and id_movie=:id_movie";
        $stmt = $this->conn->prepare($query);

        // Clead Data
        $this->id_movie = htmlspecialchars(strip_tags($this->id_movie));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->start = htmlspecialchars(strip_tags($this->start));
        $this->id_user = htmlspecialchars(strip_tags($this->id_user));

        $stmt->bindParam(':id_movie', $this->id_movie);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':start', $this->start);
        $stmt->bindParam(':id_user', $this->id_user);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM review where id_user=:id_user and id_movie=:id_movie";
        $stmt = $this->conn->prepare($query);

        // Clead Data 
        $this->id_user = htmlspecialchars(strip_tags($this->id_user));
        $this->id_movie = htmlspecialchars(strip_tags($this->id_movie));

        $stmt->bindParam(':id_user', $this->id_user);
        $stmt->bindParam(':id_user', $this->id_movie);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }
}
// 
