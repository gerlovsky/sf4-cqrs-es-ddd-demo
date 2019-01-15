<?php

namespace Todolist\Shared;


interface DomainEvent
{
    public function getAggregateId(): AggregateId;
}