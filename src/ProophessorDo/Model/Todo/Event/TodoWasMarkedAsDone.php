<?php

declare(strict_types=1);

namespace App\ProophessorDo\Model\Todo\Event;

use Prooph\EventSourcing\AggregateChanged;
use App\ProophessorDo\Model\Todo\TodoId;

final class TodoWasMarkedAsDone extends AggregateChanged
{
    const STATUS = 'DONE';

    /**
     * @var TodoId
     */
    private $todoId;

    /**
     * @var int
     */
    private $supplierId;

    /**
     * @var string
     */
    private $status = self::STATUS;

    public static function withData(string $supplierId, TodoId $todoId, string $status = self::STATUS): TodoWasMarkedAsDone
    {
        /** @var self $event */
        $event = self::occur($todoId->toString(), [
            'status' => $status,
            'supplierId' => $supplierId,
        ]);

        $event->todoId = $todoId;
        $event->status = $status;
        $event->supplierId = $supplierId;

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
        return $this->payload['status'];
    }

    /**
     * @return string
     */
    public function getSupplierId(): string
    {
        return $this->payload['supplierId'];
    }
}
