<?php

namespace App\Aggregate;

use App\Event\UserTookBeerEvent;
use App\MessageCommand\BuyBeerCommand;
use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;

class UserBeer extends AggregateRoot
{
    /**
     * @var string
     */
    private $id = 1;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var string
     */
    private $comment;

    protected function aggregateId(): string
    {
        return (string)$this->id;
    }

    protected function apply(AggregateChanged $event): void
    {
        switch(true) {
            case $event instanceof UserTookBeerEvent:
                $this->whenBeerWasBought($event);
                break;
        }
    }

    protected function whenBeerWasBought(UserTookBeerEvent $event): void
    {
        $this->name = $event->getName();
        $this->amount = $event->getAmount();
        $this->comment = $event->getComment();
    }
}