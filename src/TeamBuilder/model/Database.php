<?php

namespace TeamBuilder\model;

use PDO;
use stdClass;
use PDOStatement;
use TeamBuilder\model\entity\Entity;
use TeamBuilder\model\entity\Member;

class Database
{

    private PDO|null     $connection;
    private PDOStatement $statement;

    /**
     * Instantiate a new database object.
     *
     * @param string $dsn      The Data Source Name, contains the information required to connect to the database.
     * @param string $username The username for the DSN string.
     * @param string $password The password for the DSN string.
     */
    public function __construct(string $dsn, string $username, string $password)
    {
        $this->connection = new PDO($dsn, $username, $password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * DatabaseManager destructor.
     * Close the connection.
     */
    public function __destruct() { $this->closeConnection(); }

    /**
     * Returns the result of an executed query.
     *
     * @param string     $query      The query, be correctly build for sql syntax.
     * @param string     $className  Name of the class type wanted in return.
     * @param array|null $queryArray An array of values with as many elements as there are bound parameters in the SQL
     *                               statement being executed.
     *
     * @return array - An array of all the records (arrays too).
     */
    public function fetchRecords(string $query, string $className, array $queryArray = null): array
    {
        $this->executeQuery($query, $queryArray);
        $this->statement->setFetchMode(PDO::FETCH_CLASS, $className);
        return $this->statement->fetchAll();
    }

    /**
     * Return a single row of an executed query.
     *
     * @param string     $query      The query, be correctly build for sql syntax.
     * @param string     $className  Name of the class type wanted in return.
     * @param array|null $queryArray An array of values with as many elements as there are bound parameters in the SQL
     *                               statement being executed.
     *
     * @return Entity|false - An entity that represent the record, false if the record doesn't exist.
     */
    public function fetchOne(string $query, string $className, array $queryArray = null): Entity|false
    {
        $this->executeQuery($query, $queryArray);
        $this->statement->setFetchMode(PDO::FETCH_CLASS, $className);
        return $this->statement->fetch();
    }

    /**
     * Insert data from an executed query.
     *
     * @param string $query          The query, be correctly build for sql syntax.
     * @param array  $queryArray     An array of values with as many elements as there are bound parameters in the SQL
     *                               statement being executed.
     *
     * @return int - The new inserted ID.
     */
    public function insert(string $query, array $queryArray): int
    {
        $this->executeQuery($query, $queryArray);
        return intval($this->connection->lastInsertId());
    }

    /**
     * Update data from an executed query.
     *
     * @param string $query          The query, be correctly build for sql syntax.
     * @param array  $queryArray     An array of values with as many elements as there are bound parameters in the SQL
     *                               statement being executed.
     *
     * @return int - The number of rows affected.
     */
    public function update(string $query, array $queryArray): int
    {
        $this->executeQuery($query, $queryArray);
        return $this->statement->rowCount();
    }

    public function delete(string $query, array $queryArray): int
    {
        return $this->executeQuery($query, $queryArray);
    }

    /**
     * Execute a query received as parameter.
     *
     * @param string     $query      The query, be correctly build for sql syntax.
     * @param array|null $queryArray An array of values with as many elements as there are bound parameters in the SQL
     *                               statement being executed.
     *
     * @return bool True if the query is ok, otherwise false.
     */
    public function executeQuery(string $query, array $queryArray = null): bool
    {
        $this->statement = $this->connection->prepare($query);
        return $this->statement->execute($queryArray);
    }

    /**
     * Close the connection with the database.
     */
    private function closeConnection() { $this->connection = null; }
}
