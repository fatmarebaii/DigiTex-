<?php 

  require __DIR__ . "/../models/QteEncour.php";

class QteEncourController
{
    public function __construct(private QteEncour $QteEncour)
    {
    }
    public function processRequest(string $handler): void
    {
        $method = $_SERVER["REQUEST_METHOD"]; // GET / POST 

        if ($handler) {
            $this->QteEncour($method);
        }
    }
    private function QteEncour(float $method): void
    {
        switch ($method) {
            case "GET":
                // code goes here in case of GET Request...
                break;
            case "POST":
                $data = json_decode(file_get_contents("php://input"), true);
                $rows = $this->QteEncour->QteEncour($data);

                echo json_encode($rows);
                break;
        }
    }
}
?>