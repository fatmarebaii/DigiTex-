<?php 

  require __DIR__ . "/../models/QteEngage.php";

class QteEngageController
{
    public function __construct(private QteEngage $QteEngage)
    {
    }
    public function processRequest(string $handler): void
    {
        $method = $_SERVER["REQUEST_METHOD"]; // GET / POST 

        if ($handler) {
            $this->QteEngaged($method);
        }
    }
    private function QteEngaged(float $method): void
    {
        switch ($method) {
            case "GET":
                // code goes here in case of GET Request...
                break;
            case "POST":
                $data = json_decode(file_get_contents("php://input"), true);
                $rows = $this->QteEngage->QteEngage($data);

                echo json_encode($rows ? [
                    "message" => "Presence Inserted"
                ] : "{}");
                break;
        }
    }
}
?>