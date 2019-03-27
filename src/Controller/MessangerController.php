<?php

namespace App\Controller;

use App\Entity\Supplier;
use App\MessageCommand\CreateTodoCommand;
use App\ProophessorDo\Model\Todo\TodoId;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class MessangerController
{
    /**
     * @var  EntityManager
     */
    private $entityManager;

    /**
     * @var MessageBusInterface
     */
    private $bus;

    public function __construct(EntityManagerInterface $entityManager, MessageBusInterface $bus)
    {
        $this->entityManager = $entityManager;
        $this->bus = $bus;
    }

    /**
     * @Route("/test")
     *
     * @return Response
     */
    public function testAction()
    {
        /** @var Supplier $supplier */
        $supplier = $this->entityManager->getRepository(Supplier::class)->findOneBy(['name' => 'supplier-1']);
        $todoId = TodoId::generate();

        $this->bus->dispatch(
            CreateTodoCommand::createTodoForSuppler($supplier->getUuid(), $todoId->toString())
        );

        return new Response(
            sprintf(
                '<p>Event store updated for supplier <b>%s</b> with new Todo uuid <b>%s</b></p>',
                $supplier->getId(),
                $todoId->toString()
            )
        );
    }

    /**
     * @Route("/supplier/{id}")
     *
     * @param int $id
     *
     * @return Response
     */
    public function testBySupplierAction(int $id)
    {
        /** @var Supplier $supplier */
        $supplier = $this->entityManager->getRepository(Supplier::class)->find($id);
        $todoId = TodoId::generate();

        $this->bus->dispatch(
            CreateTodoCommand::createTodoForSuppler($supplier->getUuid(), $todoId->toString())
        );

        return new Response(
            sprintf(
                '<p>Event store updated for supplier <b>%s</b> with new Todo uuid <b>%s</b></p>',
                $supplier->getId(),
                $todoId->toString()
            )
        );
    }
}
