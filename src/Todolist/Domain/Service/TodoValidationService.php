<?php

namespace Todolist\Domain\Service;


use Todolist\Domain\Exception\TodoNameIsEmptyException;
use Todolist\Domain\Specification\TodoNameIsNotEmptySpecification;
use Todolist\Domain\Repository\TodoRepositoryInterface;

class TodoValidationService
{
    /**
     * @var \Todolist\Domain\Repository\TodoRepositoryInterface
     */
    private $todoRepository;

    /**
     * TodoNameIsEmptyException constructor.
     *
     * @param \Todolist\Domain\Repository\TodoRepositoryInterface $todoRepository
     */
    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function validateTitle(string $title, $id = null): bool
    {
        $emptyNameValidator = new TodoNameIsNotEmptySpecification();

        if (!$emptyNameValidator->isSatisfiedBy($title)) {
            throw new TodoNameIsEmptyException("Todo's itle should not be empty.");
        }

        return true;
    }

}