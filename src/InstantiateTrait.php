<?php
namespace Phauthentic\Infrastructure\Storage;

trait InstantiateTrait
{
    /**
     *
     */
    protected function instantiate(
        string $className,
        array $args = [],
        bool $throwExceptionOnMissingArgument = true
    ): callable {
        $class = new \ReflectionClass($className);

        if (!$constructor = $class->getConstructor()) {
            return function() use ($class) { return $class->newInstanceWithoutConstructor(); };
        }

        if (!$constructor->isPublic()) {
            throw ConstructorIsNotPublic::fromClassName($className);
        }

        $allArgs = [];
        $missingArgs = [];
        foreach($constructor->getParameters() as $param) {
            /* @var $param \ReflectionParameter */

            if (isset($args[$param->getName()])) {
                $allArgs[] = $args[$param->getName()];
            } else {
                if (!$param->allowsNull() && !$param->isOptional()) {
                    if ($throwExceptionOnMissingArgument) {
                        throw ArgumentIsRequired::fromClassAndArgumentNames($className, $param->getName());
                    }

                    $missingArgs[] = $param->getName();
                    continue;
                }
                $allArgs[] = $param->isDefaultValueAvailable() ? $param->getDefaultValue() : null;
            }
        }

        return function ($additionalArgs = []) use ($class, $allArgs, $missingArgs) {
            if ($missingArgs && $stillMissingKeys = array_diff_key($missingArgs, $additionalArgs)) {
                throw ArgumentIsRequired::fromClassAndArgumentNames($class->getName(), key($stillMissingKeys));
            }

            return $class->newInstanceArgs(array_merge($allArgs, $additionalArgs));
        };
    }
}
