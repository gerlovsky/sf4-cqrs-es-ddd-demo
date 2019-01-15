<?php

namespace Todolist\Shared;


class ClassNameHelper
{
    public static function getShortClassName($className): string
    {
        if (empty(self::getNamespace($className))) {
            return $className;
        }

        return substr($className, strrpos($className, '\\') + 1);
    }

    public static function getNamespace(string $className): string
    {
        return substr($className, 0, strrpos($className, '\\'));
    }
}