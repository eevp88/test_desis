<?php
class Branch
{
    private DatabaseConnection $db;
    public function __construct(DatabaseConnection $conn)
    {
        $this->db = $conn;
    }
    public function getAllBranchs(): array
    {
        $query =
            "SELECT b.id, b.name, b.id_storehouse FROM branchs b ORDER BY id ASC";
        $result = $this->db->query($query);
        if (!$result) {
            $result = [];
        }
        return $result;
    }

    public function getBranchByIdStore(int $idStore): array
    {
        $query =
            "SELECT id, name FROM branchs b where b.id_storehouse = :id_store";
        $bind = [
            "id_store" => $idStore,
        ];
        $result = $this->db->query($query, $bind);
        if (!$result) {
            $result = [];
        }
        return $result;
    }
}
?>
