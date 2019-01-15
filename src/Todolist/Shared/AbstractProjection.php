<?php

namespace Todolist\Shared;


abstract class AbstractProjection implements Projection
{
    public function project(DomainEvents $events)
    {
        foreach ($events as $event) {
            $method = 'projectWhen'.ClassNameHelper::getShortClassName(get_class($event));

            if (property_exists($this, $method)) {
                $this->$method($event);
            }
        }

    }
}