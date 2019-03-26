<?php

declare(strict_types=1);

namespace App\Command;

use Prooph\EventStore\EventStore;
use Prooph\EventStore\Stream;
use Prooph\EventStore\StreamName;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateEventStreamCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('event-store:event-stream:create')
            ->setDescription('Create event_stream.')
            ->setHelp('This command creates the event_stream');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var EventStore $eventStore */
        $eventStore = $this->getContainer()->get('prooph_event_store.todo_store');

        $eventStore->create(new Stream(new StreamName('event_stream'), new \ArrayIterator([])));
        $output->writeln('<info>Event stream was created successfully.</info>');

        for ($i = 0; $i < 10; $i++) {
            $streamName = sprintf('user#%s', $i);
            $eventStore->create(new Stream(new StreamName($streamName), new \ArrayIterator([])));
            $output->writeln(sprintf('Event stream <info>%s</info> was created successfully.', $streamName));
        }
    }
}
