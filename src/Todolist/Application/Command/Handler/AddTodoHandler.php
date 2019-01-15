<?php

namespace Todolist\Application\Command\Handler;


use Todolist\Application\Command\AddTodoCommand;
use Todolist\Domain\Todo;

class AddTodoHandler extends AbstractCommandHandler
{
    public function handle(AddTodoCommand $command)
    {
        $newTodo = Todo::create(
            $command->getTodoId(),
            $command->getTitle(),
            $command->getDescription()
        );

        $this->todoRepository->add($newTodo);
    }
}