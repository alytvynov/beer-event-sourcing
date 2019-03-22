<?php
/**
 * This file is part of prooph/proophessor-do.
 * (c) 2014-2017 prooph software GmbH <contact@prooph.de>
 * (c) 2015-2017 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
    private $status;

    public static function post(string $status, TodoId $todoId): Todo
    {
        $self = new self();
        $self->recordThat(TodoWasPosted::withData($todoId, $status));

        return $self;
    }

    public function status(): string
    {
        return $this->status;
    }

    protected function whenTodoWasPosted(TodoWasPosted $event): void
    {
        $this->todoId = $event->todoId();
        $this->status = $event->status();
    }

    protected function whenTodoWasMarkedAsDone(TodoWasMarkedAsDone $event): void
    {
        $this->status = $event->newStatus();
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

        if (! \method_exists($this, $handler)) {
            throw new \RuntimeException(\sprintf(
                'Missing event handler method %s for aggregate root %s',
                $handler,
                \get_class($this)
            ));
        }

        $this->{$handler}($e);
    }

    protected function determineEventHandlerMethodFor(AggregateChanged $e): string
    {
        return 'when' . \implode(\array_slice(\explode('\\', \get_class($e)), -1));
    }
}
