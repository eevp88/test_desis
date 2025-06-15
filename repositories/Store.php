<?php
class Store
{
    private DatabaseConnection $db;
    public function __construct(DatabaseConnection $conn)
    {
        $this->db = $conn;
    }
    public function getAllStores(): array
    {
        $query = "SELECT b.id, b.name FROM storehouses b ORDER BY id ASC";
        $result = $this->db->query($query);
        if (!$result) {
            $result = [];
        }
        return $result;
    }
}
?>
