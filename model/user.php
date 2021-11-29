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
    public $administration;

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
        $query = "INSERT INTO user set full_name=:full_name, email=:email, phone=:phone, password=:password,status=:status,create_at = now()";
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
        $query = "UPDATE user set full_name=:full_name, email=:email, phone=:phone, password=:password,status=:status,administration=:administration  where id_user=:id_user";
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
        $stmt->bindParam(':id_user', $this->id_user);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }
    public function update_status($status)
    {
        $query = "UPDATE user set status=:status  where id_user=:id_user";
        $stmt = $this->conn->prepare($query);
        $this->status = htmlspecialchars(strip_tags($this->status));
        $stmt->bindParam(':status', $this->status);
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

    public function login($username, $pws)
    {
        $query = "SELECT id_user, full_name, email, phone, status  FROM user WHERE email=? and password=? ";


        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $pws);
        $stmt->execute();



        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($row['id_user'])) {

            $this->id_user = $row['id_user'];
            $this->full_name = $row['full_name'];
            $this->email = $row['email'];
            $this->phone = $row['phone'];
            $this->status = $row['status'];
            return true;
        } else {
            return false;
        }
    }
}
// 
