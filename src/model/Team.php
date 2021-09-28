<?php

namespace TeamBuilder\model;

class Team extends Model
{

    public function create()
    {

    }

    public static function make(array $fields): Team
    {
        return new Team();
    }

    public static function find(int $id): ?Team
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
