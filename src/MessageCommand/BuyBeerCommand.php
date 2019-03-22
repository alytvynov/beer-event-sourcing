<?php
declare(strict_types=1);

namespace App\MessageCommand;

class BuyBeerCommand
{
    const DEFAULT_COMMENT = 'buy_beer';

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

    public function __construct(string $name, float $amount, string $comment = self::DEFAULT_COMMENT)
    {
        $this->name = $name;
        $this->amount = $amount;
        $this->comment = $comment;
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

    public function getLog(): string
    {
        return sprintf("%s : %s : %s\n", $this->name, $this->amount, $this->comment);
    }
}
