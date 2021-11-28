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
        $squery = "SELECT COUNT(id_movie) count_movie_id_show FROM `movie` WHERE date_start < '2021-11-27' AND date_end ='' OR date_end > '2021-11-27'";
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
}
// 
