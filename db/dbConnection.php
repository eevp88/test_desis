<?php
interface DatabaseConnection
{
    public function connect(): PDO;
    public function query(string $sql, array $param): array;
    public function close(): void;
}

class PostgresConnection implements DatabaseConnection
{
    private string $host;
    private string $port;
    private string $dbname;
    private string $user;
    private string $password;
    private ?PDO $connection = null;

    public function __construct(
        string $host,
        string $port,
        string $dbname,
        string $user,
        string $password
    ) {
        $this->host = $host;
        $this->port = $port;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
    }

    public function connect(): PDO
    {
        if ($this->connection === null) {
            $connectionString = sprintf(
                "pgsql:host=%s;port=%s;dbname=%s",
                $this->host,
                $this->port,
                $this->dbname
            );
            try {
                $this->connection = new PDO(
                    $connectionString,
                    $this->user,
                    $this->password
                );
                $this->connection->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );
            } catch (PDOException $e) {
                throw new Exception("Error de conexión: " . $e->getMessage());
            }
        }
        return $this->connection;
    }

    public function close(): void
    {
        if ($this->connection) {
            $this->connection = null;
        }
    }

    public function query(string $sql, array $params = []): array
    {
        try {
            $statements = $this->connect()->prepare($sql);
            $statements->execute($params);
            return $statements->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception(
                "Error al ejecutar la consulta: " . $e->getMessage()
            );
        }
    }
}
?>
