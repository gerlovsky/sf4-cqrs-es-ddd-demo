<?php

namespace Todolist\Domain;


interface TodoQueryRepository
{
    public function get(string $id): Todo;

    /**
     * @param int $page
     * @param int $perPage
     *
     * @return array|\Todolist\Domain\Todo[]
     */
    public function fetchAll(int $page, int $perPage): array;

    public function count();
}