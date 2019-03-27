<?php
declare(strict_types=1);

namespace App\MessageHandler;

use App\MessageCommand\CloseTodoCommand;
use App\MessageCommand\OpenTodoCommand;
use App\ProophessorDo\Infrastructure\Repository\EventStoreTodoList;
use App\ProophessorDo\Model\Todo\TodoList;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class CloseTodoHandler implements MessageHandlerInterface
{
    /**
     * @var MessageBusInterface
     */
    private $bus;

    /**
     * @var EventStoreTodoList
     */
    private $todoList;

    public function __construct(TodoList $list, MessageBusInterface $bus)
    {
        $this->todoList = $list;
        $this->bus = $bus;
    }

    /**
     * @param CloseTodoCommand $command
     */
    public function __invoke(CloseTodoCommand $command): void
    {
        $todo = $this->todoList->get($command->getTodoId());

        $todo->markAsClosed();

        $this->todoList->save($todo);

        $this->bus->dispatch(
            new OpenTodoCommand($command->getSupplierId(), $command->getTodoId()->toString())
        );
    }
}
