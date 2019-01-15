<?php

namespace Todolist\Shared;


abstract class AggregateRoot implements RecordEvents
{
    /**
     * @var array|\Todolist\Shared\DomainEvent[]
     */
    private $recordedEvents = [];

    public function getRecordedEvents(): DomainEvents
    {
        return new DomainEvents($this->recordedEvents);
    }

    public function clearRecordedEvents()
    {
        $this->recordedEvents = [];
    }

    protected function recordThat(DomainEvent $event)
    {
        $this->recordedEvents[] = $event;
    }

    protected function apply(DomainEvent $event)
    {
        $method = 'apply'.ClassNameHelper::getShortClassName(get_class($event));

        if (property_exists($this, $method)) {
            $this->$method($event);
        }
    }

    protected function applyAndRecardThat(DomainEvent $event)
    {
        $this->apply($event);
        $this->recordThat($event);
    }

    abstract public static function reconstituteFromHistory(DomainEventsHistory $eventsHistory);
}