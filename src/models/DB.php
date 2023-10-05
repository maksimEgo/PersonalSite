<?php

namespace models;

use Exception;
use PDO;
use PDOException;

/**
 * Represents the database utility class for establishing connections and executing operations.
 */
class DB
{
    /**
     * The PDO database connection instance.
     *
     * @var PDO
     */
    protected PDO $connection;

    /**
     * Initializes the database connection using the provided configuration.
     *
     * @throws Exception If there is an error connecting to the database.
     */
    public function __construct()
    {
        $data = include __DIR__ . '/../../config/database.php';

        try {
            $this->connection = new PDO(
                'pgsql:host=postgres;port=5432;dbname=' . $data['dbname'] . ';',
                $data['user'],
                $data['password']
            );

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            throw new Exception('Error connecting to the database: ' . $exception->getMessage());
        }
    }

    /**
     * Executes an SQL statement, returning a boolean result.
     *
     * @param string $sql The SQL statement to be executed.
     * @param array $data The input parameters for the SQL statement.
     * @return bool True if the statement was executed successfully, false otherwise.
     * @throws Exception If there is an error executing the SQL statement.
     */
    public function execute(string $sql, array $data = []): bool
    {
        $sth = $this->connection->prepare($sql);

        try {
            return $sth->execute($data);
        } catch (PDOException $exception) {
            throw new Exception('Error executing SQL: ' . $exception->getMessage());
        }
    }

    /**
     * Executes an SQL statement and returns the result set as an associative array.
     *
     * @param string $sql The SQL statement to be executed.
     * @param array $data The input parameters for the SQL statement.
     * @param int $fetchStyle The PDO fetch style.
     * @return array The result set as an associative array.
     */
    public function query(string $sql, array $data = [], int $fetchStyle = PDO::FETCH_ASSOC): array
    {
        $sth = $this->connection->prepare($sql);
        $sth->execute($data);

        return $sth->fetchAll($fetchStyle);
    }
}
