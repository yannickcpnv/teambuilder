<?php

namespace TeamBuilder\model;

use ReflectionMethod;
use RuntimeException;
use ReflectionProperty;

trait Accessors
{

    public function __get($property)
    {
        return $this->createAccessors($property);
    }

    public function __set($property, $value)
    {
        $this->createAccessors($property, true, $value);
    }

    private function createAccessors($property, $isSet = false, $value = null)
    {
        $method = $isSet ? 'set' : 'get' . ucfirst($property); //camelCase() method name
        if (method_exists($this, $method)) {
            $reflection = new ReflectionMethod($this, $method);
            if (!$reflection->isPublic()) {
                throw new RuntimeException("The called method is not public.");
            }
        }

        if (property_exists($this, $property)) {
            $reflectedProperty = new ReflectionProperty($this, $property);
            $reflectedProperty->setAccessible(true);
            if ($isSet) {
                $reflectedProperty->setValue($this, $value);
            } else {
                return $reflectedProperty->getValue($this);
            }
        }

        return null;
    }
}
