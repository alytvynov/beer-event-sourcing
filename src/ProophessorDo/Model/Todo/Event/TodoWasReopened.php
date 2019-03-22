<?php

declare(strict_types=1);

namespace App\ProophessorDo\Model\Todo\Event;

use Prooph\EventSourcing\AggregateChanged;
use App\ProophessorDo\Model\Todo\TodoId;

final class TodoWasReopened extends AggregateChanged
{
    /**
     * @var TodoId
     */
    private $todoId;

    /**
     * @var string
     */
    private $status;

    public static function withStatus(TodoId $todoId, string $status): TodoWasReopened
    {
        /** @var self $event */
        $event = self::occur($todoId->toString(), [
            'status' => $status,
        ]);

        $event->todoId = $todoId;
        $event->status = $status;

        return $event;
    }

    public function todoId(): TodoId
    {
        if (null === $this->todoId) {
            $this->todoId = TodoId::fromString($this->aggregateId());
        }

        return $this->todoId;
    }

    public function status(): string
    {
        return $this->status;
    }
}
