<?php

namespace App\MessageCommand;

use App\ProophessorDo\Model\Todo\TodoId;

class CreateTodoCommand
{
    const DEFAULT_COMMENT = 'TODO_CREATED';

    /**
     * @var string
     */
    private $supplierId;

    /**
     * @var string
     */
    private $todoId;


    public static function createTodoForSuppler(string $supplierId, string $todoId): CreateTodoCommand
    {
        return new self(
            $supplierId,
            $todoId
        );
    }

    public function __construct(string $supplierId, string $todoId)
    {
        $this->supplierId = $supplierId;
        $this->todoId = $todoId;
    }

    public function getSupplierI(): string
    {
        return $this->supplierId;
    }

    public function getTodoId(): TodoId
    {
        return TodoId::fromString($this->todoId);
    }
}