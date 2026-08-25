<?php

declare(strict_types=1);

namespace Cdn77\RabbitMQBundle\Tests\RabbitMQ;

use Bunny\Message;
use Cdn77\RabbitMQBundle\RabbitMQ\Consumer\Configuration;
use Cdn77\RabbitMQBundle\RabbitMQ\Consumer\Consumer;
use Cdn77\RabbitMQBundle\RabbitMQ\Operation\AcknowledgeOperation;

final class InMemoryConsumer implements Consumer
{
    /** @var Message[] */
    private array $consumedMessages = [];

    public function __construct(
        private AcknowledgeOperation $acknowledgeOperation,
        private Configuration $configuration,
    ) {
    }

    public function consume(Message $message): void
    {
        $this->consumedMessages[] = $message;

        $this->acknowledgeOperation->handle($message);
    }

    public function getName(): string
    {
        return 'test';
    }

    public function getConfiguration(): Configuration
    {
        return $this->configuration;
    }

    /** @return Message[] */
    public function getConsumedMessages(): array
    {
        return $this->consumedMessages;
    }
}
