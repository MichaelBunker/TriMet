<?php

declare(strict_types=1);

namespace TriMet\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\TestCase;
use \ReflectionException;

class TriMetBaseTestCase extends TestCase
{
    /**
     * Sets a protected property on a given object.
     * @throws ReflectionException
     */
    protected function setProtectedProperty(mixed $object, string $property, mixed $value): void
    {
        try {
            $reflection = new \ReflectionClass($object);
        } catch (ReflectionException) {
            throw new AssertionFailedError("Problem mocking property: $property.");
        }
        $reflectionProperty = $reflection->getProperty($property);
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($object, $value);
    }
}
