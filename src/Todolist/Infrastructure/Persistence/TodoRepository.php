<?php

namespace Todolist\Infrastructure\Persistence;


use Todolist\Domain\Todo;
use Todolist\Domain\TodoProjection;
use Todolist\Domain\Repository\TodoRepositoryInterface;
use Todolist\Shared\AggregateId;
use Todolist\Shared\EventStore;
use Todolist\Shared\RecordEvents;

class TodoRepository implements TodoRepositoryInterface
{
    /**
     * @var \Todolist\Shared\EventStore
     */
    private $eventStore;
    /**
     * @var \Todolist\Domain\TodoProjection
     */
    private $projection;

    /**
     * TodoRepository constructor.
     *
     * @param \Todolist\Shared\EventStore $eventStore
     * @param \Todolist\Domain\TodoProjection $projection
     */
    public function __construct(EventStore $eventStore, TodoProjection $projection)
    {
        $this->eventStore = $eventStore;
        $this->projection = $projection;
    }

    public function add(RecordEvents $aggregate)
    {
        $recordedEvents = $aggregate->getRecordedEvents();
        $this->eventStore->append($recordedEvents);
        $this->projection->project($recordedEvents);

        $aggregate->clearRecordedEvents();
    }

    public function get(AggregateId $id): RecordEvents
    {
        $events = $this->eventStore->get($id);

        return Todo::reconstituteFromHistory($events);
    }
}