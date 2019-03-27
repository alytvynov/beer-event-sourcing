<?php

declare(strict_types=1);

namespace App\ProophessorDo\Model\Todo;

use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;
use App\ProophessorDo\Model\Entity;
use App\ProophessorDo\Model\Todo\Event\TodoWasMarkedAsDone;
use App\ProophessorDo\Model\Todo\Event\TodoWasPosted;
use App\ProophessorDo\Model\Todo\Event\TodoWasReopened;

final class Todo extends AggregateRoot implements Entity
{
    /**
     * @var TodoId
     */
    private $todoId;

    /**
     * @var string
     */
    private $supplierId;

    /**
     * @var string
     */
    private $status;

    public static function post(string $supplierId, TodoId $todoId): Todo
    {
        $self = new self();
        $self->recordThat(TodoWasPosted::bySupplier($supplierId, $todoId));

        return $self;
    }

    public function getSupplierId(): string
    {
        return $this->supplierId;
    }

    public function status(): string
    {
        return $this->status;
    }

    protected function whenTodoWasPosted(TodoWasPosted $event): void
    {
        $this->todoId = $event->todoId();
        $this->status = $event->status();
        $this->supplierId = $event->getSupplierId();
    }

    protected function whenTodoWasMarkedAsDone(TodoWasMarkedAsDone $event): void
    {
        $this->status = $event->status();
    }

    protected function whenTodoWasReopened(TodoWasReopened $event): void
    {
        $this->status = $event->status();
    }

    protected function aggregateId(): string
    {
        return $this->todoId->toString();
    }

    public function sameIdentityAs(Entity $other): bool
    {
        return \get_class($this) === \get_class($other) && $this->todoId->sameValueAs($other->todoId);
    }

    /**
     * Apply given event
     */
    protected function apply(AggregateChanged $e): void
    {
        $handler = $this->determineEventHandlerMethodFor($e);

        if (!\method_exists($this, $handler)) {
            throw new \RuntimeException(\sprintf(
                'Missing event handler method %s for aggregate root %s',
                $handler,
                \get_class($this)
            ));
        }

        $this->{$handler}($e);
    }

    public function markAsClosed(): void
    {
        $this->status = TodoWasMarkedAsDone::STATUS;

        $this->recordThat(TodoWasMarkedAsDone::withData($this->supplierId, $this->todoId));
    }

    public function markAsOpened(): void
    {
        $this->status = TodoWasReopened::STATUS;

        $this->recordThat(TodoWasReopened::withData($this->supplierId, $this->todoId));
    }

    protected function determineEventHandlerMethodFor(AggregateChanged $e): string
    {
        return 'when' . \implode(\array_slice(\explode('\\', \get_class($e)), -1));
    }
}
