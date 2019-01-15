<?php


namespace Todolist\Shared;


interface Projection
{
    public function project(DomainEvents $events);
}