<?php

namespace App\Event;

use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Prooph\EventSourcing\AggregateChanged;
use Ramsey\Uuid\Uuid;

final class UserTookBeerEvent extends AggregateChanged
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var double
     */
    private $amount;

    /**
     * @var string
     */
    private $comment;

    public static function withData(string $name, int $amount)
    {
        return self::occur(Uuid::fromString('1'), ['name' => 'XXX', 'amount' => 5, 'comment' => 'wtf']);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }
}