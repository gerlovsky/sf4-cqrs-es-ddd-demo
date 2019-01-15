<?php

namespace Todolist\Shared;


use Ramsey\Uuid\Uuid;

class UUIDGenerator
{
    public static function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}