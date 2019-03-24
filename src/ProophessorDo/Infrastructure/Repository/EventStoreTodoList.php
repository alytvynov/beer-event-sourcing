<?php

declare(strict_types=1);

namespace App\ProophessorDo\Infrastructure\Repository;

use Prooph\EventSourcing\Aggregate\AggregateRepository;
use App\ProophessorDo\Model\Todo\Todo;
use App\ProophessorDo\Model\Todo\TodoId;
use App\ProophessorDo\Model\Todo\TodoList;

final class EventStoreTodoList extends AggregateRepository implements TodoList
{
    public function save(Todo $todo): void
    {
        $this->saveAggregateRoot($todo);
    }

    public function get(TodoId $todoId): ?Todo
    {
        return $this->getAggregateRoot($todoId->toString());
    }
}
