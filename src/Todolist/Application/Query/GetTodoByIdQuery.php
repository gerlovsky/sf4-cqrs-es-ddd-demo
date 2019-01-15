<?php

namespace Todolist\Application\Query;


class GetTodoByIdQuery
{
    private $todoId;

    /**
     * GetTaskByIdQuery constructor.
     *
     * @param $todoId
     */
    public function __construct($todoId)
    {
        $this->todoId = $todoId;
    }

    /**
     * @return mixed
     */
    public function getTodoId()
    {
        return $this->todoId;
    }
}