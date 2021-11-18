<?php
class category
{
    private $conn;

    public $id_category;
    public $name;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM category order by id_category asc";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function show()
    {
        $query = "SELECT * FROM category where id_category=? LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_category);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
    }


    public function create()
    {
        $query = "INSERT INTO category set name=:name";
        $stmt = $this->conn->prepare($query);

        // Clead Data 
        $this->name = htmlspecialchars(strip_tags($this->name));


        $stmt->bindParam(':name', $this->name);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }

    public function update()
    {
        $query = "UPDATE category set name:=name
            where id_category=:id_category";
        $stmt = $this->conn->prepare($query);

        // Clead Data 
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->id_category = htmlspecialchars(strip_tags($this->id_category));


        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':id_category', $this->id_category);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM category where id_category=:id_category";
        $stmt = $this->conn->prepare($query);

        // Clead Data 
        $this->id_category = htmlspecialchars(strip_tags($this->id_category));

        $stmt->bindParam(':id_category', $this->id_category);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }
}
