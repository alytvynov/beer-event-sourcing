<?php

namespace App\MessageCommand;


use App\ProophessorDo\Model\Todo\TodoId;

class OpenTodoCommand
{
    const DEFAULT_COMMENT = 'TODO_OPENED';

    /**
     * @var string
     */
    private $supplierId;

    /**
     * @var string
     */
    private $todoId;

    public function __construct(string $supplierId, string $todoId)
    {
        $this->supplierId = $supplierId;
        $this->todoId = $todoId;
    }

    /**
     * @return string
     */
    public function getSupplierId(): string
    {
        return $this->supplierId;
    }

    public function getTodoId(): TodoId
    {
        return TodoId::fromString($this->todoId);
    }
}
