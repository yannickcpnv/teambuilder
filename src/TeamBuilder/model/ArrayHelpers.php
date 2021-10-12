<?php

namespace TeamBuilder\model;

use Collator;

class ArrayHelpers
{

    /**
     * Sort an array of objects with a property given.
     *
     * @param $array    object[]  The array of object to sort.
     * @param $property string The property to use in the comparison.
     *
     * @return array The array sorted
     */
    public static function sortObjects(array $array, string $property): array
    {
        usort($array, function ($a, $b) use ($property) {
            $al = strtolower($a->$property);
            $bl = strtolower($b->$property);
            $collator = new Collator('sk_SK.utf8');

            return $collator->compare($al, $bl);
        });

        return $array;
    }
}
