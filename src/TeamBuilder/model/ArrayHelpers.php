<?php

namespace TeamBuilder\model;

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

            if ($al == $bl) {
                return 0;
            } elseif ($al > $bl) {
                return 1;
            } else {
                return -1;
            }
        });

        return $array;
    }
}
