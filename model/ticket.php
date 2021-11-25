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
        $query = "call ticket_show()";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
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
        $query = "INSERT INTO `ticket`( `id_session`, `Total_money`, `id_seat`, `id_user`, `id_promotion`, `time_create`, `status`, `id_combo`, `ticket_information`, `ticket_code`) VALUES (?,?,?,?,?,?,?,?,?,?)";
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

        $stmt->bindParam(1, $this->id_session);
        $stmt->bindParam(2, $this->Total_money);
        $stmt->bindParam(3, $this->id_seat);
        $stmt->bindParam(4, $this->id_user);
        $stmt->bindParam(5, $this->id_promotion);
        $stmt->bindParam(6, $this->time_create);
        $stmt->bindParam(7, $this->status);
        $stmt->bindParam(8, $this->id_combo);
        $stmt->bindParam(9, $this->ticket_information);
        $stmt->bindParam(9, $this->ticket_code);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }

    // public function update()
    // {
    //     $query = "UPDATE ticket set name_mv=:name_mv ,image_mv=:image_mv ,traller=:traller ,date_start=:date_start, date_end=:date_end 
    //                 ,detail=:detail ,actor=:actor ,director=:director ,time_mv=:time_mv 
    //                 where id_ticket=:id_ticket";
    //     $stmt = $this->conn->prepare($query);

    //     //             // Clead Data 
    //     $this->id_session = htmlspecialchars(strip_tags($this->id_session));
    //     $this->Total_money = htmlspecialchars(strip_tags($this->Total_money));
    //     $this->id_sesat = htmlspecialchars(strip_tags($this->id_seat));
    //     $this->id_user = htmlspecialchars(strip_tags($this->id_user));
    //     $this->id_promotion = htmlspecialchars(strip_tags($this->id_promotion));
    //     $this->time_create = htmlspecialchars(strip_tags($this->time_create));
    //     $this->status = htmlspecialchars(strip_tags($this->status));
    //     $this->id_combo = htmlspecialchars(strip_tags($this->id_combo));
    //     $this->ticket_information = htmlspecialchars(strip_tags($this->ticket_information));

    //     $stmt->bindParam(1, $this->id_session);
    //     $stmt->bindParam(2, $this->Total_money);
    //     $stmt->bindParam(3, $this->id_seat);
    //     $stmt->bindParam(4, $this->id_user);
    //     $stmt->bindParam(5, $this->id_promotion);
    //     $stmt->bindParam(6, $this->time_create);
    //     $stmt->bindParam(7, $this->status);
    //     $stmt->bindParam(8, $this->id_combo);
    //     $stmt->bindParam(9, $this->ticket_information);

    //     if ($stmt->execute()) {
    //         return true;
    //     }
    //     printf("Error %s.\n", $stmt->error);
    //     return false;
    // }

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
}
