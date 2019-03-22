<?php
declare(strict_types=1);

namespace App\MessageHandler;

use App\MessageCommand\BuyBeerCommand;
use App\MessageCommand\ConsumeBeerCommand;
use App\Repository\BeerCollection;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class BuyBeerCommandHandler implements MessageHandlerInterface
{
    /**
     * @var MessageBusInterface
     */
    private $bus;

    /**
     * @var BeerCollection
     */
    private $beerCollection;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
        //$this->beerCollection = $beerCollection;
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
    }
}
