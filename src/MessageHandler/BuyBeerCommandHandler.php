<?php
declare(strict_types=1);

namespace App\MessageHandler;

use App\MessageCommand\BuyBeerCommand;
use App\MessageCommand\ConsumeBeerCommand;
use App\ProophessorDo\Infrastructure\Repository\EventStoreTodoList;
use App\ProophessorDo\Model\Todo\Todo;
use App\ProophessorDo\Model\Todo\TodoId;
use App\ProophessorDo\Model\Todo\TodoList;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class BuyBeerCommandHandler implements MessageHandlerInterface
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

    /**
     * @param BuyBeerCommand $command
     */
    public function __invoke(BuyBeerCommand $command): void
    {
        file_put_contents('/tmp/aaa.txt', $command->getLog(), FILE_APPEND);

        if ($command->getAmount() > 0) {
            $this->bus->dispatch(
                new ConsumeBeerCommand($command->getName(), $command->getAmount())
            );
        }

        $todo = Todo::post('initialize', TodoId::generate());

        $this->toDoList->save($todo);
    }
}
