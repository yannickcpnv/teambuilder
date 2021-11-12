<?php

namespace TeamBuilder\model\entity;

use PDOException;
use JetBrains\PhpStorm\Pure;
use TeamBuilder\model\Database;
use TeamBuilder\model\Accessors;

abstract class Entity
{

    use Accessors;

    //region Fields
    protected const TABLE_NAME     = '';

    protected int $id;
    //endregion

    //region Methods
    /**
     * Instantiate an entity.
     *
     * @param array $fields - An associative array based on the fields of the entity.
     *
     * @return Entity The instantiated entity.
     */
    public static function make(array $fields): Entity
    {
        return static::hydrate($fields);
    }

    /**
     * Retrieve all models from database.
     *
     * @return Entity[] An array of all models.
     */
    public static function all(): array
    {
        $tableName = self::getTableName();
        $query = "SELECT * FROM $tableName";

        return self::createDatabase()->fetchRecords($query, static::class);
    }

    /**
     * Retrieve an entity from the database.
     *
     * @param int $id The ID.
     *
     * @return Entity|null The entity.
     */
    public static function find(int $id): ?Entity
    {
        $tableName = self::getTableName();
        $query = "SELECT * FROM $tableName WHERE id=:id";
        $queryArray = ["id" => $id];
        $result = self::createDatabase()->fetchOne($query, static::class, $queryArray);

        return $result ?: null;
    }

    /**
     * Delete an entity in the database.
     *
     * @param int $id The ID.
     *
     * @return bool True if success, otherwise false.
     */
    public static function destroy(int $id): bool
    {
        $tableName = self::getTableName();
        $query = "DELETE FROM $tableName WHERE id=:id";
        $queryArray = ["id" => $id];

        try {
            self::createDatabase()->delete($query, $queryArray);
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    /**
     * Create a new entity in the database.
     *
     * @return bool True if success, otherwise false.
     */
    public function create(): bool
    {
        $columns = [];
        $valueParams = [];
        foreach ($this->toArray() as $key => $value) {
            array_push($columns, $key);
            array_push($valueParams, ":$key");
        }
        $columns = implode(',', $columns);
        $valueParams = implode(',', $valueParams);

        $tableName = self::getTableName();
        $query = "INSERT INTO $tableName ($columns) VALUES ($valueParams)";

        try {
            $this->id = self::createDatabase()->insert($query, $this->toArray());
            return true;
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                throw $e;
            }
            return false;
        }
    }

    /**
     * Update the entity in the database.
     *
     * @return bool True if success, otherwise false.
     */
    public function save(): bool
    {
        $array = [];
        foreach ($this->toArray() as $key => $value) {
            if ($key != 'id') {
                array_push($array, "$key=:$key");
            }
        }
        $setLine = implode(',', $array);

        $tableName = self::getTableName();
        $query = "UPDATE $tableName SET $setLine WHERE id=:id";

        try {
            self::createDatabase()->update($query, $this->toArray());
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    /**
     * Delete the entity from the database.
     *
     * @return bool True if success, otherwise false.
     */
    public function delete(): bool
    {
        return self::destroy($this->id);
    }

    #[Pure] protected static function hydrate(array $fields): Entity
    {
        $entity = new static();

        foreach ($fields as $key => $value) {
            if (property_exists(static::class, $key)) {
                $entity->$key = $value;
            }
        }

        return $entity;
    }

    protected function toArray(): array
    {
        return get_object_vars($this);
    }

    protected static function createDatabase(): Database
    {
        return Database::getInstance($_ENV['DB_DSN'], $_ENV['DB_USER_NAME'], $_ENV['DB_USER_PWD']);
    }

    private static function getTableName(): string
    {
        return static::TABLE_NAME;
    }
    //endregion
}
