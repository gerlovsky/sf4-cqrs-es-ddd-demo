<?php

namespace Todolist\Shared;


interface AggregateRepository
{
    public function add(RecordEvents $aggregate);

    public function get(AggregateId $id): RecordEvents;
}