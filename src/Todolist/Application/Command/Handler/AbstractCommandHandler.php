<?php

namespace Todolist\Application\Command\Handler;


use Todolist\Domain\Repository\TodoRepositoryInterface;

class AbstractCommandHandler
{
    /**
     * @var \Todolist\Domain\Repository\TodoRepositoryInterface
     */
    protected $todoRepository;

    /**
     * AbstractCommandHandler constructor.
     *
     * @param \Todolist\Domain\Repository\TodoRepositoryInterface $todoRepository
     */
    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }
}