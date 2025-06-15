<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
require_once "../db/config.php";
require_once "../db/dbConnection.php";
require_once "../repositories/Store.php";
require_once "../repositories/Branch.php";
require_once "../repositories/Currency.php";
require_once "../controllers/FormController.php";
$dbConnection = new PostgresConnection(HOST, PORT, DBNAME, USER, PASS);
$storeRepo = new Store($dbConnection);
$branchRepo = new Branch($dbConnection);
$currencyRepo = new Currency($dbConnection);
$controller = new FormController($storeRepo, $branchRepo, $currencyRepo);
header("Content-Type: application/json");
$acction = $_GET["acction"];
if ($acction === "I") {
    echo $controller->getFormOptions();
}
if ($acction === "B") {
    $idStore = $_GET["id_store"];
    echo $controller->getBranchForIdstore($idStore);
}
?>
