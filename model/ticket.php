<?php
class ticket
{
    private $conn;

    public $id_ticket;
    public $id_session;
    public $Total_money;
    public $id_seat;
    public $id_user;
    public $id_promotion;
    public $time_create;
    public $status;
    public $id_combo;
    public $ticket_information;
    public $full_name;
    public $name_mv;
    public $date_start;
    public $time_start;
    public $Combo;
    public $ticket_code;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT user.full_name, tk.id_ticket,movie.name_mv,se.day,sts.time_start,room.id_room,tk.ticket_information,tk.status,tk.Total_money FROM ticket tk INNER JOIN user on tk.id_user =user.id_user INNER JOIN promotion pr ON tk.id_promotion = pr.id_promotion INNER JOIN
        session se ON tk.id_session = se.id_session INNER JOIN showtimes sts ON se.id_showtimes = sts.id_showtimes INNER JOIN room on se.id_room =room.id_room  INNER JOIN movie ON se.id_movie =movie.id_movie GROUP BY user.id_user ORDER BY user.id_user        
        ";

        try {
            //code...
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
        } catch (Exception $e) {
            //throw $th;
            print_r($e);
        }


        return $stmt;
    }

    public function show()
    {
        $query = "call ticket_show_one(?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_ticket);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->full_name = $row['full_name'];
        $this->id_ticket = $row['id_ticket'];
        $this->name_mv = $row['name_mv'];
        $this->day_start = $row['day_start'];
        $this->time_start = $row['time_start'];
        $this->Combo = $row['Combo'];
        $this->id_seat = $row['id_seat'];
        $this->id_room = $row['id_room'];
        $this->ticket_information = $row['ticket_information'];
        $this->status = $row['status'];
        $this->Total_money = $row['Total_money'];
    }


    public function create()
    {
        $query = "INSERT INTO `ticket`(`id_session`, `Total_money`, `id_user`, `id_promotion`, `time_create`, `status`, `ticket_information`, `ticket_code`) VALUES (?,?,?,?,now(),?,?,?)";
        $stmt = $this->conn->prepare($query);

        // Clead Data

        $this->id_session = htmlspecialchars(strip_tags($this->id_session));
        $this->Total_money = htmlspecialchars(strip_tags($this->Total_money));
        $this->id_user = htmlspecialchars(strip_tags($this->id_user));
        $this->id_promotion = htmlspecialchars(strip_tags($this->id_promotion));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->ticket_information = htmlspecialchars(strip_tags($this->ticket_information));
        $this->ticket_code = htmlspecialchars(strip_tags($this->ticket_code));

        $stmt->bindParam(1, $this->id_session);
        $stmt->bindParam(2, $this->Total_money);
        $stmt->bindParam(3, $this->id_user);
        $stmt->bindParam(4, $this->id_promotion);
        $stmt->bindParam(5, $this->status);
        $stmt->bindParam(6, $this->ticket_information);
        $stmt->bindParam(7, $this->ticket_code);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }

    public function update()
    {
        $query = "UPDATE `ticket` SET `id_session`=?,`Total_money`=?,`id_seat`=?,
        `id_user`=?,`id_promotion`=?,`time_create`=?,`status`=?,`id_combo`=?',
        `ticket_information`=?,`ticket_code`=? WHERE id_ticket=?";
        $stmt = $this->conn->prepare($query);

        // Clead Data

        $this->id_session = htmlspecialchars(strip_tags($this->id_session));
        $this->Total_money = htmlspecialchars(strip_tags($this->Total_money));
        $this->id_seat = htmlspecialchars(strip_tags($this->id_seat));
        $this->id_user = htmlspecialchars(strip_tags($this->id_user));
        $this->id_promotion = htmlspecialchars(strip_tags($this->id_promotion));
        $this->time_create = htmlspecialchars(strip_tags($this->time_create));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->id_combo = htmlspecialchars(strip_tags($this->id_combo));
        $this->ticket_information = htmlspecialchars(strip_tags($this->ticket_information));
        $this->ticket_code = htmlspecialchars(strip_tags($this->ticket_code));
        $this->id_ticket = htmlspecialchars(strip_tags($this->id_ticket));

        $stmt->bindParam(1, $this->id_session);
        $stmt->bindParam(2, $this->Total_money);
        $stmt->bindParam(3, $this->id_seat);
        $stmt->bindParam(4, $this->id_user);
        $stmt->bindParam(5, $this->id_promotion);
        $stmt->bindParam(6, $this->time_create);
        $stmt->bindParam(7, $this->status);
        $stmt->bindParam(8, $this->id_combo);
        $stmt->bindParam(9, $this->ticket_information);
        $stmt->bindParam(10, $this->ticket_code);
        $stmt->bindParam(11, $this->id_ticket);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM ticket where id_ticket=:id_ticket";
        $stmt = $this->conn->prepare($query);

        // Clead Data 
        $this->id_ticket = htmlspecialchars(strip_tags($this->id_ticket));

        $stmt->bindParam(':id_ticket', $this->id_ticket);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }

    public function getTiketSeat($id)
    {
        $query = "SELECT id_ticket, id_seat from `ticket_seat` WHERE id_ticket = $id";

        $stmt = $this->conn->prepare($query);
        // $stmt->bindParam(1, $this->id_ticket);
        $stmt->execute();
        return $stmt;
    }
    public function createTiketSeat()
    {
        $query = 'INSERT INTO ticket_seat SET id_ticket=:id_ticket, id_seat=:id_seat';
        $stmt = $this->conn->prepare($query);

        $this->id_movie = htmlspecialchars(strip_tags($this->id_movie));
        $this->id_cate = htmlspecialchars(strip_tags($this->id_cate));

        $stmt->bindParam(':id_movie', $this->id_movie);
        $stmt->bindParam(':id_category', $this->id_cate);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }
    public function getTiketCombo($id)
    {
        $query = "SELECT tkcb.id_ticket, combo.name, tkcb.quantity,tkcb.unit_price from `ticket_combo` tkcb INNER JOIN combo ON tkcb.id_combo = combo.id_combo   WHERE id_ticket = $id";

        $stmt = $this->conn->prepare($query);
        // $stmt->bindParam(1, $this->id_ticket);
        $stmt->execute();



        return $stmt;
    }

    public function createTiketCombo()
    {
        $query = "INSERT INTO `ticket_combo` set id_ticket=:id_ticket  id_combo=:id_combo";

        $stmt = $this->conn->prepare($query);

        $this->id_movie = htmlspecialchars(strip_tags($this->id_movie));
        $this->id_cate = htmlspecialchars(strip_tags($this->id_cate));

        $stmt->bindParam(':id_movie', $this->id_movie);
        $stmt->bindParam(':id_category', $this->id_cate);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }
}