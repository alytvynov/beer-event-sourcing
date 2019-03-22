<?php
declare(strict_types=1);

namespace App\MessageCommand;

class GoWCCommand
{
    const DEFAULT_COMMENT = 'go_wc';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $comment;

    public function __construct(string $name, $comment = self::DEFAULT_COMMENT)
    {
        $this->name = $name;
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
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    public function getLog(): string
    {
        return sprintf("%s : %s\n", $this->name, $this->comment);
    }
}
