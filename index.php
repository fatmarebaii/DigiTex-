<?php

// declare(strict_types=1);
date_default_timezone_set('Africa/Tunis');

require __DIR__ . "/src/config/Database.php";
// require __DIR__ . "./src/config/ErrorHandler.php";

require __DIR__ . "/src/controllers/DigiTexController.php";
require __DIR__ . "/src/controllers/OperatorController.php";
require __DIR__ . "/src/controllers/ProductionLineController.php";
require __DIR__ . "/src/controllers/PacketController.php";
require __DIR__ . "/src/controllers/OperationController.php";
require __DIR__ . "/src/controllers/MonitorController.php";
require __DIR__ . "/src/controllers/QteEngageController.php";


// set_exception_handler("ErrorHandler::handleException");

// JSON's HEADERS
header('Access-Control-Allow-Origin: *');
header("Content-type: application/json; charset=UTF-8");

// SPLIT URI(/URL) BY / INTO PARTS (LIST)
$parts = explode("/", $_SERVER['REQUEST_URI']);

// TODO: ADD API KEY (ENHANCE SECURITY)
if ($parts[2] !== "api" || $parts[3] !== "v4") {
    http_response_code(404);
    echo json_encode(["404" => "Not Found"]);
    exit();
}

// EXAMPLE:     http://localhost/digitex_isa/api/v4/packet/byRFID/e3cfaf19
//              => $action = packet / $handler = byRFID
$action = $parts[4] ?? null;
$handler = $parts[5] ?? null;

if ($action === "") {
    echo json_encode(["message" => "Welcome to DigiTex API"]);
}


// INITIALIZE DB
// $db = new Database("127.0.0.1", "db_isa", "admin", "DigiTex@2022");
$db = new Database("127.0.0.1", "db_isa", "root", "");

// INITIALIZE MODELS
$digitex = new DigiTex($db);
$operator = new Operator($db);
$productionLine = new ProductionLine($db);
$packet = new Packet($db);
$operation = new Operation($db);
$monitor = new Monitor($db);
$qteEngage = new QteEngage($db);

// INITIALIZE CONTROLLERS
$digitexController = new DigiTexController($digitex);
$operatorController = new OperatorController($operator);
$productionLineController = new ProductionLineController($productionLine);
$packetController = new PacketController($packet);
$operationController = new OperationController($operation);
$monitorController = new MonitorController($monitor);
$QteEngageController = new QteEngageController($QteEngage);

// ROUTING
switch ($action) {
    case "digitex":
        $digitexController->processRequest($handler);
        break;

    case "operator":
        $operatorController->processRequest($handler);
        break;

    case "productionLine":
        $productionLineController->processRequest($handler);
        break;

    case "packet":
        $packetController->processRequest($handler);
        break;

    case "operation":
        $operationController->processRequest($handler);
        break;

    case "monitor":
        $monitorController->processRequest($handler);
        break;
        case "QteEngage":
            $QteEngageController->processRequest($handler);
            break;
}
