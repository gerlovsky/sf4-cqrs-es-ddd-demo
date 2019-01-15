<?php

namespace Todolist\Domain\Factory;


use Todolist\Domain\Exception\TodoNameIsEmptyException;
use Todolist\Domain\Repository\TodoRepositoryInterface;
use Todolist\Domain\Service\TodoValidationService;
use Todolist\Domain\Todo;
use Todolist\Domain\TodoId;

class TodoFactory
{
    /**
     * @var \Todolist\Domain\Repository\TodoRepositoryInterface
     */
    protected $todoRepository;

    protected $todoValidationService;

    /**
     * TodoFactory constructor.
     *
     * @param \Todolist\Domain\Repository\TodoRepositoryInterface $todoRepository
     */
    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;

        $this->todoValidationService = new TodoValidationService($this->todoRepository);
    }

    public function createFromTitle(string $title): Todo
    {
        $todo = new Todo(TodoId::generate(), '', '');

        try {
            $this->todoValidationService->validateTitle($title);
        } catch (TodoNameIsEmptyException $e) {
            throw $e;
        }

        $todo->setTitle($title);

        return $todo;
    }
}