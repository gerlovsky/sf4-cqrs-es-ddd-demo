<?php

namespace Todolist\Domain;


use Todolist\Domain\Event\TodoDescriptionWasChanged;
use Todolist\Domain\Event\TodoTitleWasChanged;
use Todolist\Domain\Event\TodoWasCreated;
use Todolist\Domain\Event\TodoWasRemoved;
use Todolist\Shared\Projection;

interface TodoProjection extends Projection
{
    public function projectWhenTodoWasCreated(TodoWasCreated $event);

    public function projectWhenTodoTitleWasChanged(TodoTitleWasChanged $event);

    public function projectWhenTodoDescriptionWasChanged(TodoDescriptionWasChanged $event);

    public function projectWhenTodoWasRemoved(TodoWasRemoved $event);
}