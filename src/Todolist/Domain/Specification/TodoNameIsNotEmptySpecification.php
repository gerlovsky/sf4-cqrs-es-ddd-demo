<?php

namespace Todolist\Domain\Specification;


class TodoNameIsNotEmptySpecification
{
    /**
     * Chack given title is empty or not, we want it not empty
     *
     * @param string $title
     *
     * @return bool
     */
    public function isSatisfiedBy(string $title)
    {
        return $title !== '';
    }
}