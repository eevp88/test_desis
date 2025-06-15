<?php
class Currency
{
    private DatabaseConnection $db;
    public function __construct(DatabaseConnection $conn)
    {
        $this->db = $conn;
    }
    public function getAllCurrencies(): array
    {
        $query = "SELECT b.id, b.name FROM currency b ORDER BY id ASC";
        $result = $this->db->query($query);
        if (!$result) {
            $result = [];
        }
        return $result;
    }
}
?>
