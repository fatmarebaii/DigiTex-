<?php

class QteFab
{
    private PDO $conn;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }
    public function QteFab(array $tab): float
    {
        $prodline = $tab["prod_line"];
        $sql = "SELECT DISTINCT pack_num, qte_fp, prod_line FROM `p12_control` WHERE cur_date = :cur_day;";
        $stmt = $this->conn->prepare($sql);
        $tab = [];
        if ($tab[":prod_line"] = $prodline) {
            while ($item = $stmt->fetchAll()) {
                $tab[] = $item;
            }

            echo json_decode( "\r\n Nombre des paaquets Fabriqué = ", $T = count($tab)); //nombre des Paquets engagés)

            $i = 0;
            $QteFab = 0;
            while ($T >= $i) {
            $QteFab = $tab[$i]['qte_fp'] + $QteFab;
            $i++;
            }

            if (!$item) {
                http_response_code(400);

                return 0;
            }

            return $QteFab;
        } else {
            return 0;}
    }

}
?>