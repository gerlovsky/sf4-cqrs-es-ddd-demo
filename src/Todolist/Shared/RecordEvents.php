<?php

namespace Todolist\Shared;


interface RecordEvents
{
    public function getRecordedEvents(): DomainEvents;

    public function clearRecordedEvents();
}