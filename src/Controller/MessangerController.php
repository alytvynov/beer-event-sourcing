<?php

namespace App\Controller;

use App\MessageCommand\BuyBeerCommand;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class MessangerController
{
    /**
     * @Route("/test")
     */
    public function test(MessageBusInterface $bus)
    {
        $file = '/tmp/aaa.txt';
        if (file_exists($file)) {
            unlink($file);
        }

        $name = 'John';
        $amount = 5;

        $bus->dispatch(new BuyBeerCommand($name, $amount));

        return new Response('John, thank you');
    }
}