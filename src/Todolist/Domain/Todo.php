<?php
namespace Todolist\Domain;


use DateTimeImmutable;
use Todolist\Domain\Event\TodoDescriptionWasChanged;
use Todolist\Domain\Event\TodoTitleWasChanged;
use Todolist\Domain\Event\TodoWasCreated;
use Todolist\Domain\TodoId;
use Todolist\Shared\AggregateId;
use Todolist\Shared\AggregateRoot;
use Todolist\Shared\DomainEvent;
use Todolist\Shared\DomainEventsHistory;

class Todo extends AggregateRoot
{
    /**
     * @var \Todolist\Domain\TodoId
     */
    private $id;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $description;

    /**
     * Task constructor.
     *
     * @param \Todolist\Domain\TodoId|\Todolist\Shared\AggregateId $id
     * @param string $title
     * @param string $description
     */
    public function __construct(AggregateId $id, string $title, string $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }

    public static function createEmptyTodoWithId(AggregateId $todoId)
    {
        return new Todo($todoId, '', '');
    }

    public static function create(TodoId $todoId, string $title, string $description)
    {
        $newTodo = new Todo($todoId, $title, $description);
        $newTodo->recordThat(new TodoWasCreated($todoId, $title, $description));

        return $newTodo;
    }

    /**
     * @return \Todolist\Domain\TodoId
     */
    public function getId(): TodoId
    {
        return $this->id;
    }

    /**
     * @param \Todolist\Domain\TodoId $id
     *
     * @return Todo
     */
    public function setId(TodoId $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return Todo
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return Todo
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    public function changeTitle(string $newTitle)
    {
        if ($newTitle === $this->title) {
            return;
        }

        $this->applyAndRecardThat(
            new TodoTitleWasChanged($this->id, $newTitle)
        );
    }

    public function changeDescription(string $newDescription)
    {
        if ($newDescription === $this->description) {
            return;
        }

        $this->applyAndRecardThat(
            new TodoDescriptionWasChanged($this->id, $newDescription)
        );
    }

    public static function reconstituteFromHistory(DomainEventsHistory $eventsHistory)
    {
        $todo = static::createEmptyTodoWithId($eventsHistory->getAggregateId());

        foreach ($eventsHistory as $event) {
            $todo->apply($event);
        }

        return $todo;
    }

    protected function applyTodoWasCreated(TodoWasCreated $event)
    {
        $this->title = $event->getTitle();
        $this->description = $event->getDescription();
    }

    protected function applyTodoTitleWasChanged(TodoTitleWasChanged $event)
    {
        $this->title = $event->getTitle();
    }

    protected function applyTodoDescriptionWasChanged(TodoDescriptionWasChanged $event)
    {
        $this->description = $event->getDescription();
    }
}