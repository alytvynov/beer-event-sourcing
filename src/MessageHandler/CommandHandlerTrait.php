<?php
declare(strict_types=1);

namespace App\MessageHandler;

use App\Command\BuyBeerCommand;
use App\Command\ConsumeBeerCommand;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

trait CommandHandlerTrait
{
    /**
     * @var MessageBusInterface
     */
    private $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }
}
