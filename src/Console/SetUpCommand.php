<?php

declare(strict_types=1);

namespace Cdn77\RabbitMQBundle\Console;

use Cdn77\RabbitMQBundle\Configuration\Topology;
use Cdn77\RabbitMQBundle\DependencyInjection\RabbitMQExtension;
use Cdn77\RabbitMQBundle\SetupAction;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class SetUpCommand extends Command
{
    private const string NAME = RabbitMQExtension::ALIAS . ':setup';
    private const string DESCRIPTION = 'Set up exchanges and queues from configuration';

    public function __construct(
        private SetupAction $setupAction,
        private Topology $topology,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName(self::NAME);
        $this->setDescription(self::DESCRIPTION);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->setupAction->setup($this->topology);

        return 0;
    }
}
