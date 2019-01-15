<?php

namespace Todolist\Infrastructure\Persistence;


use Doctrine\DBAL\Connection;
use Symfony\Component\Serializer\SerializerInterface;
use Todolist\Shared\AggregateId;
use Todolist\Shared\DomainEvents;
use Todolist\Shared\DomainEventsHistory;
use Todolist\Shared\EventStore;

class MySQLEventStore implements EventStore
{
    const TABLE_NAME = 'events';

    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $connection;
    /**
     * @var \Symfony\Component\Serializer\SerializerInterface
     */
    private $serializer;

    /**
     * MySQLEventStore constructor.
     *
     * @param $connection
     * @param \Symfony\Component\Serializer\SerializerInterface $serializer
     */
    public function __construct(Connection $connection, SerializerInterface $serializer)
    {
        $this->connection = $connection;
        $this->serializer = $serializer;
    }

    public function append(DomainEvents $events)
    {
        $stmt = $this->connection->prepare(
            sprintf('INSERT INTO %s (`aggregate_id`, `event_name`, `created_at`, `payload`) VALUES (:aggregateId, :eventName, :createAt, :payload)', static::TABLE_NAME)
        );

        /** @var \Todolist\Shared\DomainEvent $event */
        foreach ($events as $event) {
            $stmt->execute([
                ':aggregateId' => $event->getAggregateId(),
                ':eventName' => get_class($event),
                ':createdAt' => (new \DateTimeImmutable())->format('Y-m-d H:i:s'),
                ':payload' => $this->serializer->serialize($event, 'json')
            ]);
        }
    }

    public function get(AggregateId $aggregateId): DomainEventsHistory
    {
        $stmt = $this->connection->prepare(sprintf('SELECT * from %s WHERE `aggregate_id` = :aggregateId', static::TABLE_NAME));
        $stmt->execute([
            ':aggregateId' => (string) $aggregateId
        ]);

        $events = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $events[] = $this->serializer->deserialize($row['payload'], $row['event_name'], 'json');
        }

        $stmt->closeCursor();

        return new DomainEventsHistory($aggregateId, $events);
    }


}