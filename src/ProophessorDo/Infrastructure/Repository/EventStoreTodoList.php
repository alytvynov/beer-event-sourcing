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
