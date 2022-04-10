<?php

class getOffset {

    private $offset;
    private $city_in_db;
    private $dsn = 'mysql:host=test;dbname=times;charset=utf8';
    private $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false
    ];

    public function __construct($city) {
        $this->city_in_db = json_decode($city);
        $this->city_in_db = $this->city_in_db->city;
    }

    public function getOffset() {
        $pdo = new PDO($this->dsn, 'root', '', $this->opt);
        $stmt = $pdo->prepare("SELECT `offset_from_GMT` FROM `time_zones` 
        WHERE `zone_name` = :city LIMIT 1");
        $stmt->execute([
            'city'=> $this->city_in_db
        ]);
        while (($row = $stmt->fetch(PDO::FETCH_LAZY)) != false) {
            $this->offset = $row['offset_from_GMT'];
        }
        return $this->offset;
    }

}

?>