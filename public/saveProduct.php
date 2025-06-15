<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
require_once "../db/config.php";
require_once "../db/dbConnection.php";
require_once "../repositories/Product.php";
require_once "../controllers/ProductController.php";
$dbConnection = new PostgresConnection(HOST, PORT, DBNAME, USER, PASS);
$data = json_decode(file_get_contents("php://input"), true);
$repository = new Product($dbConnection);
$controller = new ProductController($repository);
$controller->productSave($data);
