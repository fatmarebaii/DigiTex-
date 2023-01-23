<?php

class QteEngage
{
    private PDO $conn;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }
    public function QteEngage(array $tab): float
    {
        $prodline = $tab["prod_line"];
        $sql = "SELECT DISTINCT pack_num, pack_qte, prod_line FROM `p4_pack_operation` WHERE cur_date = :cur_day;";
        $stmt = $this->conn->prepare($sql);
        $tab = [];
        if ($tab[":prod_line"] = $prodline) {
            while ($item = $stmt->fetchAll()) {
                $tab[] = $item;
            }

            echo "\r\n Nombre des paaquets engagés = ", $T = count($tab); //nombre des Paquets engagés

            $i = 0;
            $QteEngage = 0;
            while ($T >= $i) {
                $QteEngage = $tab[$i]['pack_qte'] + $QteEngage;
                $i++;
            }

            if (!$item) {
                http_response_code(400);

                return 0;
            }

            return $QteEngage;
        } else {
            return 0;}
    }

}
?>