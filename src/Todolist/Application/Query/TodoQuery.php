<?php

namespace Todolist\Application\Query;


class TodoQuery
{
    /**
     * @var string
     */
    private $id;

    /**
     * TodoQuery constructor.
     *
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}