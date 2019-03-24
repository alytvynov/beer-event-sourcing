<?php

declare(strict_types=1);

namespace App\ProophessorDo\Model\Todo\Event;

use Prooph\EventSourcing\AggregateChanged;
use App\ProophessorDo\Model\Todo\TodoId;

final class TodoWasMarkedAsDone extends AggregateChanged
{
    /**
     * @var TodoId
     */
    private $todoId;

    /**
     * @var string
     */
    private $oldStatus;

    /**
     * @var string
     */
    private $newStatus;

    public function todoId(): TodoId
    {
        if (null === $this->todoId) {
            $this->todoId = TodoId::fromString($this->aggregateId());
        }

        return $this->todoId;
    }

    public function oldStatus(): string
    {
        return $this->oldStatus;
    }

    public function newStatus(): string
    {
        return $this->newStatus;
    }
}
