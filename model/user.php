<?php
class user
{
    private $conn;

    public $id_user;
    public $full_name;
    public $email;
    public $phone;
    public $password;
    public $status;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM user order by id_user asc";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function show()
    {
        $query = "SELECT * FROM user where id_user=? LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_user);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->full_name = $row['full_name'];
        $this->email = $row['email'];
        $this->phone = $row['phone'];
        $this->password = $row['password'];
        $this->status = $row['status'];
    }


    public function create()
    {
        $query = "INSERT INTO user set full_name=:full_name, email=:email, phone=:phone, password=:password,status=:status";
        $stmt = $this->conn->prepare($query);

        // Clead Data 
        $this->full_name = htmlspecialchars(strip_tags($this->full_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->status = htmlspecialchars(strip_tags($this->status));

        $stmt->bindParam(':full_name', $this->full_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':status', $this->status);
        if ($stmt->execute()) {
            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }

    public function update()
    {
        $query = "UPDATE user setfull_name=:full_name, email=:email, phone=:phone, password=:password,status=:status
            where id_user=:id_user";
        $stmt = $this->conn->prepare($query);

        // Clead Data 
        $this->full_name = htmlspecialchars(strip_tags($this->full_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->id_user = htmlspecialchars((strip_tags($this->id_user)));

        $stmt->bindParam(':full_name', $this->full_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':id_user', $this->status);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM user where id_user=:id_user";
        $stmt = $this->conn->prepare($query);

        // Clead Data 
        $this->id_user = htmlspecialchars(strip_tags($this->id_user));

        $stmt->bindParam(':id_user', $this->id_user);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }
}
// 
