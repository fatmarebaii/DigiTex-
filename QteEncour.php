<?php

class QteEncour
{
    private PDO $conn;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }
    public function QteEncour(float $QteEncour): array | float
    {
    {
        $sql = "SELECT DISTINCT pack_num, pack_qte FROM `p4_pack_operation` WHERE cur_date = :cur_day;";
        $stmt = $this->conn->prepare($sql);
        $tab = [];
        $QteEngage = 0;
        $QteFab = 0;
        while ($item = $stmt->fetchAll()){
        $tab[] = $item;
    }

    $i = 0;
    while (count($tab) >= $i) {
    $QteEngage += $tab[$i]['pack_qte'];
    $i++;
    }

    $query1 = "SELECT DISTINCT pack_num, qte_fp FROM `p12_control`WHERE cur_date = :cur_day;" ;
    $stmt1 = $this->conn->prepare($query1);

    $tab1 = [];
    while ($item1 = $stmt1->fetchAll()){
    $tab1[] = $item1;
    }
    $i1 = 0;
    while (count($tab1) >= $i1) {
    $QteFab += $tab1[$i1]['qte_fp'] ;
    $i1++; }

    $QteEncour = $QteEngage - $QteFab;

    }
    if (!$item) {
        http_response_code(400);

        return 0;
    }
        return $QteEncour;
    }
}

?>