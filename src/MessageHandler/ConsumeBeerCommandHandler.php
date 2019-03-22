<?php
declare(strict_types=1);

namespace App\MessageHandler;

use App\MessageCommand\ConsumeBeerCommand;
use App\MessageCommand\GoHomeCommand;
use App\MessageCommand\GoToWCCommand;
use App\MessageCommand\GoWCCommand;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\HandleTrait;

class ConsumeBeerCommandHandler implements MessageHandlerInterface
{
    use CommandHandlerTrait;

    /**
     * @param ConsumeBeerCommand $command
     */
    public function __invoke(ConsumeBeerCommand $command): void
    {
        file_put_contents('/tmp/aaa.txt', $command->getLog(), FILE_APPEND);

        if ($command->getAmount() > ConsumeBeerCommand::MAX_CONSUME) {
            $this->bus->dispatch(
                new GoWCCommand($command->getName())
            );

            $this->bus->dispatch(
                new ConsumeBeerCommand($command->getName(), $command->getAmount() - ConsumeBeerCommand::MAX_CONSUME)
            );
        } else {
            $this->bus->dispatch(
                new GoHomeCommand($command->getName())
            );
        }
    }
}
