<?php
class Product
{
    private PDO $db;

    public function __construct(DatabaseConnection $connection)
    {
        $this->db = $connection->connect();
    }

    public function saveProduct(array $data): array
    {
        try {
            $materials_pg =
                "{" .
                implode(
                    ",",
                    array_map(fn($m) => '"' . $m . '"', $data["material"])
                ) .
                "}";

            $status = null;
            $message = null;
            $idError = null;

            $stmt = $this->db->prepare('SELECT * FROM "saveProduct"(
                                    :code, :name, :id_store, :id_branch, :id_currency,
                                    :materials, :description, :price)');

            $stmt->bindValue(":code", $data["productCode"]);
            $stmt->bindValue(":name", $data["productName"]);
            $stmt->bindValue(":id_store", $data["idStore"]);
            $stmt->bindValue(":id_branch", $data["idBranch"]);
            $stmt->bindValue(":id_currency", $data["idCurrency"]);
            $stmt->bindValue(":materials", $materials_pg);
            $stmt->bindValue(":description", $data["productDescription"]);
            $stmt->bindValue(":price", $data["productPrice"]);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ?: [
                    "status" => "danger",
                    "message" => "Error inesperado",
                    "idError" => -1,
                ];
        } catch (PDOException $e) {
            return [
                "status" => "danger",
                "message" => $e->getMessage(),
                "idError" => -3,
            ];
        }
    }
}
