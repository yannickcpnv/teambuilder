<?php

namespace TeamBuilder\model;

class Role
{

    public function create()
    {

    }

    public static function make(array $fields): Role
    {
        return new Role();
    }

    public static function find(int $id): ?Role
    {
        return null;
    }

    public static function all(): array
    {
        return [];
    }

    public function delete():bool
    {
        return false;
    }

    public function destroy(): bool
    {
        return false;
    }
}
