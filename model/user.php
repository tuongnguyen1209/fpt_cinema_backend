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
    public $img_user;
    public $point;
    public $sum_all;


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
        $query = "SELECT user.id_user,user.full_name,user.email,user.phone,user.password,user.status,user.create_at,user.administration,user.img_user,
        (COUNT(ticket.id_ticket)*10) as point , SUM(ticket.Total_money) as sum_all
        FROM `user`INNER JOIN ticket ON ticket.id_user=user.id_user WHERE user.id_user=?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_user);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->full_name = $row['full_name'];
        $this->email = $row['email'];
        $this->phone = $row['phone'];
        $this->password = $row['password'];
        $this->status = $row['status'];
        $this->administration = $row['administration'];
        $this->img_user = $row['img_user'];
        $this->point = $row['point'];
        $this->sum_all = $row["sum_all"];
    }


    public function create($idGoogle = null, $idFacebook = null)
    {
        $query = "INSERT INTO user set full_name=:full_name, email=:email, phone=:phone, password=:password,status=:status,img_user=:img_user,create_at = now(),administration=0 ";

        if (isset($idGoogle)) {
            $query .= "  ,google_id =$idGoogle";
        }
        if (isset($idFacebook)) {
            $query .= "  ,facebook_id =$idFacebook";
        }

        $stmt = $this->conn->prepare($query);

        // Clead Data 
        $this->full_name = htmlspecialchars(strip_tags($this->full_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->img_user = htmlspecialchars(strip_tags($this->img_user));


        $stmt->bindParam(':full_name', $this->full_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':img_user', $this->img_user);
        if ($stmt->execute()) {

            $this->id_user = $this->conn->lastInsertId();
            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }

    public function update()
    {
        $query = "UPDATE user set full_name=:full_name, email=:email, phone=:phone, password=:password,status=:status,administration=:administration,img_user=:img_user  where id_user=:id_user";
        $stmt = $this->conn->prepare($query);

        // Clead Data 
        $this->full_name = htmlspecialchars(strip_tags($this->full_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->id_user = htmlspecialchars((strip_tags($this->id_user)));
        $this->img_user = htmlspecialchars((strip_tags($this->img_user)));

        $stmt->bindParam(':full_name', $this->full_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':id_user', $this->id_user);
        $stmt->bindParam(':img_user', $this->img_user);

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
        $query = "SELECT id_user, full_name, email, phone, status,administration  FROM user WHERE email=? and password=? ";


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
            $this->administration = $row['administration'];
            return true;
        } else {
            return false;
        }
    }

    public function checkFacebook($id_facebook)
    {
        $query = "SELECT id_user, full_name, email, phone,status,administration  from user WHERE facebook_id=? ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id_facebook);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (isset($row['id_user'])) {

            $this->id_user = $row['id_user'];
            $this->full_name = $row['full_name'];
            $this->email = $row['email'];
            $this->phone = $row['phone'];
            $this->status = $row['status'];
            $this->administration = $row['administration'];
            return true;
        } else {
            return false;
        }
    }
    public function checkGoogle($id_google)
    {
        $query = "SELECT id_user, full_name, email, phone,status,administration  from user WHERE google_id=? ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id_google);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($row['id_user'])) {

            $this->id_user = $row['id_user'];
            $this->full_name = $row['full_name'];
            $this->email = $row['email'];
            $this->phone = $row['phone'];
            $this->status = $row['status'];
            $this->administration = $row['administration'];
            return true;
        } else {
            return false;
        }
    }

    function generatePassword($length = 8)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = Rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        return $result;
    }

    public function forgotPass()
    {
        $query = "UPDATE `user` SET `password`=:pass WHERE email=:email";

        $stmt = $this->conn->prepare($query);
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $stmt->bindParam(":pass", $this->password);
        $stmt->bindParam(":email", $this->email);
        if ($stmt->execute()) {

            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }
    public function changePass()
    {
        $query = "UPDATE `user` SET `password`=:pass WHERE id_user=:id_user";

        $stmt = $this->conn->prepare($query);
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $stmt->bindParam(":pass", $this->password);
        $stmt->bindParam(":id_user", $this->id_user);
        if ($stmt->execute()) {

            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }
    public function changeAdministration()
    {
        $query = "UPDATE `user` SET `administration`=:administration WHERE id_user=:id_user";
        $stmt = $this->conn->prepare($query);
        $this->administration = htmlspecialchars(strip_tags($this->administration));
        $this->id_user = htmlspecialchars(strip_tags($this->id_user));
        $stmt->bindParam(':administration', $this->status);
        $stmt->bindParam(':id_user', $this->id_user);
        if ($stmt->execute()) {
            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }

    public function checkEmailExit($email)
    {
        $query = "SELECT id_user FROM user WHERE email = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        if ($stmt->rowCount()   != 0) {
            return true;
        }
        return false;
    }
}
