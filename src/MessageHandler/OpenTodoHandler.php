<?php
declare(strict_types=1);

namespace App\MessageHandler;

use App\MessageCommand\OpenTodoCommand;
use App\ProophessorDo\Infrastructure\Repository\EventStoreTodoList;
use App\ProophessorDo\Model\Todo\TodoList;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class OpenTodoHandler implements MessageHandlerInterface
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

    public function __invoke(OpenTodoCommand $command): void
    {
        $todo = $this->todoList->get($command->getTodoId());

        $todo->markAsOpened();

        $this->todoList->save($todo);
    }
}
