<?php
require_once "BaseDao.php";

class MidtermDao extends BaseDao {

    public function __construct(){
        parent::__construct();
    }

    /** TODO
    * Implement DAO method used to add content to database
    */
    public function input_data($data){

            $query = "INSERT INTO locations (`from`, `to`, code, Country, Region, City) VALUES (:from, :to, :code, :Country, :Region, :City)";
            $stmt = $this->conn->prepare($query);
            
            foreach ($data as $row) {
                $stmt->bindParam(':from', $row['from']);
                $stmt->bindParam(':to', $row['to']);
                $stmt->bindParam(':code', $row['code']);
                $stmt->bindParam(':Country', $row['Country']);
                $stmt->bindParam(':Region', $row['Region']);
                $stmt->bindParam(':City', $row['City']);
                $stmt->execute();
            }
            
            if ($stmt->execute()) {
                return "Data success";
            } else {
                return "Data error";
            }
        

    }

    /** TODO
    * Implement DAO method to return summary as requested within route /midterm/summary/@country
    */
    public function summary($country){

        $query = "SELECT COUNT(DISTINCT Region) AS regions, COUNT(DISTINCT City) AS cities FROM locations WHERE Country = :country";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':country', $country);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;

    }

    /** TODO
    * Implement DAO method to return list as requested within route /midterm/encoded
    */
    public function encoded(){


        $query = "SELECT Country FROM locations LIMIT 10";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $row['encoded'] = $row['Country'] .  " encoded " . base64_encode($row['Country']);
            $result[] = $row['encoded'];
        }
        return $result;



    }

    /** TODO
    * Implement DAO method to return location(s) as requested within route /midterm/ip
    */
    public function ip($ip_address){


        $query = "SELECT * FROM locations WHERE :ip_address BETWEEN `from` AND `to`";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $row['ip_address'] = $ip_address;
            $result[] = $row['ip_address'];
        }
        return $result;




    }
}
?>
