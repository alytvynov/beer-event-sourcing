<?php
declare(strict_types=1);

namespace App\MessageHandler;

use App\MessageCommand\BuyBeerCommand;
use App\MessageCommand\ConsumeBeerCommand;
use App\MessageCommand\GoHomeCommand;
use App\MessageCommand\GoWCCommand;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class GoHomeCommandHandler implements MessageHandlerInterface
{
    use CommandHandlerTrait;

    public function __invoke(GoHomeCommand $command): void
    {
        file_put_contents('/tmp/aaa.txt', $command->getLog(), FILE_APPEND);
    }
}
