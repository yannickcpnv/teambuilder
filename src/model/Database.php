<?php

class Database
{

    private PDO|null     $connection;
    private PDOStatement $statement;

    /**
     * Instantiate a new database object. Use the singleton pattern.
     *
     * @param string $dsn
     * @param string $username
     * @param string $password
     */
    public function __construct(string $dsn, string $username, string $password)
    {
        if (isset($this->connection)) {
            $this->closeConnection();
        }

        try {
            $this->connection = new PDO($dsn, DB_USER_NAME, DB_USER_PWD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }

    /**
     * DatabaseManager destructor.
     * Close the connection
     */
    public function __destruct() { $this->closeConnection(); }

    /**
     * Returns the result of an executed query.
     *
     * @param string     $query
     * @param array|null $queryArray
     *
     * @return array
     */
    public function fetchRecords(string $query, array $queryArray = null): array
    {
        $this->executeQuery($query, $queryArray);
        return $this->statement->fetchAll();
    }

    /**
     * Return a single row of an executed query.
     *
     * @param string     $query
     * @param array|null $queryArray
     *
     * @return array
     */
    public function fetchOne(string $query, array $queryArray = null): array
    {
        $this->executeQuery($query, $queryArray);
        return $this->statement->fetch();
    }

    /**
     * Insert data from an executed query.
     *
     * @param string $query
     * @param array  $queryArray
     *
     * @return string
     */
    public function insert(string $query, array $queryArray): string
    {
        $this->executeQuery($query, $queryArray);
        return $this->connection->lastInsertId();
    }

    /**
     * Update data from an executed query.
     *
     * @param string $query
     * @param array  $queryArray
     *
     * @return int
     */
    public function update(string $query, array $queryArray): int
    {
        $this->executeQuery($query, $queryArray);
        return $this->statement->rowCount();
    }

    /**
     * Execute a query received as parameter.
     *
     * @param string     $query Must be correctly build for sql syntax.
     * @param array|null $queryArray
     *
     * @return void True if the query is ok, otherwise false.
     */
    public function execute(string $query, array $queryArray = null): void
    {
        $this->executeQuery($query, $queryArray);
    }

    /**
     * Execute a query received as parameter.
     *
     * @param string     $query Must be correctly build for sql syntax.
     * @param array|null $queryArray
     *
     * @return void True if the query is ok, otherwise false.
     */
    private function executeQuery(string $query, array $queryArray = null): void
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($queryArray);
    }

    /**
     * Close the connection with the database.
     */
    private function closeConnection() { $this->connection = null; }
}
