<?php

namespace Todolist\Infrastructure\Projection;


use Doctrine\DBAL\Connection;
use Todolist\Domain\Event\TodoDescriptionWasChanged;
use Todolist\Domain\Event\TodoTitleWasChanged;
use Todolist\Domain\Event\TodoWasCreated;
use Todolist\Domain\Event\TodoWasRemoved;
use Todolist\Domain\TodoProjection as TodoProjectionInterface;
use Todolist\Shared\AbstractProjection;

class TodoProjection extends AbstractProjection implements TodoProjectionInterface
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $connection;

    /**
     * TodoProjection constructor.
     *
     * @param \Doctrine\DBAL\Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function projectWhenTodoWasCreated(TodoWasCreated $event)
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO `todos` (`id`, `title`, `description`)
            VALUES (:id, :title, :description)'
        );

        $stmt->execute([
            ':id' => (string) $event->getAggregateId(),
            ':title' => $event->getTitle(),
            ':description' => $event->getDescription()
        ]);
    }

    public function projectWhenTodoTitleWasChanged(TodoTitleWasChanged $event)
    {
        $this->connection->executeQuery(
            'UPDATE `todos` SET `title` = ? WHERE id = ?',
            [
                $event->getTitle(),
                (string) $event->getAggregateId()
            ]
        );
    }

    public function projectWhenTodoDescriptionWasChanged(TodoDescriptionWasChanged $event)
    {
        $this->connection->executeQuery(
            'UPDATE `todos` SET `description` = ? WHERE id = ?',
            [
                $event->getDescription(),
                (string) $event->getAggregateId()
            ]
        );
    }

    public function projectWhenTodoWasRemoved(TodoWasRemoved $event)
    {
        $stmt = $this->connection->prepare(
            'DELETE FROM `todos` WHERE `id` = :id'
        );

        $stmt->execute([
            ':id' => (string) $event->getAggregateId()
        ]);
    }

}