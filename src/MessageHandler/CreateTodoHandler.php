<?php
declare(strict_types=1);

namespace App\MessageHandler;

use App\MessageCommand\CloseTodoCommand;
use App\MessageCommand\CreateTodoCommand;
use App\ProophessorDo\Infrastructure\Repository\EventStoreTodoList;
use App\ProophessorDo\Model\Todo\Todo;
use App\ProophessorDo\Model\Todo\TodoList;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateTodoHandler implements MessageHandlerInterface
{
    /**
     * @var MessageBusInterface
     */
    private $bus;

    /**
     * @var EventStoreTodoList
     */
    private $toDoList;

    public function __construct(TodoList $list, MessageBusInterface $bus)
    {
        $this->toDoList = $list;
        $this->bus = $bus;
    }

    public function __invoke(CreateTodoCommand $command): void
    {
        $todo = Todo::post(
            $command->getSupplierI(),
            $command->getTodoId()
        );

        $this->toDoList->save($todo);

        $this->bus->dispatch(
            new CloseTodoCommand(
                $command->getSupplierI(),
                $command->getTodoId()->toString()
            )
        );
    }
}
