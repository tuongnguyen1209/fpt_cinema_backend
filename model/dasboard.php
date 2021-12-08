<?php
class dasboard
{
    private $conn;



    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function movie_sum()
    {
        $squery = "SELECT COUNT(id_movie) as count_movie_id_all FROM `movie` ";
        $stmt = $this->conn->prepare($squery);
        $stmt->execute();
        return $stmt;
    }
    public function movie_sum_show()
    {
        $squery = "SELECT COUNT(id_movie) count_movie_id_show FROM `movie` WHERE date_start < now()  AND date_end ='0000-00-00' OR date_end > '2021-11-27'";
        $stmt = $this->conn->prepare($squery);
        $stmt->execute();

        return $stmt;
    }
    public function total_year()
    {
        $squery = "SELECT SUM(Total_money) as sum_money FROM `ticket`";
        $stmt = $this->conn->prepare($squery);
        $stmt->execute();
        return $stmt;
    }
    public function total_user_year_new()
    {
        $squery = "SELECT count(id_user) as user FROM `user`";
        $stmt = $this->conn->prepare($squery);
        $stmt->execute();
        return $stmt;
    }

    public function total_month()
    {
        $squery = "SELECT SUM(Total_money) as sum_money FROM `ticket`";
        $stmt = $this->conn->prepare($squery);
        $stmt->execute();
        return $stmt;
    }

    public function total_Price_By_month()
    {
        $squery = "SELECT SUM(ticket.Total_money) as total,concat( YEAR(ticket.time_create),'-', MONTH(ticket.time_create) ) as date FROM ticket WHERE status=1 GROUP BY YEAR(ticket.time_create), MONTH(ticket.time_create)";
        $stmt = $this->conn->prepare($squery);
        $stmt->execute();
        return $stmt;
    }
    public function total_price_by_showtime()
    {
        $squery = "SELECT SUM(ticket.Total_money) total, session.id_showtimes shotime FROM ticket,session WHERE status=1 and ticket.id_session=session.id_session GROUP BY session.id_showtimes";
        $stmt = $this->conn->prepare($squery);
        $stmt->execute();
        return $stmt;
    }

    public function price_day_by_Month($month)
    {
        $squery = "SELECT SUM(ticket.Total_money) as total,concat( YEAR(ticket.time_create),'-', MONTH(ticket.time_create),'-', day(ticket.time_create) ) as date FROM ticket WHERE status=1 and MONTH(ticket.time_create)=$month GROUP BY YEAR(ticket.time_create), MONTH(ticket.time_create), day(ticket.time_create)";
        $stmt = $this->conn->prepare($squery);
        $stmt->execute();
        return $stmt;
    }
    public function price_day_by_Date($start, $end)
    {
        $squery = "SELECT SUM(ticket.Total_money) as total,concat( YEAR(ticket.time_create),'-', MONTH(ticket.time_create),'-', day(ticket.time_create) ) as date FROM ticket WHERE status=1 and ticket.time_create>= '$start' and ticket.time_create<='$end' GROUP BY YEAR(ticket.time_create), MONTH(ticket.time_create), day(ticket.time_create)";
        $stmt = $this->conn->prepare($squery);
        $stmt->execute();
        return $stmt;
    }
}
// 
